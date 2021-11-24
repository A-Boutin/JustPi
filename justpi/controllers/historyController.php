<?php
    require_once("../model/formula.php");
    require_once("../database/connectionManager.php");

    class ClientController{
        private $connectionManager;
        private $dbConnection;

        function __construct(){
            $this->connectionManager = new ConnectionManager();
            $this->dbConnection = $this->connectionManager->getConnection();
        }

        // function getClient($licenseKey){
        //     $client = new client();
        //     return $client->getClient($licenseKey);
        // }

        // function getAllClients(){
        //     $client = new client();
        //     return $client->getAllClients();
        // }
    }
    //Testing the controller
    // $clientController = new ClientController();
    // var_dump($clientController->getAllClients());
?>