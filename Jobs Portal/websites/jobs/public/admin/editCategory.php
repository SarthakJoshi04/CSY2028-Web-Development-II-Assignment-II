<?php
// Start the session
session_start();
// Include CategoriesController class to handle categories related actions
require('../controllers/CategoriesController.php');
// Create an object of the CategoriesController class
$categoriesController = new CategoriesController();

// Handle Update Category request
// Check if the Update button was clicked and the category id is set
if(isset($_POST['update-submit']) && isset($_POST['categoryId'])){
	// Check if the user is an admin or a staff member
    if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'staff'){
		// Call the editCategory function from the class
        $success = $categoriesController->editCategory($_POST['categoryId'], $_POST['name']);
        if ($success) {
            header('Location: ./categories.php?title=Categories');
            exit();
        } else {
            echo 'Failed to Update the category.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Jo's Jobs - Edit Category</title>
</head>
<body>
<h2>Edit Category</h2>
<form action="./editCategory.php" method="POST">
	<?php
	$sql = $Connection->prepare('SELECT * FROM categories WHERE id = ?');
	$sql->execute([$_GET['id']]);
	$stmt = $sql->fetch(PDO::FETCH_ASSOC);
	?>
	<input type="hidden" name="categoryId" value="<?php echo $stmt['id']; ?>">
	<label for="name">Category Name</label>
	<input type="text" name="name" id="name" value="<?php echo $stmt['name']?>" required />
	<br />
	<input type="submit" name="update-submit" value="Save Changes" />
</form>
</body>
</html>