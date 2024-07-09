<?php
// Require the dbConnection.php file to establish connection with the database
require('./dbConnection.php');
// Set variables value
$jobTitle = $_GET['title'];
$jobId = $_GET['id'];
$title = 'Apply';
$mainClass = 'sidebar';
$output = '';

// Handle Application Submit request
// Check if the Submit button was clicked
if(isset($_POST['submit'])){
    if($_FILES['cv']['error'] == 0){
        $parts = explode('.', $_FILES['cv']['name']);
		$extension = end($parts);
		$fileName = uniqid() . '.' . $extension;
		move_uploaded_file($_FILES['cv']['tmp_name'], 'cvs/' . $fileName);
		$criteria = [
			'name' => $_POST['name'],
			'email' => $_POST['email'],
			'details' => $_POST['details'],
			'jobId' => $_POST['jobId'],
			'cv' => $fileName
		];
		// Insert the record into applicants table
		$stmt = $Connection->prepare('INSERT INTO applicants(name, email, details, jobId, cv) VALUES(:name, :email, :details, :jobId, :cv)');
		$stmt->execute($criteria);

		$output .= 'Your application is complete. You will be contacted soon.';
    } else {
        $output .= 'There was a problem uploading your CV.';
    }
} else{ // Since the form was not submitted, show the form
    $output .= '
	<section class="right">
    <h2>Application for ' .$jobTitle. '</h2>
    
    <form action="./apply.php?title=' .$jobTitle. '&id=' .$jobId. '" method="POST" enctype="multipart/form-data">
	<label>Full Name</label>
	<input type="text" name="name" required/>

	<label>Email Address</label>
	<input type="text" name="email" required/>

	<label>Cover Letter</label>
	<textarea name="details" cols="60" rows="20" required></textarea>

	<label>CV</label>
	<input type="file" name="cv" required/>

	<input type="hidden" name="jobId" value="' .$jobId. '" required/>

	<input type="submit" name="submit" value="Apply" />

	</form>
    </section>
    ';
}
// Call the layout.html.php that is the layout of the page
require('./templates/layout.html.php');