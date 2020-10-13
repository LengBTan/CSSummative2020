<!DOCTYPE html>
<html lang=en>

	<head>
		<title>edit student</title>
		<link rel="stylesheet" href="./style.css">
    </head>
    
    <?php
    include "connect.php";


    $id = $_REQUEST['id'];
    echo "$id";

    $sql= "SELECT * FROM studentdb where id='".$id."'";



    if(isset($_POST['submit'])){
      $id=$_REQUEST['id'];
      $firstname =$_REQUEST['firstname'];
      $lastname =$_REQUEST['lastname'];
      $email =$_REQUEST['email'];
      $present =$_REQUEST['present'];
      //$sql = "UPDATE studentdb set firstname='".$firstname."', lastname='".$lastname."', email='".$email."'"'
      $sql = "UPDATE studentdb SET firstname='".$firstname."', lastname='".$lastname."', email='".$email."', present='".$present."'
      WHERE id='".$id."'
      ";
      if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
      } else {
        echo "Error updating record: " . $conn->error;
      }
    }else{

      echo "
      <form action='' method='POST'>
			First name: <input type='text' name='firstname' required> <br>
			Last name: <input type='text' name='lastname' required> <br>
      Email: <input type='email' name='email' required> <br>
      Present: <input type='radio' name='present' value='1' required><br>
      Not present: <input type='radio' name='present' value='0' required><br>


			<input name='submit' type='submit' value='update'>
      </form>  ";

    }




    ?>

      


</html>