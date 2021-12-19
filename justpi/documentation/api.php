<?php
// var_dump($_SERVER["DOCUMENT_ROOT"]."/JustPi/justpi/controllers");
require($_SERVER["DOCUMENT_ROOT"]."/JustPi/vendor/autoload.php");
$openapi = \OpenApi\Generator::scan([$_SERVER["DOCUMENT_ROOT"]."/JustPi/justpi/controllers"]);
header('Content-Type: application/x-yaml');
echo $openapi->toYaml();