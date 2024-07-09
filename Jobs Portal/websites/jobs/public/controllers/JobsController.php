<?php
// Require the dbConnection.php file to establish connection with the database
require_once('../dbConnection.php');
// Controller class to handle Jobs related actions
class JobsController {
    private $Conn;
    // Default Constructor
    public function __construct() {
        global $Connection; // Access the $Connection variable from dbConnection.php
        $this->Conn = $Connection;
    }
    // Function to INSERT job into the jobs table
    public function addJob($title, $description, $salary, $postedDate, $closingDate, $categoryId, $clientId, $location) {
        $sql = 'INSERT INTO jobs(title, description, salary, postedDate, closingDate, categoryId, clientId, location) VALUES(?, ?, ?, ?, ?, ?, ?, ?)';
        $stmt = $this->Conn->prepare($sql);
        return $stmt->execute([$title, $description, $salary, $postedDate, $closingDate, $categoryId, $clientId, $location]);
    }
    // Function to DELETE job FROM the jobs table 
    public function deleteJob($jobId) {
        $stmt = $this->Conn->prepare('DELETE FROM jobs WHERE id = ?');
        return $stmt->execute([$jobId]);
    }
    // Function to UPDATE job in the jobs table
    public function editJob($jobId, $title, $description, $salary, $closingDate, $categoryId, $location) {
        $sql = 'UPDATE jobs SET title=?, description=?, salary=?, closingDate=?, categoryId=?, location=? WHERE id = ?';
        $stmt = $this->Conn->prepare($sql);
        return $stmt->execute([$title, $description, $salary, $closingDate, $categoryId, $location, $jobId]);
    }
    // Function to ARCHIVE a job
    public function archiveJob($jobId) {
        $stmt = $this->Conn->prepare('UPDATE jobs SET isArchive = "Y" WHERE id = :jobId');
        return $stmt->execute(['jobId' => $jobId]);
    }
    // Function to UNARCHIVE a job
    public function unarchiveJob($jobId) {
        $stmt = $this->Conn->prepare('UPDATE jobs SET isArchive = "N" WHERE id = :jobId');
        return $stmt->execute(['jobId' => $jobId]);
    }
    // Function to SELECT all active jobs from the jobs table that have a closing date in the future and their associated category name from the categories table
    public function showAllJobs() {
        $sql = 'SELECT j.*,c.name FROM jobs j INNER JOIN categories c ON j.categoryId = c.id WHERE j.isArchive = "N" AND j.closingDate > NOW() ORDER BY j.postedDate DESC';
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Function to SELECT all the archived jobs
    public function showArchivedJobs(){
        $sql = 'SELECT j.*,c.name FROM jobs j INNER JOIN categories c ON j.categoryId = c.id WHERE j.isArchive = "Y" AND j.closingDate > NOW() ORDER BY j.postedDate DESC';
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Function to SELECT all jobs associated to a specific client FROM the jobs table
    public function showClientJobs($clientId){
        $sql = 'SELECT j.*, c.name FROM jobs j INNER JOIN categories c ON j.categoryId = c.id WHERE j.isArchive = "N" AND j.closingDate > NOW() AND j.clientId = ?';
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute([$clientId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
