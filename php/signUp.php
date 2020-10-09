<!DOCTYPE html>
<html lang=en>
	<head>
	<title>Login</title>
	</head>
	
	<body>

		<?php
		$servername = "localhost";
		$username = "username";
		$password = "password";
		$db = "cssummativedb";

		// Create connection
		$conn = mysqli_connect($servername, $username, $password,$db);

		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		echo "Connected successfully <br>";
		

	    ?>
	</body>
</html>