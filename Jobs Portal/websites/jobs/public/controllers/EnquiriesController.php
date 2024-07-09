<?php
// Require the dbConnection.php file to establish connection with the database
require_once('../dbConnection.php');
// Controller class to handle Enquiries related actions
class EnquiriesController{
    private $Conn;
    // Default Constructor
    public function __construct() {
        global $Connection; // Access the $Connection variable from dbConnection.php
        $this->Conn = $Connection;
    }
    // Function to SELECT enquiries FROM enquires table whose status is Pending
    public function showPendingEnquiries(){
        $sql = 'SELECT * FROM enquiries WHERE status = "Pending"';
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Function to SELECT enquiries FROM enquires table whose status is Completed
    public function showCompletedEnquiries(){
        $sql = 'SELECT e.*, s.username FROM enquiries e INNER JOIN staffs s ON e.completedBy = s.staff_id WHERE e.status = "Completed"';
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Function to UPDATE status and completedBy attribute of an enquiry in the enquiries table
    public function updateEnquiry($enquiryId, $staffId){
        $sql = 'UPDATE enquiries SET status = "Completed", completedBy = ? WHERE id = ?';
        $stmt = $this->Conn->prepare($sql);
        return $stmt->execute([$staffId, $enquiryId]);
    }
}