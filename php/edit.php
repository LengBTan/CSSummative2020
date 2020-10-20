<!DOCTYPE html>
<html lang=en>

	<head>
		<title>edit student</title>
		<link rel="stylesheet" href="./style.css">
    </head>
    
    <?php
    include "connect.php";
    include "users.php";


    $id = $_REQUEST['id'];


    if(isset($_POST['submit'])){
     
     editstudent($id);

    }else if(isset($_POST['delete'])){



      echo "Are you sure you want to delete? <br>

      <form>
        
        <input name='confirm' type='submit' value='deny'>
        <input name='deny' type='submit' value='confirm'>
      </form>
      
      
      
      
      
      ";

      //finds the id of the row to delete from studentdb
      $sql = "DELETE FROM studentdb WHERE id='".$id."'";

      //checks if row in table is deleted.
      if ($conn->query($sql) === TRUE) {
        echo "Deleted record sucessfully";
      } else {
        echo "Error deleting record: " . $conn->error;
      }
      

    
    }else{

      echo "
      <form method='POST' id='form1'>
			First name: <input type='text' name='firstname' required> <br>
			Last name: <input type='text' name='lastname' required> <br>
      Email: <input type='email' name='email' required> <br>
      Present: <input type='radio' name='present' value='1' required><br>
      Not present: <input type='radio' name='present' value='0' required><br>
      <input name='submit' type='submit' value='update'>
      <input name='delete' type='submit' value='delete' formnovalidate>
     
      </form> 
      
      
      
      ";

    }


    




    ?>


</html>