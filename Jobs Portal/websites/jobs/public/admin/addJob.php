<?php
// Start the session
session_start();
// Include the JobsController class to handle jobs related actions
require('../controllers/JobsController.php');
// Include the CategoriesController class to handle categories related actions
require('../controllers/CategoriesController.php');
// Create an object of the JobsController class
$jobsController = new JobsController();
// Create an object of the CategoriesController class
$categoriesController = new CategoriesController();

// Handle Add Job request
// Check if the form was submitted
if(isset($_POST['add-submit'])){
	// Check if the user is a client
	if($_SESSION['role'] == 'client'){
		if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['salary']) && isset($_POST['location']) && isset($_POST['categoryId']) && isset($_POST['closingDate'])){
			$title = $_POST['title'];
			$desc = $_POST['description'];
			$salary = $_POST['salary'];
			$postedDate = date('Y-m-d');
			$closingDate = $_POST['closingDate'];
			$categoryId = $_POST['categoryId'];
			$clientId = $_SESSION['client_id']; // Add the clientId of the client that added the job
			$location = $_POST['location'];
			
			$insert = $jobsController->addJob($title, $desc, $salary, $postedDate, $closingDate, $categoryId, $clientId, $location);
			if($insert){
				echo '<script>
                alert("The job has been added.");
                window.location.href = "./addJob.php?title=Add Job";
            </script>';
			} else{
				echo 'Error posting the job.';
			}
		}
	} else{
		// The user is an admin or a staff member
		if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['salary']) && isset($_POST['location']) && isset($_POST['categoryId']) && isset($_POST['closingDate'])){
			$title = $_POST['title'];
			$desc = $_POST['description'];
			$salary = $_POST['salary'];
			$postedDate = date('Y-m-d');
			$closingDate = $_POST['closingDate'];
			$categoryId = $_POST['categoryId'];
			$clientId = NULL; // Set clientId to NULL
			$location = $_POST['location'];
			
			$insert = $jobsController->addJob($title, $desc, $salary, $postedDate, $closingDate, $categoryId, $clientId, $location);
			if($insert){
				echo '<script>
                alert("The job has been added.");
                window.location.href = "./addJob.php?title=Add Job";
            </script>';
			} else{
				echo 'Error posting the job.';
			}
		}
	}
} 


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Jo's Jobs - Add Job</title>
</head>

<body>
	<h2>Add Job</h2>

	<form action="./addJob.php" method="POST">
		<label for="title">Title</label>
		<input type="text" id="title" name="title" required/>
		<br />
		<label for="description">Description</label>
		<br />
		<textarea name="description" id="description" cols="60" rows="20" required></textarea>
		<br />
		<label for="salary">Salary</label>
		<input type="text" name="salary" id="salary" required/>
		<br />
		<label for="location">Location</label>
		<input type="text" name="location" id="location" required/>
		<br />
		<label for="categoryId">Category</label>
		<select name="categoryId" id="categoryId" required>
			<option value="" selected disabled>-- Select a Category --</option>
		<?php
			$categories = $categoriesController->showAllCategories();
			foreach ($categories as $row) {
				echo '<option value="' .$row['id']. '">' .$row['name']. '</option>';
			}
		?>
		</select>
		<br />
		<label for="closingDate">Closing Date</label>
		<input type="date" name="closingDate" id="closingDate" required/>
		<br />
		<input type="submit" name="add-submit" value="Add Job" />
	</form>
	<p><a href="./jobs.php?title=Jobs">Return Back</a></p>
</body>
</html>