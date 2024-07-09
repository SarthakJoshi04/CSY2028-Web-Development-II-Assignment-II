<?php
// Start the session
session_start();
// Include the UsersController class to handle users related actions
require('../controllers/UsersController.php');
// Create an object of the UsersController class
$usersController = new UsersController();

// Handle Add Client request
// Check if the from submit button was clicked
if(isset($_POST['add-submit'])) {
  // Check if the required POST variables are set
  if (isset($_POST['username']) && isset($_POST['password'])) {
    // Secure the password
    $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
    // Call the addClient function from the class
    $success = $usersController->addClient($_POST['username'], $hashedPassword);
    if ($success) {
      echo '<script>
                alert("A new client has been added.");
                window.location.href = "./addClient.php?title=Add Client";
            </script>';
    } else{
      echo 'Failed to Add new client.';
    }
  }
}
// Set variables value
$title = $_GET['title'];
$user = $_SESSION['username'];
$mainClass = 'sidebar';
$output = '';

// Check if the user is an admin or a staff member before giving access
if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'staff'){
	$output .= '
    <section class="right">
    <h2>Add Client</h2>
    <form action="./addClient.php" method="POST">
    <label for="username">Username</label>
    <input type="text" name="username" id="username" required />
    <br />
    <label for="password">Password</label>
    <input type="password" name="password" id="password" required />
    <br />
    <input type="submit" name="add-submit" value="Add Client" />
    </form>
    </section>
  ';
} else{
  $output .= '
    <p>You don\'t have access to this page.</p>
  ';
}
// Call the admin.html.php that is the layout of the page
require('../templates/admin.html.php');