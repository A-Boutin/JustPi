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
        
        function getEntry($licenseKey){
            $query = "select * from client where licenseKey='".$licenseKey."'";
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

        function addClient(){
            $query = 'INSERT INTO client (client_id, license_key, client_name, license_start_date, license_end_date) VALUES (:client_id, :license_key, :client_name, :license_start_date, license_end_date)';
            $statement = $this->dbConnection->prepare($query);
            $statement->execute(['client_id'=>$this->client_id, 'license_key'=>$this->license_key, 'client_name'=>$this->client_name, 'license_start_date'=>$this->license_start_date, 'license_end_date'=>$this->license_end_date]);
        }
}
?>