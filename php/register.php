<!DOCTYPE html>
<html lang=en>
	<head>
	<title>Register</title>
	</head>
	
	<body>
		<?php
		require "connect.php";
		session_start();
		if (isset($_REQUEST['email'])){
			$email = stripslashes($_REQUEST['email']);
			$email = mysqli_real_escape_string($conn,$email);
			$firstname = stripslashes($_REQUEST['firstname']);
			$firstname = mysqli_real_escape_string($conn,$firstname);
			$lastname = stripslashes($_REQUEST['lastname']);
			$lastname = mysqli_real_escape_string($conn,$lastname);
			$password = stripslashes($_REQUEST['password']);
			$password = mysqli_real_escape_string($conn,$password);


			$sql = "INSERT into users (firstname, lastname, email, password,) VALUES ('$firstname','$lastname', '".md5($password)."', '$email')";
			$result = $conn->query($sql);
			if($result){
				echo "<div class= 'register'>
				<h3>you are sucessfully registered</h3>
				<br>
				Click here to <a href='login.php'>Login</a></div>";
				}
			}else{
			


			

		



		

		?>

		<div class="register">
			<h1>Register</h1>
			<form action="" name="register" method="post">
				<input type="text" name="firstname" placeholder="First name" required>
				<input type="text" name="lastname" placeholder="Last name" required>
				<input type="text" name="email" placeholder="Email" required>
				<input type="text" name="password" placeholder="Password">
				<input type="submit" name="submit" value="Register">
			</form>
		</div>
		<?php ;} ?>
	</body>
</html>