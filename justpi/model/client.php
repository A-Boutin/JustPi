<?php
    require_once('../controllers/clientController.php');
    class Client{
        private $clientId;
        private $licenseKey;
        private $clientName;
        private $licenseStartDate;
        private $licenseEndDate;
        
        private $connectionManager;
        private $dbConnection;

        function __construct(){
            $this->connectionManager = new ConnectionManager();
            $this->dbConnection = $this->connectionManager->getConnection();
        }

        // function __construct($clientName, $licenseNumber, $licenseStartDate, $licenseEndDate, $licenseKey){
        //     $this->clientName = $clientName;
        //     $this->licenseNumber = $licenseNumber;
        //     $this->licenseStartDate = $licenseStartDate;
        //     $this->licenseEndDate = $licenseEndDate;
        //     $this->licenseKey = $licenseKey;
        // }
        
        function getClient($licenseKey){
            $query = "select * from client where licenseKey='".$licenseKey."'";
            $statement = $this->dbConnection->query($query);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
        
        function getAllClients(){

            $query = "select * from client";
            $statement = $this->dbConnection->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
}
?>