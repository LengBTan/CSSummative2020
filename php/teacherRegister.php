<?php

include "users.php";
require "connect.php";

$teacher = new Teacher();



if (isset($_POST['submit'])){
	$firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
	$password = $_POST['password'];

	$teacher->register($firstname,$lastname,$email,$password);
}






?>

<html>
	<head>
	<link rel="stylesheet" href="style.css">
	</head>
	<div class=box>
		<h2>Register new Teacher</h2>
		<form action="" method="POST">
			<input type="text" name="firstname" placeholder="First name" required> <br>
			<input type="text" name="lastname" placeholder="Last name" required> <br>
			<input type="email" name="email" placeholder="Email" required> <br>
			<input type="password" name="password" placeholder="Password" required> <br>
			<input type="submit" name="submit" value="Register" required> <br>



		</form>

	</div>

</html>