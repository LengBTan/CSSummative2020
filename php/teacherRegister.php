<?php

include "users.php";
require "connect.php";

$teacher = new Teacher();



?>

<html>
	<head>
	<link rel="stylesheet" href="style.css">
	</head>
	<div class=box>
		<?php
		if (isset($_POST['submit'])){
			$firstname = $_POST["firstname"];
			$lastname = $_POST["lastname"];
			$email = $_POST["email"];
			$password = $_POST['password'];
		
			$teacher->register($firstname,$lastname,$email,$password);
		}
		?>
		<h2>Register new Teacher</h2>
		<form action="" method="POST">
			<input type="text" name="firstname" placeholder="First name" autocomplete= "off" required> <br>
			<input type="text" name="lastname" placeholder="Last name" autocomplete= "off" required> <br>
			<input type="email" name="email" placeholder="Email" autocomplete= "off" required> <br>
			<input type="password" name="password" placeholder="Password" autocomplete= "off" required> <br>
			<input type="submit" name="submit" value="Register" autocomplete= "off" required> <br>



		</form>

	</div>

</html>