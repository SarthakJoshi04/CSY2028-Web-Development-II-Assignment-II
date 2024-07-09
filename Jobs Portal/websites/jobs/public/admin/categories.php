<?php
// Start the session
session_start();
// Include CategoriesController class to handle categories related actions
require('../controllers/CategoriesController.php');
// Create an object of the CategoriesController class
$categoriesController = new CategoriesController();

// Handle Delete Category request
// Check if the Delete button was clicked and the category id is set
if(isset($_POST['delete-submit']) && isset($_POST['id'])){
	// Check if the user is an admin or a staff member
    if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'staff'){
		// Call the deleteCategory function from the class
        $success = $categoriesController->deleteCategory($_POST['id']);
        if ($success) {
            header('Location: ./categories.php?title=Categories');
            exit();
        } else {
            echo 'Failed to Delete the category.';
        }
    }
}
// Set variables value
$title = $_GET['title'];
$user = $_SESSION['username'];
$mainClass = 'sidebar';
$output = '';

if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'staff'){
	$output .= '
		<section class="right">
		<h2>Categories</h2>
		<a href="./addCategory.php" class="new">Add new Category</a>
		<table>
		<thead>
		<tr>
		<th>Category Name</th>
		<th style="width: 5%">&nbsp;</th>
		<th style="width: 5%">&nbsp;</th>
		</tr>
	';
	$categories = $categoriesController->showAllCategories();
	foreach($categories as $category){
		$output .= '
			<tr>
			<td>' .$category['name']. '</td>
			<td><a style="float: right" href="./editCategory.php?id=' .$category['id']. '">Edit</a></td>
			<td><form action="./categories.php" method="POST">
			<input type="hidden" name="id" value="' . $category['id'] . '" />
			<input type="submit" name="delete-submit" value="Delete" /></form>
			</td>
			</tr>
		';
	}
	$output .= '
		</thead>
		</table>
	';
} else{
	$output .= '
		<p>You don\'t have access to this page</p>;
	';
}
// Call the admin.html.php that is the layout of the page
require('../templates/admin.html.php');