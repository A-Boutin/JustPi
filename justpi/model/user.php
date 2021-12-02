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

        function getUser($userId) {
            $query = "select * from user where user_id = '".$userId."'";
            $statement = $this->dbConnection->prepare($query);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        function addUser(){
            $query = 'INSERT INTO user (username) VALUES (:username)';
            $statement = $this->dbConnection->prepare($query);
            $statement->execute(['username'=>$this->username]);
        }

}
?>