<?php
// Start the session
session_start();
// Include JobsController class to handle jobs related actions
require('../controllers/JobsController.php');
// Include the CategoriesController class to handle categories related actions
require('../controllers/CategoriesController.php');
// Create an object of the JobsController class
$jobsController = new JobsController();
// Create an object of the CategoriesController class
$categoriesController = new CategoriesController();

// Handle Job Archive request
// Check if the Archive button was clicked and the job id is set
if(isset($_POST['archive-submit']) && isset($_POST['id'])){
	// Check if the user is an admin or a staff member
    if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'staff'){
		// Call the archiveJob function from the class
        $success = $jobsController->archiveJob($_POST['id']);
        if ($success) {
            header('Location: ./jobs.php?title=Jobs');
            exit();
        } else {
            echo 'Failed to archive the job.';
        }
    }
}

// Handle Job Delete request
// Check if the Delete button was clicked and the job id is set
if(isset($_POST['delete-submit']) && isset($_POST['id'])){
		// Call the deleteJob function from the class
        $success = $jobsController->deleteJob($_POST['id']);
        if ($success) {
            header('Location: ./jobs.php?title=Jobs');
            exit();
        } else {
            echo 'Failed to Delete the job.';
        }
}
// Set variables value
$title = $_GET['title'] ?? 'Jobs'; // Sets the title to default if $_GET was not set
$user = $_SESSION['username'];
$mainClass = 'sidebar';
$output = '';

// Check if the user is an admin or a staff
if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'staff'){
	$output .= '
		<section class="right">
		<h2>Jobs</h2>
		<a href="./addJob.php" class="new">Add new Job</a>
		<table>
		<thead>
		<tr>
		<th>Title</th>
		<th>Category</th>
		<th>Posted on</th>
		<th style="width: 15%">Salary</th>
		<th style="width: 5%">&nbsp;</th>
		<th style="width: 15%">&nbsp;</th>
		<th style="width: 5%">&nbsp;</th>
		<th style="width: 5%">&nbsp;</th>
		</tr>
	';
	$jobs = $jobsController->showAllJobs(); // Show all available jobs
	foreach($jobs as $job){
		// Get the number of applicants for a specific job
		$applicants = $Connection->prepare('SELECT COUNT(*) AS count FROM applicants WHERE jobId = :job_id');
		$applicants->execute(['job_id' => $job['id']]);
		$applicantCount = $applicants->fetch();

		$output .= '
			<tr>
			<td>' .$job['title']. '</td>
			<td>' .$job['name']. '</td>
			<td>' .$job['postedDate']. '</td>
			<td>' .$job['salary']. '</td>
			<td><a style="float: right" href="./editJob.php?id=' .$job['id']. '">Edit</a></td>
			<td><a style="float: right" href="applicants.php?id=' .$job['id']. '&name=' .$job['title']. '">View applicants (' .$applicantCount['count']. ')</a></td>
			<td><form action="./jobs.php" method="POST">
			<input type="hidden" name="id" value="' . $job['id'] . '" />
			<input type="submit" name="delete-submit" value="Delete" /></form>
			</td>
			<td><form action="./jobs.php" method="POST">
			<input type="hidden" name="id" value="' . $job['id'] . '" />
			<input type="submit" name="archive-submit" value="Archive" /></form>
			</td>
			</tr>
		';
	}
	$output .= '
		</thead>
		</table>
		</section>
	';
} else{
	$client_id = $_SESSION['client_id']; // Get the client id from the session
	$output .= '
		<section class="right">
		<h2>Jobs</h2>
		<a href="./addJob.php" class="new">Add new Job</a>
		<table>
		<thead>
		<tr>
		<th>Title</th>
		<th>Category</th>
		<th style="width: 15%">Salary</th>
		<th style="width: 5%">&nbsp;</th>
		<th style="width: 15%">&nbsp;</th>
		<th style="width: 5%">&nbsp;</th>
		</tr>
	';
	$jobs = $jobsController->showClientJobs($client_id); // Show only the jobs associated with the client
	foreach($jobs as $job){
		$applicants = $Connection->prepare('SELECT COUNT(*) AS count FROM applicants WHERE jobId = :job_id');
		$applicants->execute(['job_id' => $job['id']]);
		$applicantCount = $applicants->fetch();

		$output .= '
			<tr>
			<td>' .$job['title']. '</td>
			<td>' .$job['name']. '</td>
			<td>' .$job['salary']. '</td>
			<td><a style="float: right" href="./editJob.php?id=' .$job['id']. '">Edit</a></td>
			<td><a style="float: right" href="applicants.php?id=' .$job['id']. '&name=' .$job['title']. '">View applicants (' .$applicantCount['count']. ')</a></td>
			<td><form action="./jobs.php" method="POST">
			<input type="hidden" name="id" value="' . $job['id'] . '" />
			<input type="submit" name="delete-submit" value="Delete" /></form>
			</td>
			</tr>
		';
	}
	$output .= '
		</thead>
		</table>
		</section>
	';
}
// Call the admin.html.php that is the layout of the page
require('../templates/admin.html.php');