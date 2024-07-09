<?php
// Database connection parameters
$servername = 'mysql';          // Server name or IP address where the database is hosted
$username = 'student';           // Database username
$password = 'student';           // Database password
$databasename = 'job';   // Name of the database

try {
    // Creating a new PDO (PHP Data Objects) connection
    $Connection = new PDO('mysql:dbname=' . $databasename . ';host=' . $servername, $username, $password);
    $Connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection Failed: ". $e->getMessage());
}