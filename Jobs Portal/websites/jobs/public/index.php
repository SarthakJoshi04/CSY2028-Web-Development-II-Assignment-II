<?php
// Require the dbConnection.php file to establish connection with the database
require('./dbConnection.php');
// Set variables value
$title = 'Home';
$mainClass = 'home';
$output = '
    <p>Welcome to Jo\'s Jobs, we\'re a recruitment agency based in Northampton. We offer a range of different office jobs. Get in touch if you\'d like to list a job with us.</a></p>
    <ul class="listing">
';
// Select 5 records from jobs table that are not archived and are due to end the soonest
$sql = 'SELECT * FROM jobs WHERE closingDate > NOW() AND isArchive = "N" ORDER BY closingDate LIMIT 5';

$result = $Connection->query($sql);

if ($result !== false) {
	if ($result->rowCount() > 0) {
		// Loop through the fetched rows
		foreach($result as $job){
            $output .= '
                <li>
                <div class="details">
                <h2>' .$job['title']. ' </h2>'
                . '<h3>Closing Date: ' .$job['closingDate']. '</h3>'
                . '<h3>Salary: ' .$job['salary']. ' </h3>'
                . '<p>' .nl2br($job['description']). '</p>'
                . '<a href="./apply.php?title=' .urlencode($job['title']). '&id=' .$job['id']. '" class="more">Apply for this job</a>'
                . '</div>
                </li>'
            ;
        }
	}
} 
$output .= '</ul>';
// Call the layout.html.php that is the layout of the page
require('./templates/layout.html.php');