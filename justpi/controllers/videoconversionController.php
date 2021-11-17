<?php
    require_once("../model/videoconversion.php");
    require_once("../database/connectionManager.php");

    class VideoconversionController{
        private $connectionManager;
        private $dbConnection;

        function __construct(){
            $this->connectionManager = new ConnectionManager();
            $this->dbConnection = $this->connectionManager->getConnection();
        }

        function insert($json){
            $videoconversion = new videoconversion($json["clientID"], $json["requestDate"], $json["requestCompletionDate"], $json["originalFormat"], $json["targetFormat"], $json["file"], $json["outputFile"]);
            // var_dump($videoconversion);
            $videoconversion->insert();
        }
    }
    //Testing the controller
    // $clientController = new ClientController();
    // var_dump($clientController->getAllClients());
?>