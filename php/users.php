<?php

require "connect.php"; // connects the php file to the mysql database
class user
{
  
}






function editstudent($id){

    $sql= "SELECT * FROM studentdb where id='".$id."'";

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



}



function deleteStudent($id){

    //finds the id of the row to delete from studentdb
    $sql = "DELETE FROM studentdb WHERE id='".$id."'";

    //checks if row in table is deleted.
    if ($conn->query($sql) === TRUE) {
      echo "Deleted record sucessfully";
    } else {
      echo "Error deleting record: " . $conn->error;
    }
}




?>