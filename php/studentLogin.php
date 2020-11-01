<?php
session_start();
include "users.php";
require "connect.php";


$student = new Student();


//checks if student is logged in, redirect them to the student page.

if($student->session() && $_SESSION["usertype"] == "student"){
	header("Location: ./studentPage.php");
}




?>

<html>
    <head>
    <title>Login</title>
	<link rel="stylesheet" href="style.css">
    </head>
	<body>
    <div class="box">

    <?php
    //when the button is pressed, logs the user in, if credentials are incorrect, prompts user that credentials are wrong
    if (isset($_POST['submit'])){
        $email = $_POST["email"];
        $password = $_POST['password'];
        $login = $student->login($email,$password);
        if($login){
            echo "Logged in succesfully";
        }else{
            echo "<h3>Failed to log in, Email or password may be incorrect.</h3>";
        }
    }
    ?>

    <h2>Log in as a student:</h2>
		<form action="" method="POST">
			<input type="email" name="email" placeholder="Email" required> <br>
			<input type="password" name="password" placeholder="Password" required> <br>
			<input type="submit" name="submit" value="Log In" required> <br>
		</form>
	</div>
    </body>
</html>