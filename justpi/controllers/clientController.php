<?php
    require_once("../model/client.php");
    require_once("../database/connectionManager.php");

    class ClientController{
        private $connectionManager;
        private $dbConnection;

        function __construct(){
            $this->connectionManager = new ConnectionManager();
            $this->dbConnection = $this->connectionManager->getConnection();
        }

        function getEntryById($clientId){
            $client = new client();
            return $client->getEntryById($clientId);
        }

        function getEntry($licenseKey){
            $client = new client();
            return $client->getEntry($licenseKey);
        }

        function getAllEntries(){
            $client = new client();
            return $client->getAllEntries();
        }

        function getEntryByName($clientName){
            $client = new client();
            return $client->getEntryByName($clientName);
        }
    }
    //Testing the controller
    // $clientController = new ClientController();
    // var_dump($clientController->getAllClients());
?>