<?php

class User{

  //checks if the user is logged in, and returns true if they are logged in
  public function session(){
    if (isset($_SESSION['login'])){
      return $_SESSION['login'];
    }
  }

  //set the login boolean to false when logging out, and destroys the current session
  public function logout(){
    $_SESSION['login'] = false;
    $_SESSION["usertype"] = "";
    session_destroy();
  }

} 

/**student class, includes methods for registering, logging in as a user and to attendence, deleting the student, and getters for firstname, lastname, email, and dayspresent.
* enherits functions from parent class User
*
*/
class Student extends User{

  //registers user into the database as a student with the parameters firstname, lastname, email, and password
  public function register($firstname, $lastname, $email, $password){
    include "connect.php";
    $password = md5($password); //encrypts password using MD5 encrypting algorithm
    $sql = "SELECT * FROM studentDB WHERE email = '".$email."'";//sql query for selecting a row where the chosen email is
    $result = $conn->query($sql);//connects to database and submits the sql query


    //checks if the email already exists, prompts user that the email already exists, else inserts the parameters into a sql query
    if($result->num_rows >=1){
      echo "Email already exists";

    }else{

      $sql = "INSERT INTO StudentDB (firstname, lastname, email, password, present, dayspresent, daysabsent) VALUES ('$firstname', '$lastname', '$email', '$password' , true, '1', '0')"; //sql query
      $result = mysqli_query($conn,$sql);
      //insert query to database and redirect user to studentPage.php
      if ($conn->query($sql) === TRUE) {
        echo "Registered sucessfully <br>";
        header("Location: studentPage.php");
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    $conn -> close();
      
    }
  }

  /**
   * logs user into site
   */
  function login($email, $password){
    include "connect.php";
    $password = md5($password);
    
    $sql = "SELECT * FROM studentDB WHERE email = '".$email."' and password = '".$password."'";

    //checks if the email is in the database by going through each row and checking
    $result = mysqli_query($conn,$sql) or die(mysqli_error());
    $rowcount = mysqli_num_rows($result); 
    if($rowcount == 1){
      $_SESSION['email']= $email; //stores email string
      $_SESSION['login']= true; //stores session
      $_SESSION["usertype"] = "student"; //stores usertype string


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

    $firstname =$_REQUEST['firstname'];//requests firstname from the edit.php form
    $lastname =$_REQUEST['lastname'];//requests lastname from the edit.php form
    $email =$_REQUEST['email'];//requests email from the edit.php form
    $present =$_REQUEST['present'];//requests present from the edit.php form
    $dayspresent =$_REQUEST['dayspresent'];//requests dayspresent from the edit.php form
    $daysabsent =$_REQUEST['daysabsent'];//requests daysabsent from the edit.php form
    //updates the student record in the specified id
    $sql = "UPDATE studentdb SET firstname='".$firstname."', lastname='".$lastname."', email='".$email."', present='".$present."', dayspresent='".$dayspresent."',daysabsent='".$daysabsent."' WHERE id='".$id."'";
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
    //finds the id of the row to retrieve firstname from studentdb
    $sql = "SELECT * FROM studentDB where id='".$id."'";
    $result = $conn->query($sql);
    //finds row where 'firstname' is contained
    while ($row = $result -> fetch_assoc()){
      $firstname = $row['firstname'];//stores the firstname of the student
    }
    return $firstname;
  }

  function getLastName($id){
    include "connect.php";
    //finds the id of the row to retrieve lastname from studentdb
    $sql = "SELECT * FROM studentDB where id='".$id."'";
    $result = $conn->query($sql);
    //finds row where 'lastname' is contained
    while ($row = $result -> fetch_assoc()){
      $lastname = $row['lastname'];//stores the lastname of the student
    }
    return $lastname;

  }
  function getEmail($id){
    include "connect.php";
    //finds the id of the row to retrieve email from studentdb
    $sql = "SELECT * FROM studentDB where id='".$id."'";
    $result = $conn->query($sql);
    //finds row where 'email' is contained
    while ($row = $result -> fetch_assoc()){
      $email = $row['email'];//stores the email of the student
    }
    return $email;

  }

  function getDaysPresent($id){
    include "connect.php";
    //finds the id of the row to retrieve dayspresent from studentdb
    $sql = "SELECT * FROM studentDB where id='".$id."'";
    $result = $conn->query($sql);
    //finds row where 'dayspresent' is contained
    while ($row = $result -> fetch_assoc()){
      $dayspresent = $row['dayspresent'];
    }
    return $dayspresent;

  }
  function getDaysAbsent($id){
    include "connect.php";
    //finds the id of the row to retrieve dayspresent from studentdb
    $sql = "SELECT * FROM studentDB where id='".$id."'";
    $result = $conn->query($sql);
    //finds row where 'dayspresent' is contained
    while ($row = $result -> fetch_assoc()){
      $daysabsent = $row['daysabsent'];
    }
    return $daysabsent;

  }
}



/**
 * teacherclass, 
 * 
 * 
 */
class Teacher extends User{

  //registers user as a teacher with parameters of firstname, lastname, email, and password
  public function register($firstname, $lastname, $email, $password){
    include "connect.php";
    $password = md5($password); //encrypts password using MD5 encrypting algorithm
    $sql = "SELECT * FROM teacherdb WHERE email = '".$email."'";//sql query for selecting a row where the chosen email is
    $result = $conn->query($sql);//connects to database and submits the sql query

    //checks if the email already exists, prompts user that the email already exists, else inserts the parameter into a sql query
    if($result->num_rows >=1){
      echo "Email already exists";

    }else{
      $sql = "INSERT INTO teacherdb (firstname, lastname, email, password) VALUES ('$firstname', '$lastname', '$email', '$password')";//sql query

      //insert query into database and redirect user to teacherTable.php
      if ($conn->query($sql) === TRUE) {
        echo "Registered sucessfully <br>";
        header("Location: teacherTable.php");
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    $conn -> close();
      
    }

  }  

  /**
   * logs user into the website
   */
  function login($email, $password){
    include "connect.php";
    $password = md5($password);
    
    $sql = "SELECT * FROM teacherDB WHERE email = '".$email."' and password = '".$password."'"; //'".md5($password)."'";

    //checks if the email is in the database by going through each row and checking
    $result = mysqli_query($conn,$sql) or die(mysqli_error());
    $rowcount = mysqli_num_rows($result); 
    if($rowcount == 1){
      $_SESSION['email']= $email;//stores email
      $_SESSION['login']= true;//stores session
      $_SESSION["usertype"] = "teacher";//stores usertype


      
      $sql = "UPDATE teacherdb SET reg_date = now() WHERE email = '".$email."'"; //update timestamp
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