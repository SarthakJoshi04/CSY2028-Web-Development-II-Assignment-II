<?php
// Selects random image from the banner folder
$files = [];
foreach (new DirectoryIterator('./banners') as $file) {
	if ($file->isDot()) {
		continue;
	}

	if (!strpos($file->getFileName(), '.jpg')) {
		continue;
	}

	$files[] = $file->getFileName();
}
$randomImage = $files[rand(0,count($files)-1)]; // Select a random image filename

// Set the appropriate headers
header('Content-Type: image/jpeg');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');

// Load and output the image content
$contents = file_get_contents("./banners/$randomImage");

echo $contents;
