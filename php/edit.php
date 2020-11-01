<!DOCTYPE html>
<html lang=en>


	<head>
		<title>edit student</title>
		<link rel="stylesheet" href="style.css">
  </head>
<body>
<div class="box">
<?php
    include "./connect.php";
    include "./users.php";

    $id = $_REQUEST['id'];
    $student = new Student();

    
    if(isset($_POST['submit'])){
      $student->editstudent($id);
      header("Location: ./teacherTable.php");
    }else if(isset($_POST['deleteStudent'])){
      $student->deletestudent($id);
      header("Location: ./teacherTable.php");
    }else{

      echo"
      <form method='POST' id='form1'>
			First name: <input type='text' name='firstname' autocomplete='off' value='".$student->getFirstName($id)."'   required> <br>
			Last name: <input type='text' name='lastname' autocomplete='off' value='".$student->getLastName($id)."' required> <br>
      Email: <input type='email' name='email' autocomplete='off' value='".$student->getEmail($id)."' required> <br>
      Present: <input type='radio' name='present' value='1' required><br>
      Not present: <input type='radio' name='present' value='0' required><br>
      <input name='submit' type='submit' value='Update Student'>
      </form>
      ";
    }
    ?>
    <!-- Show the modal -->
    <button id='deleteButton'>Delete Student</button>

    <!-- The Modal -->
    <div id='modal' class='modal'>

      <!-- content in the modal, gives option to confirm, sending a post request to delete the row, or to close the modal when denying -->
      <div class='modal-content'>
        <span class='close'>&times;</span>
        <h1>Are you sure you want to delete the student from the list?</h1>
        <form method='POST'>
          <input type='submit' name='deleteStudent' value='Yes' id="confirmButton">
          
          </form>
          <button onclick = "modal.style.display = 'none'" id="denyButton">No</button>
      </div>
    </div>


<script>
// Get the modal
var modal = document.getElementById("modal");

// Get the button that opens the modal
var btn = document.getElementById("deleteButton");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}
</script>
</div>
</body>



</html>