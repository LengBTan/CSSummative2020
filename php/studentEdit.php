<!DOCTYPE html>
<html lang=en>


	<head>
		<title>edit student</title>
		<link rel="stylesheet" href="style.css">
  </head>
    <body>
    <div class="form">
    <?php
    include "./connect.php";
    include "./users.php";
    session_start();

    $student = new Student();
    $emailsession = $_SESSION['email'];

    if(isset($_GET['logoutsession'])){
        $student->logout();
    }
    

    

    
    if(isset($_POST['submit'])){
        //make a checker using modulo for if a number is being entered instead of a word

        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];
	    $password = $_POST['password'];
        

        $sql = "UPDATE studentdb SET firstname='".$firstname."', lastname='".$lastname."', email='".$email."',password=".$password."
        WHERE email='".$emailsession."'";
        $result = $conn->query($sql);
      
    }else{
        echo"
        <form method='POST'>
		First name: <input type='text' name='firstname' autocomplete='off'    required> <br>
	    Last name: <input type='text' name='lastname' autocomplete='off'  required> <br>
        Email: <input type='email' name='email' autocomplete='off' required> <br>
        Password: <input type='password' name='password' autocomplete='off' required> <br>
        <input name='submit' type='submit' value='Update Student'>
        </form>
        ";
    }
    ?>
    </div>
    </body>


</html>