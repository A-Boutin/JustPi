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

        function getEntryById($historyId){
            $history = new history();
            return $history->getEntryById($historyId);
        }
    }
?>