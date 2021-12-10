<?php
    require_once('Request.php');
    require_once('Response.php');
    require '../vendor/autoload.php';

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;
    // NOTE-4:
    // We register our custom autoload function as a callback to be called when PHP is loading dependencies or require files.
    spl_autoload_register('autoLoad');

    function autoLoad($classname){
        if(preg_match('/[a-zA-Z]+Controller$/',$classname)){
            require_once('../controllers/'.$classname.'.php');
            return true;
        }
    }

    function validateAuthorization($jwt, $key, $hash){
        try{
            $jwt=null;
            foreach (getallheaders() as $name => $value) {
                if($name == "Authorization"){
                    $jwt = substr($value, 7);
                }
            }
            $decoded = JWT::decode($jwt, new Key($key, $hash));
            $decoded_array = (array) $decoded;
    
            if(time() < $decoded_array["exp"]){
                return true;
            }
            else{
                return false;
            }
        }catch (\Exception $e){
            return false;
        }
    }

    // Testing the Request class
    $request = new Request();

    $request->accept = "application/json";

    $response = new Response();

    // echo "request method: ".$request->verb;
    // echo "<br/>";
    // echo "request parameters: ".$request->url_parameters;
    // var_dump($request->url_parameters);

    // NOTE-3:
    // Given a URL with a parameter "client=123"
    // we need to determine that this request is asking for the client with the ID 123
    // We need to implement a general way that allows us to load the appropriate controller depending on the URL parameter.
    // check Note-4

    // Get the target resource controller name
    $keys = array();
    $keys = array_keys($request->url_parameters);
    // var_dump($request);

    // $keys[0] in this case is -> 'client'
    // capitalize the first letter
    $controllerName = ucfirst($keys[0]).'Controller';
    // var_dump($controllerName);

    // Check whether the class $controllerName exists or not
    // class_exists takes a second parameter $autoload of type boolean and is true by default
    // so the $controllerName is matched by $classname in autoLoad($classname)
    if(class_exists($controllerName)){
        $controller = new $controllerName();
        // Testing
        // var_dump($controller->getAllClients());
        if($request->accept == "application/json"){
            if($request->verb == "GET"){
                if($controllerName == "authController"){
                    $key = $request->url_parameters["api"];
                    // var_dump($request->url_parameters);
    
                    $client = new ClientController();
                    $client = $client->getEntryByName($request->url_parameters["clientName"]);
                    // var_dump($client);
    
                    if($client["licenseKey"] == $key){
                        $payload = array(
                            "iss" => "http://localhost/client",
                            "aud" => "http://localhost/JustPi/justpi/api",
                            "iat" => time(),
                            "exp" => time() + 60 //In 1 minute
                        );
                        
                        $jwt = JWT::encode($payload, $key, $hash);
                        $response->payload = $jwt;
                    }
                }
                else{
                    if($request->url_parameters["formula"] != "all"){
                        $response->payload = json_encode($controller->getEntryById($request->url_parameters["formula"]));
                        // var_dump($request->url_parameters);
                    }
                    else{
                        $response->payload = json_encode($controller->getAllEntries());
                    }
                }
            }
            else if($request->verb == "POST"){
                try{
                    $jwt;
                    foreach (getallheaders() as $name => $value) {
                        if($name == "Authorization"){
                            $jwt = substr($value, 7);
                        }
                    }

                    $decoded = JWT::decode($jwt, new Key($key, $hash));
                    $decoded_array = (array) $decoded;
                    // print($jwt);
                    // print_r($decoded);
                    // var_dump($decoded_array);
            
                    if(time() < $decoded_array["exp"]){
                        $payload = json_decode($request->payload, true);
                        $client = new clientController();
                        $clientID = $client->getClient($payload["licenseKey"])["clientID"];
                        $fileName = strtok($payload['file'], '.');
                        $outputFileFormat = explode('/', $payload["targetFormat"])[1];
                        $insertPayload = json_encode(array(
                            'clientID'=>$clientID,
                            'requestDate'=>date("Y/m/d"),
                            'requestCompletionDate'=>date("Y/m/d"),
                            'originalFormat'=>$payload["originalFormat"],
                            'targetFormat'=>$payload["targetFormat"],
                            'file'=>$payload["file"],
                            'outputFile'=>$fileName.'.'.$outputFileFormat
                        ));
                        $insertPayload = json_decode($insertPayload,true);
                        $controller->insert($insertPayload);
                        $response->payload = "HTTP/1.1 201 CREATED";
                    }
                    else{
                        $response->payload = "HTTP/1.1 401 Unauthorized";
                    }
                }catch (\Exception $e){
                    echo $e;
                }

                // $payload = json_decode($request->payload, true);
                // $client = new clientController();
                // $clientID = $client->getClient($payload["licenseKey"])["clientID"];
                // $fileName = strtok($payload['file'], '.');
                // $outputFileFormat = explode('/', $payload["targetFormat"])[1];
                // $insertPayload = json_encode(array(
                //     'clientID'=>$clientID,
                //     'requestDate'=>date("Y/m/d"),
                //     'requestCompletionDate'=>date("Y/m/d"),
                //     'originalFormat'=>$payload["originalFormat"],
                //     'targetFormat'=>$payload["targetFormat"],
                //     'file'=>$payload["file"],
                //     'outputFile'=>$fileName.'.'.$outputFileFormat
                // ));
                // $insertPayload = json_decode($insertPayload,true);
                // $controller->insert($insertPayload);
                $response->payload = "HTTP/1.1 201 CREATED";
            }
            else if($request->verb == "DELETE"){
                
            }
            else{
                var_dump("This is NOT a proper request.");
            }
        }

        echo $response->payload;
    }
?>