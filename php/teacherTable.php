<!DOCTYPE html>
<html lang=en>
	<head>
	<title>TeacherDB</title>
	<link rel="stylesheet" href="./style.css">
	</head>
	
	<body>

		<?php
		$servername = "localhost";
		$username = "username";
		$password = "password";
		$db = "cssummativedb";

		// create connection
		$conn = mysqli_connect($servername, $username, $password,$db);

		// check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		echo "Connected successfully <br>";


		//creates table called StudentDB, with headers of id, firstname, lastname, email, present, and reg_date
		$sql = "CREATE TABLE StudentDB (
		id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		firstname VARCHAR(30) NOT NULL,
		lastname VARCHAR(30) NOT NULL,
		email VARCHAR(50),
		present BOOLEAN NOT NULL,
		reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
		)";

		//checks if table has been created.
		if ($conn->query($sql) === TRUE) {
			echo "Table created successfully <br>";
		} else {
			echo "Error creating table: " . $conn->error;
		}







		
		$sql = "INSERT INTO StudentDB (firstname, lastname, email, present) VALUES ('placeholder', 'placeholder', 'placeholderemail', false)";
		
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		  } else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		 }

		 //ALTER TABLE table_name AUTO_INCREMENT = value; //to reset the id increment 

		//$conn->close();// only need to close connection once, leave for now
		
		
		
		
		?>



		<!-- Table of the database-->
		<table>
			<tr>
				<th>Id</th>
				<th>First name</th>
				<th>Last name</th>
				<th>Email</th>
				<th>Present</th>
				<th>Register date</th>
			</tr>
			<?php
			
				$conn = mysqli_connect($servername, $username, $password,$db);
				if (!$conn) {
					die("Connection failed: " . mysqli_connect_error());
				}
				$sql = "SELECT id, firstname, lastname, email, present, reg_date FROM studentdb";
				$result = $conn->query($sql);

				if ($result -> num_rows > 0){
					while($row = $result -> fetch_assoc())
					echo "<tr><td>". $row["id"]. "</td><td>". $row["firstname"] ."</td><td>". $row["lastname"]."</td><td>". $row["email"]. "</td><td>". $row["present"]."</td><td>". $row["reg_date"]."</td></tr>";
				}else{
					echo "no students on the list.";
				}


				$conn -> close();
				echo "</table>";
			?>

		</table>


	</body>
</html>