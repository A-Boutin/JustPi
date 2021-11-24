<?php
    require_once('../controllers/clientController.php');
    class Client{
        private $formulaId;
        private $variables;
        private $formula;
        private $description;
        
        private $connectionManager;
        private $dbConnection;

        function __construct(){
            $this->connectionManager = new ConnectionManager();
            $this->dbConnection = $this->connectionManager->getConnection();
        }

        function getFormula($formula){
            $query = "select * from formula where formula='".$formula."'";
            $statement = $this->dbConnection->query($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        
        function getAllFormulas(){

            $query = "select * from formula";
            $statement = $this->dbConnection->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        function insert(){
            $query = 'INSERT INTO formula (variables, formula, description) VALUES (:variables, :formula, :description)';
            $statement = $this->dbConnection->prepare($query);
            $statement->execute(['variables'=>$this->variables, 'formula'=>$this->formula, 'description'=>$this->description]);
        }
}
?>