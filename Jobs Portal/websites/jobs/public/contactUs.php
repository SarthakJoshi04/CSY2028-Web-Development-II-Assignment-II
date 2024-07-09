<?php
// Require the dbConnection.php file to establish connection with the database
require('./dbConnection.php');
// Set variables value
$title = 'Contact Us';
$mainClass = 'sidebar';
$output = '';
// Check if the form was submitted
if(isset($_POST['enquiry-submit'])){
    // Check if all the parameters are set
    if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email'])&& isset($_POST['phone']) && isset($_POST['enquiry'])){
        $sql = $Connection->prepare('INSERT INTO enquiries(first_name, last_name, email, telephone, enquiry) VALUES(?, ?, ?, ?, ?)');
        $sql->execute([$_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['phone'], $_POST['enquiry']]);
        
        $output .= 'Your enquiry was sent successfully. Our team will reach out to you soon.</p>';
    } else{
        $output .= 'There was a problem sending your enquiry.';
    }
} else{ // Since the form was not submitted, display the form
    $output .= '
    <section class="right">
    <form action="./contactUs.php" method="POST">
    <label for="fname">First Name:</label>
    <input type="text" id="fname" name="fname" required />

    <label for="lname">Surname:</label>
    <input type="text" id="lname" name="lname" required />

    <label for="email">Email Address:</label>
    <input type="email" id="email" name="email" required />

    <label for="phone">Telephone:</label>
    <input type="tel" id="phone" name="phone" required />

    <label for="enquiry">Enquiry:</label>
    <textarea id="enquiry" name="enquiry" cols="60" rows="20" required></textarea>

    <input type="submit" name="enquiry-submit" value="Submit">
    </section>
';
}
// Call the layout.html.php that is the layout of the page
require('./templates/layout.html.php');