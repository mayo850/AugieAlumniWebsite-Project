<?php
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

?>

<!DOCTYPE html>
<html>
<head>
	<title>My website</title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body background= "images/old.jpg">

	<a href="logout.php">Logout</a>
	<h1>This is the index page</h1>

	<br>
	<h2> Hello, <?php echo $user_data['user_name']; ?> </h2>
</body>
</html>
