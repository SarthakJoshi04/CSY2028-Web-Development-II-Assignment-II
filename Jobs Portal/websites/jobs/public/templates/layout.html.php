<!-- HTML layout for the public pages -->
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
			<li><a href="../index.php">Home</a></li>
			<li>Jobs
				<?php
					// Select all categories from the categories table
					$sql = 'SELECT * FROM categories';

					$result = $Connection->query($sql);

					if ($result !== false) {
						echo '<ul>';
						if ($result->rowCount() > 0) {
							// Loop through the fetched rows
							while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
								echo '<li><a href="../jobs.php?title=' .urlencode($row['name']). '&id=' .$row['id']. '">' .htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'). '</a></li>';
							}
						}
						echo '</ul>';
					}
				?>
			</li>
			<li><a href="../about.php">About Us</a></li>
			<li><a href ="../contactUs.php">Contact Us</a></li>
            <li><a href="../careerAdvice.php">Carrer Advice</a></li>
			<li><a href="../admin/clientLogin.php">Client Login</a> / <a href="../admin/staffLogin.php">Staff Login</a></li>
		</ul>
	</nav>
    <img src="../images/randomBanner.php" alt="Banner"/>
    <main class="<?=$mainClass?>">
    	<?=$output?>
	</main>
	<footer>
		&copy; Jo's Jobs <?php echo date('Y');?>
	</footer>
</body>
</html>