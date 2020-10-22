<?php
session_start();
include "users.php";
require "connect.php";

$user = new User();
//if ($user->session()){
//redirect user to their specified page
//}


if (isset($_POST['submit'])){
    $email = $_POST["email"];
    $password = $_POST['password'];
    $login = $user->login($email,$password);
    if($login){
        echo "Logged in succesfully";
        //header to redirect
    }else{
        echo "Failed to log in";
    }
}






?>

<html>
	<div>
		<form action="" method="POST">
			<input type="email" name="email" placeholder="Email" required> <br>
			<input type="password" name="password" placeholder="Password" required> <br>
			<input type="submit" name="submit" value="Log In" required> <br>



		</form>

	</div>

</html>