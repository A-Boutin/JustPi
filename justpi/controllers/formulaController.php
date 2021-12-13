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

        function getEntryByName($formulaName){
            $formula = new formula();
            return $formula->getEntryById($formulaName);
        }

        function getEntryById($formulaId){
            $formula = new formula();
            $formula = $formula->getEntryById($formulaId);
            $formula[0]["description"] = "<img src='".$formula[0]['description']."'width='175' height='200'/>"; 
            return $formula;
        }

        function getEntry($formula){
            $formula = new formula();
            $formula = $formula->getEntry($formula);
            $formula[0]["description"] = "<img src='".$formula[0]['description']."'width='175' height='200'/>"; 
            return $formula;
        }

        function getAllEntries(){
            $formulas = new formula();
            $formulas = $formulas->getAllEntries();
            for($i=0; $i<sizeof($formulas); $i++){
                $formulas[$i]["description"] = "<img src='".$formulas[$i]['description']."'width='175' height='200'/>"; 
            } 
            return $formulas;
        }

        function getResult($clientId, $formulaId, $variables){
            $historyController = new historyController();
            return $historyController->insert($json);
        }

        function getFormulaByLink($description) {
            $formula = new formula();
            return $formula->getEntryByLink($description);
        }

        function displayFormulaImg($formulaID) {
            $formula = new FormulaController();
            $formula = $formula->getEntryByID($formulaID);
            return '<img src="data:image/jpeg;base64,'.base64_encode( $formula['description'] ).'"/>';
        }

        function getImgByLink($link) {
            $formula = new FormulaController();
            $formula = $formula->getFormulaByLink($link);
            return '<img src="data:image/jpeg;base64,'.base64_encode( $formula['description'] ).'"/>';
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