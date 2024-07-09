<?php
// Start the session
session_start();
// Include the dbConnection.php file to establish a connection with the database
require('../dbConnection.php');
// Set variables value
$title = 'Admin Area';
$user = $_SESSION['username'];
$mainClass = 'sidebar';

$output = '';
if (isset($_SESSION['logged-in']) && $_SESSION['logged-in']) {
	$output .= '
		<section class="right">
		<h2>You are now logged into the Admin area.</h2>
		<p>You will be granted access based on your role.</p>
		</section>
	';
} else{
	header('Location: ../index.php');
	exit();
}
// Call the admin.html.php that is the layout of the page
require('../templates/admin.html.php');