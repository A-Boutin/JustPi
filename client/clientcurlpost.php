<?php
    //EXAMPLE
    $url = "http://localhost/videoconversionservice/api";

    $data = json_encode(array(
        'licenseKey'=>'KEYABC123',
        'originalFormat'=>'video/mp4',
        'targetFormat'=>'video/avi',
        'file'=>'example.mp4',
    ));
    $payload = json_encode($data);
    // create a new cURL resource
    $ch = curl_init();

    // set URL and other appropriate options
    curl_setopt($ch, CURLOPT_POST, true);    
    curl_setopt($ch, CURLOPT_URL, "http://localhost/videoconversionservice/api/videoconversion/");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec($ch);
    echo $server_output;

    // close cURL reource, and free up system resources
    curl_close($ch);

    // var_dump($server_output);
?>