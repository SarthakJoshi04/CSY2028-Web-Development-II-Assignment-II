<?php
// Require the dbConnection.php file to establish connection with the database
require_once('../dbConnection.php');
// Controller class to handle Categories related actions
class CategoriesController{
    private $Conn;
    // Default Constructor
    public function __construct() {
        global $Connection; // Access the $Connection variable from dbConnection.php
        $this->Conn = $Connection;
    }
    // Function to SELECT all categories FROM the categories table
    public function showAllCategories(){
        $sql = 'SELECT * FROM categories';
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Function to INSERT category into the categories table
    public function addCategory($name){
        $sql = 'INSERT INTO categories(name) VALUES(?)';
        $stmt = $this->Conn->prepare($sql);
        return $stmt->execute([$name]);
    }
    // Function to UPDATE a category in the categories table
    public function editCategory($categoryId, $name){
        $sql = 'UPDATE categories SET name=? WHERE id = ?';
        $stmt = $this->Conn->prepare($sql);
        return $stmt->execute([$name, $categoryId]);
    }
    // Function to DELETE a category FROM the categories table
    public function deleteCategory($categoryId){
        $sql = 'DELETE FROM categories WHERE id = ?';
        $stmt = $this->Conn->prepare($sql);
        return $stmt->execute([$categoryId]);
    }
}