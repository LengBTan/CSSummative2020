<!DOCTYPE html>
<html lang=en>
	<head>
		<title>TeacherDB</title>
		<link rel="stylesheet" href="style.css">
	</head>
	
	<body>
		<header>
		<h2 id="title">TeacherDB</h2>

			<?php
				include "./connect.php";
				include "./users.php";
				session_start();
				$teacher = new Teacher();
				$student = new Student();

				//checks if the current session is a student, if its true, redirect user to index.php
				if(!$teacher->session()||$_SESSION["usertype"] == "student"){
					header("Location: ./index.php");
				}

				//if user is logged in as a teacher, display who is logged in
				if($teacher->session()){
					echo "<h4 id='displayuser'>Currently logged in as: ".$_SESSION['email']."</h4>";
				}

				//if the 'logoutsession' button is pressed, logs user out and redirects them to index.php
				if(isset($_GET['logoutsession'])){
					$teacher->logout();
					header("Location: ./index.php");
				}

			?>
			<a href="?logoutsession" id="logoutbutton">Log out</a>

		</header>
		
		<?php
		
		//creates table called StudentDB, with headers of id, firstname, lastname, email, password, present, dayspresent, and reg_date
		//id is BIGINT due to the int being 10 digits, which may not be long enough.
		/*$sql = "CREATE TABLE StudentDB (
		id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		firstname VARCHAR(30) NOT NULL, 
		lastname VARCHAR(30) NOT NULL,
		email VARCHAR(50),
		password varchar(50) NOT NULL,
		present BOOLEAN NOT NULL,
		dayspresent INT NOT NULL,
		daysabsent INT NOT NULL,
		reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
		)";
		*/


		/*creates table called teacherDB, with headers of id, firstname, lastname, email, password, and reg_date
		$sql = "CREATE TABLE teacherDB (
		id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		firstname VARCHAR(30) NOT NULL,
		lastname VARCHAR(30) NOT NULL,
		email VARCHAR(50) NOT NULL,
		password varchar(50) NOT NULL,
		reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
		)";
		*/

		//Creates event that resets all present booleans to false at 7am
		//$sql = CREATE EVENT reset_present ON SCHEDULE EVERY 1 DAY STARTS '2020-11-02 07:00:00' DO UPDATE `studentdb` SET present = false;


		////Creates event that increments the dayspresent variable every day at 3pm
		//$sql = CREATE EVENT IF NOT EXISTS presentadd ON SCHEDULE EVERY 1 DAY STARTS '2020-11-02 15:00:00' DO UPDATE `studentdb` SET dayspresent = dayspresent + 1 WHERE present = 1;
	
		////creates event that increments the daysabsent variable everyday at 3pm on weekdays if the student is absent
		//$sql = CREATE EVENT IF NOT EXISTS absentadd ON SCHEDULE EVERY 1 DAY STARTS '2020-11-02 15:00:00' DO UPDATE studentdb SET daysabsent= IF (DAYSOFWEEK(curdate()) BETWEEN 2 AND 6, 'daysabsent'= daysabsent + 1, daysabsent) WHERE present = 0;


		//checks if query is successful.
		/*if ($conn->query($sql) === TRUE) {
			echo "query ran successfully<br>";
		} else {
			echo "Error running query: <br>" . $conn->error . "<br>";
		}
		*/

		//ALTER TABLE table_name AUTO_INCREMENT = value; //to reset the id increment in mysql

		//
		
		?>

		<!-- Table of the database-->
		<div id="tablebox">
			<table>
					<tr>
						<!--header of table-->
						<th>Id<br> <a href="?sort=idASC">▲</a> <a href="?sort=idDESC">▼</a> </th>
						<th>First Name <br> <a href="?sort=FnameASC">▲</a> <a href="?sort=FnameDESC">▼</a></th>
						<th>Last Name <br> <a href="?sort=LnameASC">▲</a> <a href="?sort=LnameDESC">▼</a> </th>
						<th>Email</th>
						<th>Present</th>
						<th>Days Present</th>
						<th>Days Absent</th>
						<th>% Days Present</th>
						<th>Sign in Time <br> <a href="?sort=regASC">▲</a> <a href="?sort=regDESC">▼</a></th>
						<th>Edit</th>
					</tr>
				<div id="students">
					<?php
						//selects data from the table named "studentDB", and uses the data to display it in a html table
						//If sort column button pressed, switch statement for each scenario of sorting columns, else display default table
						if(isset($_GET['sort'])){

							switch($_GET['sort']){
								case "idASC"://acending id 
									$sql = "SELECT id, firstname, lastname, email, present, dayspresent, daysabsent, reg_date FROM studentdb ORDER BY id ASC";
									$result = $conn->query($sql);
									displaytable($sql,$result);
								break;
	
								case "idDESC"://decending id 
									$sql = "SELECT id, firstname, lastname, email, present, dayspresent, daysabsent, reg_date FROM studentdb ORDER BY id DESC";
									$result = $conn->query($sql);
									displaytable($sql,$result);
								break ;
								case "FnameASC"://acending firstname 
									$sql = "SELECT id, firstname, lastname, email, present, dayspresent, daysabsent, reg_date FROM studentdb ORDER BY firstname ASC";
									$result = $conn->query($sql);
									displaytable($sql,$result);
									
								break;
								case "FnameDESC"://decending firstname 
									$sql = "SELECT id, firstname, lastname, email, present, dayspresent, daysabsent, reg_date FROM studentdb ORDER BY firstname DESC";
									$result = $conn->query($sql);
									displaytable($sql,$result);
								break;
								case "LnameASC"://acending lastname 
									$sql = "SELECT id, firstname, lastname, email, present, dayspresent, daysabsent, reg_date FROM studentdb ORDER BY lastname ASC";
									$result = $conn->query($sql);
									displaytable($sql,$result);
									
								break;
								case "LnameDESC"://decending lastname
									$sql = "SELECT id, firstname, lastname, email, present, dayspresent, daysabsent, reg_date FROM studentdb ORDER BY lastname DESC";
									$result = $conn->query($sql);
									displaytable($sql,$result);
									
								break;
								case "regASC"://acending sign in time
									$sql = "SELECT id, firstname, lastname, email, present, dayspresent, daysabsent, reg_date FROM studentdb ORDER BY reg_date ASC";
									$result = $conn->query($sql);
									displaytable($sql,$result);
									
								break;
								case "regDESC"://decending sign in time
									$sql = "SELECT id, firstname, lastname, email, present, dayspresent, daysabsent, reg_date FROM studentdb ORDER BY reg_date DESC";
									$result = $conn->query($sql);
									displaytable($sql,$result);
									
								break;
							}
						}else{
							$sql = "SELECT id, firstname, lastname, email, present, dayspresent, daysabsent, reg_date FROM studentdb";
							$result = $conn->query($sql);
							displaytable($sql,$result);
						}
						
						

					?>
				</div>
			</table>
		</div>
	</body>
</html>


<?php

/**
 * displays table
 * parameters are the sql queries for sorting columns.
 */
function displaytable($sql,$result){
	include "./connect.php";

	//if the number of rows in the sql table is more than 0, for each row, display the columns of the table, else prompt user that there is no student on the list.
	if ($result -> num_rows > 0){

		while($row = $result -> fetch_assoc())

		echo "<tr><td>". $row["id"]. "</td>
		<td>". $row["firstname"] ."</td>
		<td>". $row["lastname"]."</td>
		<td>". $row["email"]. "</td>
		<td>". (($row["present"]) ? 'Present':'Absent') ."</td>
		<td>". $row["dayspresent"]."</td>
		<td>". $row["daysabsent"]."</td>
		<td>". (int)($row["dayspresent"]/($row["dayspresent"] + $row["daysabsent"])*100)."%</td>
		<td>". $row["reg_date"]."</td>
		<td> <a href='edit.php?id=".$row["id"]."' id='editbutton' >•••</a></td>
		</tr>";
	}else{
		echo "no students on the list.";
	}

	$conn -> close();//close the connection


	echo "</table>";
}


?>