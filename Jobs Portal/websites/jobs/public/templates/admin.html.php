<!-- HTML layout for the admin pages -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Jo's Jobs - <?=$title?></title>
</head>
<body>
    <header>
		<section>
			<aside>
				<h3>Office Hours:</h3>
				<p>Mon-Fri: 09:00-17:30</p>
				<p>Sat: 09:00-17:00</p>
				<p>Sun: Closed</p>
			</aside>
			<h1>Jo's Jobs</h1>

		</section>
	</header>
    <nav>
		<ul>
			<li><a href="../admin/index.php">Home</a></li>
			<li><a href="../admin/logout.php">Logout</a></li>
            <li> | </li>
            <li>Welcome to the Admin area <strong><?=$user?></strong></li>
		</ul>
	</nav>
    <img src="../images/randomBanner.php" alt="Banner"/>
    <main class="<?=$mainClass?>">
        <!-- Checks if a user is logged in and if so displays different output based on their role -->
        <?php
            if (isset($_SESSION['logged-in']) && $_SESSION['logged-in']) {
                if($_SESSION['role'] == 'admin'){
                    echo '
                        <section class="left">
                        <ul>
                            <li><a href="./jobs.php?title=Jobs">Jobs</a></li>
                            <li><a href="./archivedJobs.php?title=Archived Jobs">Archive</a></li>
                            <li><a href="./categories.php?title=Categories">Categories</a></li>
                            <li><a href="./enquiries.php?title=Enquiries">Enquiries</a></li>
                            <li><a href="./addClient.php?title=Add Client">Add Client</a></li>
                            <li><a href="./manageStaff.php?title=Manage Staffs">Staffs</a></li>
                        </ul>
                        </section>
                    ';
                } else if($_SESSION['role'] == 'staff'){
                    echo '
                        <section class="left">
                        <ul>
                            <li><a href="./jobs.php?title=Jobs">Jobs</a></li>
                            <li><a href="./archivedJobs.php?title=Archived Jobs">Archive</a></li>
                            <li><a href="./categories.php?title=Categories">Categories</a></li>
                            <li><a href="./enquiries.php?title=Enquiries">Enquiries</a></li>
                            <li><a href="./addClient.php?title=Add Client">Add Client</a></li>
                        </ul>
                        </section>
                    ';
                } else {
                    echo '
                    <section class="left">
                    <ul>
                        <li><a href="./jobs.php?title=Jobs&id=' .$_SESSION['client_id']. '">Jobs</a></li>
                    </ul>
                    </section>
                ';
                }
            }
        ?>
    	<?=$output?>
	</main>
	<footer>
		&copy; Jo's Jobs <?php echo date('Y');?>
	</footer>
</body>
</html>