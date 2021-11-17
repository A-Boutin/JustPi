<?php
    //EXAMPLE
    // https://github.com/firebase/php-jwt (For JWT referencing for lab 11)

    // create a new cURL resource
    $ch = curl_init();

    // set URL and other appropriate options
    curl_setopt($ch, CURLOPT_URL, "http://localhost/videoconversionservice/api/client/all");
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_exec($ch);

    // close cURL reource, and free up system resources
    curl_close($ch);
?>