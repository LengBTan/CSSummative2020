<?php
include "./connect.php";
include "./users.php";

$id = $_REQUEST['id'];
$student = new Student();
?>


<!DOCTYPE html>
<html lang=en>


	<head>
		<title>edit student</title>
		<link rel="stylesheet" href="style.css">
  </head>
<body>
  
<div class="box">

<h1>Edit Student</h1>
  <?php
    if(isset($_POST['submit'])){
      $daysPresent = $_POST['dayspresent'];
      if($daysPresent<0){
        echo "not a valid number";
      }else{
      $student->editstudent($id);
      header("Location: ./teacherTable.php");
        
      }

      
    }
    if(isset($_POST['deleteStudent'])){
      $student->deletestudent($id);
      header("Location: ./teacherTable.php");
    }else{
    
      
    }
    echo"
    <form method='POST'>
    <h2> First name: </h2> <input type='text' name='firstname' autocomplete='off' value='".$student->getFirstName($id)."'   required>
    Last name: <input type='text' name='lastname' autocomplete='off' value='".$student->getLastName($id)."' required> 
    Email: <input type='email' name='email' autocomplete='off' value='".$student->getEmail($id)."' required> 
    Present: <input type='radio' name='present' value='1' required><br>
    Not present: <input type='radio' name='present' value='0' required><br>
    Days Present: <input type='number' name='dayspresent' autocomplete='off' value='".$student->getDaysPresent($id)."' required> <br>
    <input name='submit' type='submit' value='Update Student'>
    </form>
  ";
  ?>

  <!-- Show the modal -->
  <button id='deleteButton'>Delete Student</button>
</div>





<!-- The Modal -->
  <div id='modal' class='modal'>

    <!-- content in the modal, gives option to confirm, sending a post request to delete the row, or to close the modal when denying -->
    <div class='modal-content'>
      <span class='close'>&times;</span>
      <h2>Are you sure you want to delete the student from the list?</h2>
      <form method='POST'>
        <input type='submit' name='deleteStudent' value='Yes' id="confirmButton">
        
      </form>
      
      <button onclick = "modal.style.display = 'none'" id="denyButton">No</button>
    </div>
  </div>
</body>

<script>

// Get the modal
var modal = document.getElementById("modal");



// Get the button that opens the modal
var btn = document.getElementById("deleteButton");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

var box = document.getElementsByClassName("box");

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
  box.style.display = "none";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
 
}
</script>


</html>