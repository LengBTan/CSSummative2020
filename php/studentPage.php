<!DOCTYPE html>

<?php
include "./users.php";
include "./connect.php";
//get the session and check if user is logged in, if not then redirect to relogin

//echo the current session user to show they are logged in
session_start();

$student = new Student();
$email = $_SESSION['email'];




//if user tries to go to this page without logging in, it will redirect them to index.php
if(!$student->session()||$_SESSION["usertype"] == "teacher"){
	header("Location: ./index.php");
}

if(isset($_GET['logoutsession'])){
	$student->logout();
	header("Location: ./index.php");
}

if(isset($_GET['signin'])){

	$student->loginAttendence($email);
	//echo "logged in <br>";
}

if(isset($_GET['logout'])){
	$student->logoutAttendence($email);
	//echo "logged out";
}
?>



<html lang=en>
	<head>
	<title>studentPage</title>
	<link rel="stylesheet" href="style.css">
	</head>
	<header>
	<?php

	if($student->session()){
		echo "Currently logged in as: ".$_SESSION['email']." <br>";
	}
	
	?>
	<a href="?logoutsession">Log out</a>


	</header>
	<body>

		<a href="?signin">Sign in for attendence</a>
		<a href="?logout">Sign out for attendence</a>
		<a href="studentEdit.php">Edit student info</a>    <!-- add some magic-->
		
	</body>
</html>