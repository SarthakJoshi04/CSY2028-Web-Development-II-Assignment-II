<?php
// Start the session
session_start();
// Include UsersController class to handle users related actions
require('../controllers/UsersController.php');
// Create an object of the UsersController class
$usersController = new UsersController();

// Handle Staff Delete request
// Check if the Delete button was clicked and the staff id is set
if(isset($_POST['delete-submit']) && isset($_POST['id'])){
	// Check if the user is an admin
    if($_SESSION['role'] == 'admin'){
		// Call the deleteStaff function from the class
        $success = $usersController->deleteStaff($_POST['id']);
        if ($success) {
        	header('Location: ./manageStaff.php?title=Manage Staffs');
            exit();
        } else{
            echo 'Failed to delete the staff.';
        }
    }
}
// Set variables value
$title = $_GET['title'];
$user = $_SESSION['username'];
$mainClass = 'sidebar';
$output = '';

if($_SESSION['role'] == 'admin'){
    $output .= '
		<section class="right">
		<h2>Manage Staffs</h2>
		<a href="./addStaff.php" class="new">Add new Staff</a>
		<table>
		<thead>
		<tr>
		<th style="width: 30%">Username</th
		<th style="width: 10%">&nbsp;</th>
		</tr>
	';
    $staffs = $usersController->showAllStaffs();
    foreach($staffs as $staff){
			$output .= '
			<tr>
			<td>' .$staff['username']. '</td>
			<td><form action="./manageStaff.php" method="POST">
            <input type="hidden" name="id" value="' . $staff['staff_id'] . '" />
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
    p>You don\'t have access to this page.</p>
    ';
}
// Call the admin.html.php that is the layout of the page
require('../templates/admin.html.php');