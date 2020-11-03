<?php

include "users.php";
require "connect.php";



$student = new Student();


if($student->session()){
	header("Location: studentPage.php");
}
?>

<html>
	<head>
	<title>Register Studnet</title>
	<link rel="stylesheet" href="style.css">
	</head>
	<body>
	<div class=box>

	<?php
	if (isset($_POST['submit'])){
		$firstname = $_POST["firstname"];
		$lastname = $_POST["lastname"];
		$email = $_POST["email"];
		$password = $_POST['password'];
	
		$student->register($firstname,$lastname,$email,$password);
	}
	
	
	?>


		<h2>Student register</h2>
		<form action="" method="POST">
			<input type="text" name="firstname" placeholder="First name" required> <br>
			<input type="text" name="lastname" placeholder="Last name" required> <br>
			<input type="email" name="email" placeholder="Email" required> <br>
			<input type="password" name="password" placeholder="Password" required> <br>
			<input type="submit" name="submit" value="register" required> <br>



		</form>

	</div> 
	</body>
	

</html>