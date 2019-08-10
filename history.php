<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>History</title>
</head>
<body>
	<?php
		$myfile = fopen("history/history_log.txt", "r") or die("Unable to open file!");
		while (!feof($myfile)) {
			echo fgets($myfile);
			echo "</br>";
		}
		fclose($myfile);
	?>
</body>
</html>