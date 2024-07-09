<?php
// Require the dbConnection.php file to establish connection with the database
require_once('../dbConnection.php');
// Controller class to handle Users related actions
class UsersController {
    private $Conn;
    // Default Constructor
    public function __construct() {
        global $Connection; // Access the $Connection variable from dbConnection.php
        $this->Conn = $Connection;
    }
    // Function to SELECT all the staffs FROM the staffs table
    public function showAllStaffs(){
        $sql = 'SELECT * FROM staffs';
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Function to INSERT staff into the staffs table
    public function addStaff($username, $password) {
        $sql = 'INSERT INTO staffs(username, password) VALUES(?, ?)';
        $stmt = $this->Conn->prepare($sql);
        return $stmt->execute([$username, $password]);
    }
    // Function to DELETE staff FROM the staffs table
    public function deleteStaff($staffId){
        $sql = 'DELETE FROM staffs WHERE staff_id = ?';
        $stmt = $this->Conn->prepare($sql);
        return $stmt->execute([$staffId]);
    }
    // Function to INSERT client into the clients table
    public function addClient($username, $password) {
        $sql = 'INSERT INTO clients(username, password) VALUES(?, ?)';
        $stmt = $this->Conn->prepare($sql);
        return $stmt->execute([$username, $password]);
    }
}