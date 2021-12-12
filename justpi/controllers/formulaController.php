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

        function getEntryById($formulaId){
            $formula = new formula();
            return $formula->getEntryById($formulaId);
        }

        function getEntry($formula){
            $formula = new formula();
            return $formula->getEntry($formula);
        }

        function getAllEntries(){
            $formula = new formula();
            return $formula->getAllEntries();
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
            return '<img src="data:image/jpeg;base64,'.base64_encode( $formula['link'] ).'"/>';
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