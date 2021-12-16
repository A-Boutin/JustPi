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

        // function __construct(){
        //     $this->connectionManager = new ConnectionManager();
        //     $this->dbConnection = $this->connectionManager->getConnection();
        // }

        function __construct($clientId=null, $licenseKey=null, $clientName=null, $licenseStartDate=null, $licenseEndDate=null){
            $this->clientId = $clientId;
            $this->licenseKey = $licenseKey;
            $this->clientName = $clientName;
            $this->licenseStartDate = $licenseStartDate;
            $this->licenseEndDate = $licenseEndDate;
            
            $this->connectionManager = new ConnectionManager();
            $this->dbConnection = $this->connectionManager->getConnection();
        }
        
        function getEntryById($clientId){
            $query = "select * from client where client_id='".$clientId."'";
            $statement = $this->dbConnection->query($query);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        function getEntry($licenseKey){
            $query = "select * from client where licenseKey='".$licenseKey."'";
            $statement = $this->dbConnection->query($query);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        function getEntryByName($clientName){
            $query = "select * from client where client_name='".$clientName."'";
            $statement = $this->dbConnection->query($query);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
        
        function getAllEntries(){
            $query = "select * from client";
            $statement = $this->dbConnection->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        function insert(){
            $query = 'INSERT INTO client (license_key, client_name, license_start_date, license_end_date) VALUES (:license_key, :client_name, :license_start_date, license_end_date)';
            $statement = $this->dbConnection->prepare($query);
            $statement->execute(['license_key'=>$this->licenseKey, 'client_name'=>$this->clientName, 'license_start_date'=>$this->licenseStartDate, 'license_end_date'=>$this->licenseEndDate]);
        }
}
?>