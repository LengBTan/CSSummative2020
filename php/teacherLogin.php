<?php

require "connect.php";
require "./users.php";

$teacher = new Teacher();
session_start();


//checks if user is logged in
if($teacher->session() && $_SESSION["usertype"] == "teacher"){
	header("Location: ./teacherTable.php");
}

//when the button is pressed, logs the user in, if credentials are incorrect, prompts user that credentials are wrong
if(isset($_POST['submit'])){
    $email = $_POST["email"];
    $password = $_POST['password'];
    $login = $teacher->login($email,$password);
    if($login){
        echo "Logged in sucessfully";

    }else{
        echo"Failed to log in, Email or password may be incorrect.";
    }
}
?>



<html>
    <head>
		<link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div>
            <form action="" method="POST">
                <input type="email" name="email" placeholder="Email" required> <br>
                <input type="password" name="password" placeholder="Password" required> <br>
                <input type="submit" name="submit" value="Log In" required> <br>
            </form>
        </div>
    </body>
</html>