<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<style type="text/css">
		input[name="submit_name"]{
			margin-top: 20px;
		}
	</style>
	<?php
		require_once 'class/edit.php';

		$edit = new edit();
		$edit->create_name();
	?>
</head>
<body>

</body>
</html>