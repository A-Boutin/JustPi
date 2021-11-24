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

        function calculateResult($formulaId, $variables){
            $formula = new formula();
            $formula = $formula->getFormula($formulaId);
            $formulaVariables = explode(" ", $formula["variables"]);
            $finishedFormula = $formula["formula"];
            for($i=0; $i < count($variables); $i++){
                $finishedFormula = str_replace($formulaVariables[i], $variables[i], $finishedFormula);
            }
            $result = eval('return '.$finishedFormula.';');
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