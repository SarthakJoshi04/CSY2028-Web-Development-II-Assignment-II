<?php
// Start the session
session_start();
// Include the ApplicantsController class to handle applicants related actions
require('../controllers/ApplicantsController.php');
// Create an object of the ApplicantsController class
$applicantsController = new ApplicantsController();
// Set variables value
$title = "View Applicants";
$user = $_SESSION['username'];
$mainClass = 'sidebar';

$output = '
	<section class="right">
	<h2>Applicants for ' .$_GET['name']. '</h2>
	<table>
	<thead>
	<tr>
	<th style="width: 10%">Name</th>
	<th style="width: 10%">Email</th>
	<th style="width: 65%">Details</th>
	<th style="width: 15%">CV</th>
	</tr>
';
// Call the showJobApplicants function from the class
$applicants = $applicantsController->showJobApplicants($_GET['id']);
foreach($applicants as $applicant){
	$output .= '
		<tr>
		<td>' .$applicant['name']. '</td>
		<td>' . $applicant['email'] . '</td>
		<td>' .$applicant['details']. '</td>
		<td><a href="../cvs/' .$applicant['cv']. '">Download CV</a></td>
		</tr>
	';
}

$output .= '
	</thead>
	</table>
';
// Call the admin.html.php that is the layout of the page
require('../templates/admin.html.php');