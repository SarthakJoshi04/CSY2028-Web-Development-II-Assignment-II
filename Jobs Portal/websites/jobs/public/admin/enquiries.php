<?php
// Start the session
session_start();
// Include EnquiriesController class to handle enquiries related actions
require('../controllers/EnquiriesController.php');
// Create an object of the CategoriesController class
$enquiriesController = new EnquiriesController();

// Handle Complete Enquiry request
// Check if the Complete button was clicked and the enquiry id and staff id is set
if(isset($_POST['complete-submit']) && isset($_POST['enquiryId']) && isset($_POST['staffId'])){
		// Call the deleteCategory function from the class
        $success = $enquiriesController->updateEnquiry($_POST['enquiryId'], $_POST['staffId']);
        if ($success) {
            header('Location: ./enquiries.php?title=Enquiries');
            exit();
        } else {
            echo 'Failed to Complete the enquiry.';
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
		<h2>Completed Enquiries</h2>
		<table>
		<thead>
		<tr>
		<th>First Name</th>
        <th>Surname</th>
        <th>Email</th>
        <th>Telephone</th>
        <th style="width: 25%">Enquiry</th>
		<th>Completed By</th>
		</tr>
	';
    $enquiries = $enquiriesController->showCompletedEnquiries();
    foreach($enquiries as $enquiry){
        $output .= '
			<tr>
			<td>' .$enquiry['first_name']. '</td>
            <td>' .$enquiry['last_name']. '</td>
            <td>' .$enquiry['email']. '</td>
            <td>' .$enquiry['telephone']. '</td>
            <td>' .$enquiry['enquiry']. '</td>
            <td>' .$enquiry['username']. '</td>
			</tr>
		';
    }
    $output .= '
		</thead>
		</table>
	';
} elseif($_SESSION['role'] == 'staff'){
    $output .= '
		<section class="right">
		<h2>Enquiries</h2>
		<table>
		<thead>
		<tr>
		<th>First Name</th>
        <th>Surname</th>
        <th>Email</th>
        <th>Telephone</th>
        <th style="width: 25%">Enquiry</th>
		<th>Status</th>
        <th style="width: 3%">&nbsp;</th>
		</tr>
	';
    $enquiries = $enquiriesController->showPendingEnquiries();
    foreach($enquiries as $enquiry){
        $output .= '
			<tr>
			<td>' .$enquiry['first_name']. '</td>
            <td>' .$enquiry['last_name']. '</td>
            <td>' .$enquiry['email']. '</td>
            <td>' .$enquiry['telephone']. '</td>
            <td>' .$enquiry['enquiry']. '</td>
            <td>' .$enquiry['status']. '</td>
            <td><form action="./enquiries.php" method="POST">
			<input type="hidden" name="enquiryId" value="' . $enquiry['id'] . '" />
            <input type="hidden" name="staffId" value="' . $_SESSION['staff_id'] . '" />
			<input type="submit" name="complete-submit" value="Complete" /></form>
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