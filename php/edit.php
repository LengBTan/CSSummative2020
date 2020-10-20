<!DOCTYPE html>
<html lang=en>


	<head>
		<title>edit student</title>
		<link rel="stylesheet" href="style.css">
  </head>
    <?php
    include "connect.php";
    include "users.php";
    $id = $_REQUEST['id'];


    
    if(isset($_POST['submit'])){
     editstudent($id);
    }else if(isset($_POST['deleteStudent'])){
      deletestudent($id);
    }else{

      echo"
      <form method='POST' id='form1'>
			First name: <input type='text' name='firstname' autocomplete='off' required> <br>
			Last name: <input type='text' name='lastname' autocomplete='off' required> <br>
      Email: <input type='email' name='email' autocomplete='off' required> <br>
      Present: <input type='radio' name='present' value='1' required><br>
      Not present: <input type='radio' name='present' value='0' required><br>
      <input name='submit' type='submit' value='Update Student'>
      </form>


      <!-- Show the modal -->
      <button id='deleteButton'>Delete Student</button>

      <!-- The Modal -->
      <div id='myModal' class='modal'>

        <!-- content in the modal, gives option to confirm, sending a post request to delete the row, or to close the modal when denying -->
        <div class='modal-content'>
          <span class='close'>&times;</span>
          <h1>Are you sure you want to delete the student from the list?</h1>
          <form form method='POST'>
            <input type='submit' name='deleteStudent' value='Yes'>
          </form>
          <button onclick = 'modal.style.display = 'none''>No</button>
        </div>

      </div>


      ";


      
    }
    ?>



<script>
// Get the modal
var modal = document.getElementById("myModal");

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



</html>