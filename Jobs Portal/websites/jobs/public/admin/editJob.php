<?php
// Start the session
session_start();
// Include JobsController class to handle applicants related actions
require('../controllers/JobsController.php');
// Include CategoriesController class to handle categories related actions
require('../controllers/CategoriesController.php');
// Create an object of the JobsController class
$jobsController = new JobsController();
// Create an object of the CategoriesController class
$categoriesController = new CategoriesController();

// Handle Edit Job request
// Check if the Edit button was clicked and the job id is set
if(isset($_POST['edit-submit']) && isset($_POST['jobId'])){
	// Check if the required parameters are set
	if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['salary']) && isset($_POST['location']) && isset($_POST['categoryId']) && isset($_POST['closingDate'])){
        $jobId = $_POST['jobId'];	
		$title = $_POST['title'];
		$desc = $_POST['description'];
		$salary = $_POST['salary'];
		$closingDate = $_POST['closingDate'];
		$categoryId = $_POST['categoryId'];
		$location = $_POST['location'];
		// Call the editJob function from the JobController class
		$success = $jobsController->editJob($jobId, $title, $desc, $salary, $closingDate, $categoryId, $location);
        if ($success) {
            header('Location: ./jobs.php?title=Jobs');
            exit();
        } else {
            echo 'Failed to Edit the job.';
        }
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Jo's Jobs - Edit Jobs</title>
</head>
<body>
	<h2>Edit Job</h2>
	<form action="./editJob.php" method="POST">
	<?php
	$sql = $Connection->prepare('SELECT * FROM jobs WHERE id = ?');
	$sql->execute([$_GET['id']]);
	$stmt = $sql->fetch(PDO::FETCH_ASSOC);
	?>
	<input type="hidden" name="jobId" value="<?=$stmt['id']?>" />
	<label for="title">Title</label>
    <input type="text" name="title" id="title" value="<?=$stmt['title']?>" required />
    <br />
	<label for="description">Description</label>
	<br />
    <textarea name="description" id="description" cols="60" rows="20" required><?=$stmt['description']?></textarea>
	<br />
	<label for="salary">Salary</label>
    <input type="text" name="salary" id="salary" value="<?=$stmt['salary']?>" required />
	<br />
	<label for="closingDate">Closing Date</label>
	<input type="date" name="closingDate" id="closingDate" value="<?=$stmt['closingDate']?>" required />
	<br/>
	<label for="categoryId">Category</label>
	<select name="categoryId" id="categoryId" required>
		<?php
			$categories = $categoriesController->showAllCategories();
			foreach ($categories as $row) {
				// Pre select the currently set category
				$selected = ($row['id'] == $stmt['categoryId']) ? 'selected' : '';
				echo '<option value="' .$row['id']. '" ' .$selected. '>' .$row['name']. '</option>';
			}
		?>
	</select>
	<br />
	<label for="location">Location</label>
	<input type="text" name="location" id="location" value="<?=$stmt['location']?>" required/>
	<br />
	<input type="submit" name="edit-submit" value="Save Changes" />
	</form>
</body>
</html>