<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="refresh" content="3;url=/php/studentPage.html">
		<link rel="stylesheet" href="style.css">
    </head>
    <body>

        <?php
            include "connect.php";

            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $email = $_POST["email"];
            $password = $_POST['password'];

            echo "$firstname  <br>";
            echo "$lastname <br>"; 
            echo "$email <br>"; 

            $sql = "INSERT INTO StudentDB (firstname, lastname, email, password, present) VALUES ('$firstname', '$lastname', '$email', '$password' , true)";



            if ($conn->query($sql) === TRUE) {
					echo "New record created successfully";
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
                }
                
            $conn -> close();


        ?>

    </body>

</html>