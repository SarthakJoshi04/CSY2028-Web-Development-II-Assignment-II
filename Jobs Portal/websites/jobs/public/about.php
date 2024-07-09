<?php
// Require the dbConnection.php file to establish connection with the database
require('./dbConnection.php');
// Set variables value
$title = 'About Us';
$mainClass = 'home';
$output = '
    <p>Welcome to Jo\'s Jobs, we\'re a recruitment agency based in Northampton. We offer a range of different office jobs. Get in touch if you\'d like to list a job with us.</a></p>
    <h2>Select the type of job you are looking for:</h2>
';

// Select all categories from the categories table
$sql = 'SELECT * FROM categories';

$result = $Connection->query($sql);

if ($result !== false) {
	echo '<ul>';
	if ($result->rowCount() > 0) {
		// Loop through the fetched rows
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$output .= '<li><a href="../jobs.php?title= ' .urlencode($row['name']). ' &id= ' .$row['id']. ' ">' . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . ' </a></li>';
		}
	}
	echo '</ul>';
}
// Call the layout.html.php that is the layout of the page
require('./templates/layout.html.php');