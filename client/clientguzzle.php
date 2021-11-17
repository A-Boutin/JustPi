<?php
    //EXAMPLE
    require 'vendor/autoload.php';

    $client = new GuzzleHttp\Client();
    $res = $client->request('GET', 'http://localhost/videoconversionservice/api/client/all', ['headers' => ['Content-Type' => 'application/json']]);
    // echo $res->getStatusCode();
    // "200"
    // echo $res->getHeader('content-type')[0];
    echo $res->getBody();
?>