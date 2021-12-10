<?php
    require_once("../model/formula.php");
    require_once("../database/connectionManager.php");

    class FormulaController{
        private $connectionManager;
        private $dbConnection;

        function __construct(){
            $this->connectionManager = new ConnectionManager();
            $this->dbConnection = $this->connectionManager->getConnection();
        }

        function getEntry($formulaId){
            $formula = new formula();
            return $formula->getEntry($formulaId);
        }

        function getAllEntries(){
            $formula = new formula();
            return $formula->getAllEntries();
        }

        // function insert($json){
        //     $videoconversion = new videoconversion($json["clientID"], $json["requestDate"], $json["requestCompletionDate"], $json["originalFormat"], $json["targetFormat"], $json["file"], $json["outputFile"]);
        //     // var_dump($videoconversion);
        //     $videoconversion->insert();
        // }
    }
    //Testing the controller
    // $clientController = new ClientController();
    // var_dump($clientController->getAllClients());
?>