<?php
    //EXAMPLE
    require 'vendor/autoload.php';

    $client = new GuzzleHttp\Client();
    $res = $client->request('POST', 'http://localhost/videoconversionservice/api/videoconversion/', 
        ['headers' => ['Content-Type' => 'application/json'],
        'body' => json_encode(array(
            'licenseKey'=>'KEYABC123',
            'originalFormat'=>'video/mp4',
            'targetFormat'=>'video/avi',
            'file'=>'example.mp4',
        ))]);
    // echo $res->getStatusCode();
    // "200"
    // echo $res->getHeader('content-type')[0];
    echo $res->getBody();
?>