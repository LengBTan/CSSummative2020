<!DOCTYPE html>
<html lang="en">
    <body>

        <?php
            include "connect.php";

            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $email = $_POST["email"];

            echo "$firstname  <br>";
            echo "$lastname <br>"; 
            echo "$email <br>"; 

            $sql = "INSERT INTO StudentDB (firstname, lastname, email, present) VALUES ('$firstname', '$lastname', '$email', true)";



            if ($conn->query($sql) === TRUE) {
					echo "New record created successfully";
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
                }
                
            $conn -> close();
        ?>

    </body>

</html>