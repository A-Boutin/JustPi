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

        function __construct(){
            $this->connectionManager = new ConnectionManager();
            $this->dbConnection = $this->connectionManager->getConnection();
        }
        
        function getAllUserHistory($clientID){

            $query = "select * from history where client_id = '".$clientID."'";
            $statement = $this->dbConnection->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        function getEntry($clientID) {
            $query = "select * from user where client_id = '".$clientID."'";
            $statement = $this->dbConnection->prepare($query);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        function getFormulaFromId($formulaId){
            $query = "select * from formula where formula_id='".$formulaId."'";
            $statement = $this->dbConnection->query($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        function insert(){
            $query = 'INSERT INTO history (formula_id, user_id, variables, result) VALUES (:formula_id, :client_id, :variables, :result)';
            $statement = $this->dbConnection->prepare($query);
            $statement->execute(['formula_id'=>$this->formulaId, 'client_id'=>$this->clientID, 'variables'=>$this->variables, 'result'=>$this->result]);
        }
}
?>