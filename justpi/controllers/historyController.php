<?php
    require_once("../model/formula.php");
    require_once("../model/history.php");
    require_once("../database/connectionManager.php");

    class HistoryController{
        private $connectionManager;
        private $dbConnection;

        function __construct(){
            $this->connectionManager = new ConnectionManager();
            $this->dbConnection = $this->connectionManager->getConnection();
        }

        function calculateResult($formulaId, $variables){
            $formula = new formula();
            $formula = $formula->getEntryById($formulaId);
            // var_dump($formula);
            $formulaVariables = explode(" ", $formula[0]["variables"]);
            $finishedFormula = $formula[0]["formula"];
            for($i=0; $i < count($formulaVariables); $i++){
                $finishedFormula = str_replace($formulaVariables[$i], $variables[$i], $finishedFormula);
            }
            $result = eval('return '.$finishedFormula.';');
            return $result;
        }

        function insert($clientId, $formulaId, $variables){
            $historyController = new historyController();
            $result = $historyController->calculateResult($formulaId, $variables);
            $history = new history($clientId, $formulaId, $variables, $result);
            $history->insert();
            return $result;
        }

        // function insert($json){
        //     $videoconversion = new videoconversion($json["clientID"], $json["requestDate"], $json["requestCompletionDate"], $json["originalFormat"], $json["targetFormat"], $json["file"], $json["outputFile"]);
        //     // var_dump($videoconversion);
        //     $videoconversion->insert();
        // }

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