<?php
    require_once("../model/auth.php");
    require_once("../database/connectionManager.php");
    /**
     * @OA\GET(path="justpi/api/auth/authorize", tags={"Authentication"}, summary="Gets your JWT Token",
     * @OA\Parameter(name="clientName", in="query", description="Your client name", required=true),
     * @OA\Parameter(name="api", in="query", description="Your license key to be verified for authentication", required=true),
     * @OA\Response(response="200", description="OK"), 
     * @OA\Response(response="401", description="Unauthorized"),
     * )
     */
    class AuthController{
        private $connectionManager;
        private $dbConnection;

        function __construct(){
            $this->connectionManager = new ConnectionManager();
            $this->dbConnection = $this->connectionManager->getConnection();
        }

        function authorize(){}
    }
    //Testing the controller
    // $clientController = new ClientController();
    // var_dump($clientController->getAllClients());
?>