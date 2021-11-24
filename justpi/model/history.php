<?php
    require_once('../controllers/clientController.php');
    class History{
        private $historyId;
        private $formulaId;
        private $userId;
        private $variables;
        private $result;
        private $creationDate;
        
        private $connectionManager;
        private $dbConnection;

        function __construct(){
            $this->connectionManager = new ConnectionManager();
            $this->dbConnection = $this->connectionManager->getConnection();
        }
        
        function getAllUserHistory($userId){

            $query = "select * from history where user_id = '".$userId."'";
            $statement = $this->dbConnection->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        function insert(){
            $query = 'INSERT INTO history (formula_id, user_id, variables, result) VALUES (:formula_id, :user_id, :variables, :result)';
            $statement = $this->dbConnection->prepare($query);
            $statement->execute(['formula_id'=>$this->formulaId, 'user_id'=>$this->userId, 'variables'=>$this->variables, 'result'=>$this->result);
        }
}
?>