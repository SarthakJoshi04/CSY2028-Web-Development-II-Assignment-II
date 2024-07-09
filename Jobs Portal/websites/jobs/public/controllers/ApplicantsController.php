<?php
// Require the dbConnection.php file to establish connection with the database
require_once('../dbConnection.php');
// Controller class to handle Applicants related actions
class ApplicantsController{
    private $Conn;
    // Default Constructor
    public function __construct() {
        global $Connection; // Access the $Connection variable from dbConnection.php
        $this->Conn = $Connection;
    }
    // Function to SELECT all applicans associated to a job FROM the applicants table
    public function showJobApplicants($jobId){
        $sql = 'SELECT * FROM applicants WHERE jobId = ?';
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute([$jobId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}