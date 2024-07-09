<?php
// Including the 'dbconnect.php' file to establish a database connection
require('../dbConnection.php');

// Check if the form has been submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the submitted form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare a SQL statement to select a user with the provided username
    $statement = $Connection->prepare('SELECT * FROM staffs WHERE username = :username');
    $statement->execute(array(':username' => $username));

    // Fetch the user data as an associative array
    $staff = $statement->fetch(PDO::FETCH_ASSOC);

    // Check if a user was found and if the provided password matches the hashed password in the database
    if ($staff && password_verify($password, $staff['password'])) {
    // Authentication successful
        session_start(); // Start the session
        $_SESSION['logged-in'] = true;
        $_SESSION['staff_id'] = $staff['staff_id']; // Set the user_id in the session
        $_SESSION['username'] = $username; // Set the username in the session
        $_SESSION['role'] = 'staff'; // Set the role of the user in the session
        // Redirect users to the home page
        header('Location: ./index.php');
        exit();
    } else {
        // Authentication failed
        echo 'Invalid credentials.';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Jo's Jobs - Staff Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    form {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 300px;
    }

    h1 {
      text-align: center;
      color: #333;
    }

    label {
      display: block;
      margin-bottom: 5px;
      color: #333;
    }

    input {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
      box-sizing: border-box;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button {
      background-color: #007bff;
      color: #fff;
      padding: 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button:hover {
      background-color: #0056b3;
    }

    p {
      text-align: center;
      margin-top: 15px;
      color: #555;
    }

    a {
      color: #007bff;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <h1>Staff</h1>
  <form action="./staffLogin.php" method="POST">
    <label for="username">Username</label>
    <input type="text" name="username" id="username" required />
    <br />
    <label for="password">Password</label>
    <input type="password" name="password" id="password" required />
    <br />
    <button type="submit">Login</button>
    <p><a href="adminLogin.php">Login as Admin</a></p>
  </form>
</body>

</html>