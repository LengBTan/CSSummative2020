<?php

require "connect.php";
require "users.php";

$teacher = new Teacher();

if(isset($_POST['submit'])){
    $email = $_POST["email"];
    $password = $_POST['password'];
    $login = $teacher->login($email,$password);
    if($login){
        //header("Location: ./teacherTable.php");
        //echo"successfully logged in";

    }else{
        echo"Email or password is incorrect";
    }
}
?>



<html>
    <head>

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