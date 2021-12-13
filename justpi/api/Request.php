<?php
    class Request{
        public $verb;
        public $url_parameters;
        public $payload;
        public $payload_format;
        public $accept;

        function __construct(){
            // NOTE-1:
            // Apache the web server stores request information in the 
            // Global variable $_SERVER as an associative array.
            $this->verb = $_SERVER["REQUEST_METHOD"];

            // NOTE-2:
            // URL Parameters are passed as what we call a Query String
            // it is the part after the page name separated by a question mark ?
            // e.g.http://localhost/videoconversionservice/api/?client=1&isAttributes=clientName
            $this->url_parameters = array();
            parse_str($_SERVER["QUERY_STRING"], $this->url_parameters);
            
            $this->payload = file_get_contents('php://input');
            // $this->payload_format = $_SERVER["CONTENT_TYPE"];
        }
    }
?>