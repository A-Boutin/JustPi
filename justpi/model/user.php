<?php
    require_once('../controllers/clientController.php');
    class Client{
        private $userId;
        private $clientId;
        private $username;
        private $passHash;
        
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
}
?>