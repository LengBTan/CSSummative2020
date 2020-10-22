<?php

include "users.php";
require "connect.php";

$user = new User();

if (isset($_POST['submit'])){
	$firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
	$password = $_POST['password'];

	$user->register($firstname,$lastname,$email,$password);
	//if($register){
	echo "You are now registered";
	//}else{
	//	echo "Email already exists";
	//}
}






?>

<html>
	<div>
		<form action="" method="POST">
			<input type="text" name="firstname" placeholder="First name" required> <br>
			<input type="text" name="lastname" placeholder="Last name" required> <br>
			<input type="email" name="email" placeholder="Email" required> <br>
			<input type="password" name="password" placeholder="Password" required> <br>
			<input type="submit" name="submit" value="register" required> <br>



		</form>

	</div>

</html>