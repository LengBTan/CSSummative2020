<!DOCTYPE html>
<html lang=en>
	<head>
		<title>TeacherDB</title>
		<link rel="stylesheet" href="./style.css">
	</head>
	
	<body>

		<?php

		include "connect.php";

		//creates table called StudentDB, with headers of id, firstname, lastname, email, present, and reg_date
		$sql = "CREATE TABLE StudentDB (
		id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		firstname VARCHAR(30) NOT NULL, 
		lastname VARCHAR(30) NOT NULL,
		email VARCHAR(50),
		present BOOLEAN NOT NULL,
		reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
		)";


		$sql = "CREATE TABLE users (
		id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		firstname VARCHAR(30) NOT NULL,
		lastname VARCHAR(30) NOT NULL,
		email VARCHAR(50) NOT NULL,
		password varchar(50) NOT NULL,
		reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
		)";
	
		



		//checks if table has been created.
		if ($conn->query($sql) === TRUE) {
			echo "Table created successfully <br>";
		} else {
			echo "Error creating table: <br>" . $conn->error . "<br>";
		}

		
		?>


		<!-- Table of the database-->
		<table>
			<tr>
				<th>Id</th>
				<th>First name</th>
				<th>Last name</th>
				<th>Email</th>
				<th>Present</th>
				<th>Sign in time</th>
				<th>EDIT</th>
			</tr>
			<?php

				//selects data from the table named "studentDB", and uses the data to put it in a html table
				$sql = "SELECT id, firstname, lastname, email, present, reg_date FROM studentdb";
				$result = $conn->query($sql);

				if ($result -> num_rows > 0){

					while($row = $result -> fetch_assoc())
					echo "<tr><td>". $row["id"]. "</td>
					<td>". $row["firstname"] ."</td>
					<td>". $row["lastname"]."</td>
					<td>". $row["email"]. "</td>
					<td>". (($row["present"]) ? 'Present':'Absent') ."</td>
					<td>". $row["reg_date"]."</td>
					<td> <a href='edit.php?id=".$row["id"]."' >EDIT</a></td>
					</tr>";
				}else{
					echo "no students on the list.";
				}

				$conn -> close();//close the connection


				echo "</table>";


				//ALTER TABLE table_name AUTO_INCREMENT = value; //to reset the id increment in mysql



				//html delete function query to delete a selected student
				function deleteRow($id){
					
				}

				//edit function to edit a selected student


				//create student function
				//$sql = "INSERT INTO StudentDB (firstname, lastname, email, present) VALUES ('placeholder', 'placeholder', 'placeholderemail', false)";
		

				//if ($conn->query($sql) === TRUE) {
				//	echo "New record created successfully";
				//} else {
				//	echo "Error: " . $sql . "<br>" . $conn->error;
				//}

			?>

		</table>

		<br><!-- remove later when stylizing-->

			<form action="editTable.php" method="POST">
				<input type="button" value="Edit table" onclick="window.location.href='editTable.php'">
			</form>

	</body>
</html>