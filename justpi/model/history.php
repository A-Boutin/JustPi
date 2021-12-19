<?php
    require_once('../controllers/clientController.php');
    class History{
        private $historyId;
        private $formulaId;
        private $clientID;
        private $variables;
        private $result;
        private $creationDate;
        
        private $connectionManager;
        private $dbConnection;

        // function __construct(){
        //     $this->connectionManager = new ConnectionManager();
        //     $this->dbConnection = $this->connectionManager->getConnection();
        // }

        function __construct($clientId=null, $formulaId=null, $variables=null, $result=null){
            $this->clientID = $clientId;
            $this->formulaId = $formulaId;
            $this->variables = $variables;
            $this->result = $result;

            $this->connectionManager = new ConnectionManager();
            $this->dbConnection = $this->connectionManager->getConnection();
        }
        
        function getAllUserHistory($clientID){

            $query = "select * from history where client_id = '".$clientID."'";
            $statement = $this->dbConnection->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        function getEntryById($historyId) {
            $query = "select * from history where history_id = '".$historyId."'";
            $statement = $this->dbConnection->prepare($query);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        function getAllEntries(){
            $query = "select * from history";
            $statement = $this->dbConnection->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        function getFormulaFromId($formulaId){
            $query = "select * from formula where formula_id='".$formulaId."'";
            $statement = $this->dbConnection->query($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        function insert(){
            $query = 'INSERT INTO history (client_id, formula_id, variables, result) VALUES (:client_id, :formula_id, :variables, :result)';
            $statement = $this->dbConnection->prepare($query);
            $statement->execute(['client_id'=>$this->clientID, 'formula_id'=>$this->formulaId, 'variables'=>$this->variables, 'result'=>$this->result]);
        }
}
?>