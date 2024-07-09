<?php
// Start the session
session_start();
// Include the UsersController class to handle users related actions
require('../controllers/UsersController.php');
// Create an object of the UsersController class
$usersController = new UsersController();

// Handle the Add Staff request
// Check if the user is an admin
if($_SESSION['role'] == 'admin'){
  // Check if the form has been submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the required POST variables are set
    if (isset($_POST['username']) && isset($_POST['password'])) {
      // Secure the password
      $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
      // Call the addStaff function from the class
      $success = $usersController->addStaff($_POST['username'], $hashedPassword);
      if ($success) {
        echo 'Staff has been added.';
      } else {
        echo 'Failed to add the staff.';
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
  <title>Jo's Jobs - Add Staff</title>
</head>

<body>
  <h1>Add Staff</h1>
  <form action="./addStaff.php" method="POST">
    <label for="username">Username</label>
    <input type="text" name="username" id="username" required />
    <br />
    <label for="password">Password</label>
    <input type="password" name="password" id="password" required />
    <br />
    <button type="submit">Sign Up</button>
  </form>
  <p><a href="./manageStaff.php?title=Manage Staff">Return Back</a></p>
</body>

</html>