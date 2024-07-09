<?php
// Start the session
session_start();
// Include JobsController class to handle applicants related actions
require('../controllers/JobsController.php');
// Create an object of the JobsController class
$jobsController = new JobsController();

// Handle Job Unarchive request
// Check if the Unarchive button was clicked
if(isset($_POST['unarchive-submit']) && isset($_POST['id'])) {
	// Check if the job id is set
    if (isset($_POST['id'])) {
		// Call the unarchiveJob function from the class
        $success = $jobsController->unarchiveJob($_POST['id']);
		if ($success) {
            header('Location: ./archivedJobs.php?title=Archived Jobs');
			exit();
        } else {
            echo 'Failed to Unarchive the job.';
        }
    }
}

// Handle Job Delete request
// Check if the Delete button was clicked
if(isset($_POST['delete-submit']) && isset($_POST['id'])){
	// Check if the user is an admin or staff member
    if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'staff'){
		// Call the deleteJob function from the class
        $success = $jobsController->deleteJob($_POST['id']);
        if ($success) {
            header('Location: ./archivedJobs.php?title=Archived Jobs');
            exit();
        } else {
            echo 'Failed to Delete the job.';
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
		<h2>Archived Jobs</h2>
		<table>
		<thead>
		<tr>
		<th>Title</th>
		<th>Category</th>
		<th>Posted on</th>
		<th style="width: 15%">Salary</th>
		<th style="width: 15%">&nbsp;</th>
		<th style="width: 5%">&nbsp;</th>
		</tr>
	';
	$jobs = $jobsController->showArchivedJobs();
		
	foreach($jobs as $job){
		$output .= '
			<tr>
			<td>' .$job['title']. '</td>
			<td>' .$job['name']. '</td>
			<td>' .$job['postedDate']. '</td>
			<td>' .$job['salary']. '</td>
			<td><form action="./archivedJobs.php" method="POST">
            <input type="hidden" name="id" value="' . $job['id'] . '" />
			<input type="submit" name="delete-submit" value="Delete" /></form>
			</td>
			<td><form action="./archivedJobs.php" method="POST">
            <input type="hidden" name="id" value="' . $job['id'] . '" />
			<input type="submit" name="unarchive-submit" value="Unarchive" /></form>
			</td>
		';
	}
	$output .= '
		</thead>
		</table>
	';
} else{
	$output .= '
		<p>You don\'t have access to this page.</p>
	';
}
// Call the admin.html.php that is the layout of the page
require('../templates/admin.html.php');