<?php
    session_start();

include("includes/connection.php");

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Register</title>
	<?php include("includes/header_links.php"); ?>

</head>
<body>

	<?php include("includes/header_navigation.php"); ?>

	<h2 style="text-align: center;">Please, choose a department!</h2>
	<form>
		<button class="block" formaction="design.php">Design</button>
	</form>
	<br>
	<form>
		<button class="block" formaction="informatics.php">Informatics</button>
	</form>
	<br>
	<form>
		<button class="block" formaction="law.php">Law</button>
	</form>
</body>
</html>