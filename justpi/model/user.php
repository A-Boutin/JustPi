<?php
    require_once('../controllers/userController.php');
    class User{
        private $userId;
        private $clientId;
        private $username;
        private $pass_hash;
        
        private $connectionManager;
        private $dbConnection;

        function __construct(){
            $this->connectionManager = new ConnectionManager();
            $this->dbConnection = $this->connectionManager->getConnection();
        }
        
        function getAllUsersFromClient($clientId){
            $query = "select * from user where client_id = '".$clientId."'";
            $statement = $this->dbConnection->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public function find($username) {
            $query = "select * from user where username = '".$username."'";
            $statement = $this->dbConnection->prepare($query);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
?>