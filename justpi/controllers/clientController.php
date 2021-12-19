<?php
/**
* @OA\Info(title="JustPi API", version="1.0")
*/
    require_once("../model/client.php");
    require_once("../database/connectionManager.php");

    class ClientController{
        private $connectionManager;
        private $dbConnection;

        function __construct(){
            $this->connectionManager = new ConnectionManager();
            $this->dbConnection = $this->connectionManager->getConnection();
        }

        /**
         * @OA\GET(path="justpi/api/client/{id}", tags={"Client"}, summary="Gets client specified by the id",
         * @OA\Response(response="200", description="OK"), 
         * @OA\Response(response="401", description="Unauthorized"),
         * )
         */
        function getEntryById($clientId){
            $client = new client();
            return $client->getEntryById($clientId);
        }

        function getEntry($licenseKey){
            $client = new client();
            return $client->getEntry($licenseKey);
        }
        /**
         * @OA\GET(path="justpi/api/client/all", tags={"Client"}, summary="Gets all clients",
         * @OA\Response(response="200", description="OK"), 
         * @OA\Response(response="401", description="Unauthorized"),
         * )
         */
        function getAllEntries(){
            $client = new client();
            return $client->getAllEntries();
        }

        function getEntryByName($clientName){
            $client = new client();
            return $client->getEntryByName($clientName);
        }

        /**
         * @OA\POST(path="justpi/api/client/insert", tags={"Client"}, summary="Inserts a client",
         * @OA\Parameter(name="clientName", in="query", description="Specifies the name of the new client", required=true),
         * @OA\Parameter(name="licenseKey", in="query", description="Specifies the license key the new client will have", required=true),
         * @OA\Response(response="200", description="OK"), 
         * @OA\Response(response="401", description="Unauthorized"),
         * )
         */
        function insert($licenseKey, $clientName){
            $licenseStartDate = date("Y/m/d");
            $licenseEndDate = date("Y/m/d", strtotime('+1 week'));
            $client = new client(null, $licenseKey, $clientName, $licenseStartDate, $licenseEndDate);
            $client->insert();
            return;
        }
    }
    //Testing the controller
    // $clientController = new ClientController();
    // var_dump($clientController->getAllClients());
?>