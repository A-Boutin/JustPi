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

        /**
         * @OA\POST(path="justpi/api/formula/getResult", tags={"History"}, summary="Inserts into history (Calculates results of specified formula using inputted variables)",
         * @OA\Parameter(name="formulaName", in="query", description="Specifies the name of the formula you'd like to use", required=true),
         * @OA\Parameter(name="variables", in="query", description="Specifies the variables you are inputting", required=true),
         * @OA\Response(response="200", description="OK"), 
         * @OA\Response(response="401", description="Unauthorized"),
         * )
         */
        function insert($clientId, $formulaId, $variables){
            $historyController = new historyController();
            $result = $historyController->calculateResult($formulaId, $variables);
            $history = new history($clientId, $formulaId, $variables, $result);
            $history->insert();
            return $result;
        }

        /**
         * @OA\GET(path="justpi/api/history/{id}", tags={"History"}, summary="Gets history specified by id",
         * @OA\Response(response="200", description="OK"), 
         * @OA\Response(response="401", description="Unauthorized"),
         * )
         */
        function getEntryById($historyId){
            $history = new history();
            return $history->getEntryById($historyId);
        }

        /**
         * @OA\GET(path="justpi/api/history/all", tags={"History"}, summary="Gets all history",
         * @OA\Response(response="200", description="OK"), 
         * @OA\Response(response="401", description="Unauthorized"),
         * )
         */
        function getAllEntries(){
            $history = new history();
            return $history->getAllEntries();
        }
    }
?>