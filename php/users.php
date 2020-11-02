<?php

class User{


  function __construct(){
    // Create connection to the mysql database
    //$conn = mysqli_connect("localhost", "username", "password","cssummativedb");

    // Check connection
    //if (!$conn) {
    //  die("Connection failed: " . mysqli_connect_error());
    //  echo "Connection failed";
  //}

  //when called, logs user in a session, returns the value $_SESSION['login']
  }
  public function session(){
    if (isset($_SESSION['login'])){
      return $_SESSION['login'];
    }
  }

  public function logout(){
    $_SESSION['login'] = false;
    $_SESSION["usertype"] = "";
    session_destroy();
  }

} 

class Student extends User{

  //constructor
  public function __construct(){
    include "connect.php";
    //$_SESSION["usertype"] = "student";
  }

  public function register($firstname, $lastname, $email, $password){
    include "connect.php";
    $password = md5($password); //encrypts password using MD5 encrypting algorithm
    $sql = "SELECT * FROM studentDB WHERE email = '".$email."'";
    $result = $conn->query($sql);

    if($result->num_rows >=1){
      echo "Email already exists";

    }else{
      $sql = "INSERT INTO StudentDB (firstname, lastname, email, password, present, dayspresent) VALUES ('$firstname', '$lastname', '$email', '$password' , true, '0')";

      if ($conn->query($sql) === TRUE) {
        echo "Registered sucessfully <br>";
        header("Location: studentPage.php");
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    $conn -> close();
      
    }



  }

  
  function login($email, $password){
    include "connect.php";
    $password = md5($password);
    
    $sql = "SELECT * FROM studentDB WHERE email = '".$email."' and password = '".$password."'"; //'".md5($password)."'";

    //checks if the email is in the database by going through each row and checking
    $result = mysqli_query($conn,$sql) or die(mysqli_error());
    $rowcount = mysqli_num_rows($result); 
    if($rowcount == 1){
      $_SESSION['email']= $email;
      $_SESSION['login']= true;
      $_SESSION["usertype"] = "student";


      //update timestamp
      $sql = "UPDATE studentDB SET reg_date = now() WHERE email = '".$email."'";
      $result = mysqli_query($conn,$sql);
      if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
      } else {
        echo "Error updating record: " . $conn->error;
      }
      header("Location: ./studentPage.php"); //Redirects user to the student page
      return true;
      
    }else{
      return false;
    }
  }

  

  function loginAttendence($email){
    include "connect.php";
    $sql = "UPDATE studentdb SET present='1' WHERE email='$email'";
	  $result = $conn->query($sql);
  }

  function logoutAttendence($email){
    include "connect.php";
    $sql = "UPDATE studentdb SET present='0' WHERE email='$email'";
	  $result = $conn->query($sql);
  }
  function editstudent($id){
    include "connect.php";
    $sql= "SELECT * FROM studentdb where id='".$id."'";

    $firstname =$_REQUEST['firstname'];
    $lastname =$_REQUEST['lastname'];
    $email =$_REQUEST['email'];
    $present =$_REQUEST['present'];
    $daysPresent =$_REQUEST['dayspresent'];
    //$sql = "UPDATE studentdb set firstname='".$firstname."', lastname='".$lastname."', email='".$email."'"'
    $sql = "UPDATE studentdb SET firstname='".$firstname."', lastname='".$lastname."', email='".$email."', present='".$present."', dayspresent='".$daysPresent."' WHERE id='".$id."'";
    if ($conn->query($sql) === TRUE) {
      echo "Record updated successfully";
    } else {
      echo "Error updating record: " . $conn->error;
    }
  }

  function deleteStudent($id){
    include "connect.php";
    //finds the id of the row to delete from studentdb
    $sql = "DELETE FROM studentdb WHERE id='".$id."'";   
    //checks if row in table is deleted.
    if ($conn->query($sql) === TRUE) {
     echo "Deleted record sucessfully";
    } else {
      echo "Error deleting record: " . $conn->error;
    }
  }

  function getFirstName($id){
    include "connect.php";
    $sql = "SELECT * FROM studentDB where id='".$id."'";
    $result = $conn->query($sql);

    while ($row = $result -> fetch_assoc()){
      $firstname = $row['firstname'];
    }
    return $firstname;
  }

  function getLastName($id){
    include "connect.php";
    $sql = "SELECT * FROM studentDB where id='".$id."'";
    $result = $conn->query($sql);
    while ($row = $result -> fetch_assoc()){
      $lastname = $row['lastname'];
    }
    return $lastname;

  }
  function getEmail($id){
    include "connect.php";
    $sql = "SELECT * FROM studentDB where id='".$id."'";
    $result = $conn->query($sql);
    while ($row = $result -> fetch_assoc()){
      $email = $row['email'];
    }
    return $email;

  }

  function getDaysPresent($id){
    include "connect.php";
    $sql = "SELECT * FROM studentDB where id='".$id."'";
    $result = $conn->query($sql);
    while ($row = $result -> fetch_assoc()){
      $email = $row['dayspresent'];
    }
    return $email;

  }

}


class Teacher extends User{



  public function construct(){
    include "connect.php";
    //$_SESSION["usertype"] = "teacher";
  }


  public function register($firstname, $lastname, $email, $password){
    include "connect.php";
    $password = md5($password); //encrypts password using MD5 encrypting algorithm
    $sql = "SELECT * FROM teacherdb WHERE email = '".$email."'";
    $result = $conn->query($sql);

    if($result->num_rows >=1){
      echo "Email already exists";

    }else{
      $sql = "INSERT INTO teacherdb (firstname, lastname, email, password) VALUES ('$firstname', '$lastname', '$email', '$password')";

      if ($conn->query($sql) === TRUE) {
        echo "Registered sucessfully <br>";
        header("Location: teacherTable.php");
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    $conn -> close();
      
    }

  }  

  function login($email, $password){
    include "connect.php";
    $password = md5($password);
    
    $sql = "SELECT * FROM teacherDB WHERE email = '".$email."' and password = '".$password."'"; //'".md5($password)."'";

    //checks if the email is in the database by going through each row and checking
    $result = mysqli_query($conn,$sql) or die(mysqli_error());
    $rowcount = mysqli_num_rows($result); 
    if($rowcount == 1){
      $_SESSION['email']= $email;
      $_SESSION['login']= true;
      $_SESSION["usertype"] = "teacher";


      //update timestamp
      $sql = "UPDATE teacherdb SET reg_date = now() WHERE email = '".$email."'";
      $result = mysqli_query($conn,$sql);
      if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
      } else {
        echo "Error updating record: " . $conn->error;
      }
      header("Location: ./teacherTable.php"); //Redirects user to the teacher page
      return true;
      
    }else{
      return false;
    }
  }

}



















?>