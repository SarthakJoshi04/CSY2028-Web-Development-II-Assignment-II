<?php
// Require the dbConnection.php file to establish connection with the database
require('./dbConnection.php');
// Set variable value
$title = $_GET['title'];
$mainClass = 'sidebar';
$output ='';

// Select all records from categories table
$sql = 'SELECT * FROM categories';

$result = $Connection->query($sql);

if ($result !== false) {
    $output .= '
        <section class="left">
        <ul>
    ';
    if ($result->rowCount() > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            // If the page name and the job category is same, apply the current class
            if($title == $row['name']){
                $output .= '<li class="current"><a href="../jobs.php?title=' .urlencode($row['name']). '&id=' .$row['id']. '">' .htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'). '</a></li>';
            } else{
                $output .= '<li><a href="../jobs.php?title=' .urlencode($row['name']). '&id=' .$row['id']. '">' .htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'). '</a></li>';
            }
        }
    }
    $output .= '
        </ul>
        </section>
    ';
}

$output .= '
    <section class="right">
    <h1>' .$title. ' Jobs</h1>
    <ul class="listing">
';

// Select records from the jobs table of the corresponding category
$stmt = $Connection->prepare('SELECT * FROM jobs WHERE categoryId = :category_id AND closingDate > NOW() AND isArchive = "N"');
$values = [
    'category_id' => $_GET['id'],
];
$stmt->execute($values);

if($stmt->execute()){
    if($stmt->rowCount() > 0){
        foreach($stmt as $job){
            $output .= '
                <li>
                <div class="details">
                <h2>' .$job['title']. ' </h2>'
                . ' <h3>' .$job['salary']. ' </h3>'
                . ' <p>' .nl2br($job['description']). ' </p>'
                . ' <a href="./apply.php?title=' .urlencode($job['title']). '&id=' .$job['id']. '" class="more">Apply for this job</a>'
                . '</div>
                </li>'
            ;
        }
    } else{
        $output .= '
            <h3>No jobs found.</h3>
        '; 
    }
}
$output .= '</ul>';
// Call the layout.html.php that is the layout of the page
require('./templates/layout.html.php');