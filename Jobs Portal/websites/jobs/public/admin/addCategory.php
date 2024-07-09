<?php
// Start the session
session_start();
// Include the CategoriesController class to handle categories related actions
require('../controllers/CategoriesController.php');
// Create an object of the CategoriesController class
$categoriesController = new CategoriesController();

// Handle the Add Category request
// Check if the user is an admin or a staff member
if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'staff'){
  // Check if the form has been submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the required POST variables are set
    if (isset($_POST['category_name'])) {
      // Call the addCategory function from the class
      $success = $categoriesController->addCategory($_POST['category_name']);
      if ($success) {
        echo 'A new Category has been added.';
      } else {
        echo 'Failed to add the Category.';
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
  <title>Jo's Jobs - Add Category</title>
</head>

<body>
  <h1>Add Category</h1>
  <form action="./addCategory.php" method="POST">
    <label for="category_name">Category Name</label>
    <input type="text" name="category_name" id="category_name" required />
    <br />
    <button type="submit">Add Category</button>
  </form>
  <p><a href="./categories.php?title=Categories">Return Back</a></p>
</body>

</html>