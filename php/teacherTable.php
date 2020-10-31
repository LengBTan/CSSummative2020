<!DOCTYPE html>
<html lang=en>
	<head>
		<title>TeacherDB</title>
		<link rel="stylesheet" href="style.css">
	</head>
	
	<body>
		<header id="teacherheader">
		<h2 id="title">TeacherDB</h2>

			<?php
				include "./connect.php";
				include "./users.php";

				session_start();
				$teacher = new Teacher();

				if(!$teacher->session()){
					header("Location: ./index.php");
				}

				if($teacher->session()){
					echo "<h4 id='titlee'>Currently logged in as: ".$_SESSION['email']."</h4>";
				}

				if(isset($_GET['logoutsession'])){
					$teacher->logout();
					header("Location: ./index.php");
				}

			?>
			<a href="?logoutsession" class="logoutbutton">Log out</a>

		</header>
		




		<?php
		

		

		

		//creates table called StudentDB, with headers of id, firstname, lastname, email, password, present, and reg_date
		//$sql = "CREATE TABLE StudentDB (
		//id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		//firstname VARCHAR(30) NOT NULL, 
		//lastname VARCHAR(30) NOT NULL,
		//email VARCHAR(50),
		//password varchar(50) NOT NULL,
		//present BOOLEAN NOT NULL,
		//reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
		//)";

		//creates table called teacherDB, with headers of id, firstname, lastname, email, password, and reg_date
		//$sql = "CREATE TABLE teacherDB (
		//id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		//firstname VARCHAR(30) NOT NULL,
		//lastname VARCHAR(30) NOT NULL,
		//email VARCHAR(50) NOT NULL,
		//password varchar(50) NOT NULL,
		//reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
		//)";
	

		//checks if table has been created.
		//if ($conn->query($sql) === TRUE) {
		//	echo "Table created successfully <br>";
		//} else {
		//	echo "Error creating table: <br>" . $conn->error . "<br>";
		//}

		
		?>

		<!-- Table of the database-->
		<div id="tablebox">
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
				<div id="students">
					<?php
						//selects data from the table named "studentDB", and uses the data to display it in a html table
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
							<td> <a href='edit.php?id=".$row["id"]."' id='editbutton' >•••</a></td>
							</tr>";
						}else{
							echo "no students on the list.";
						}

						$conn -> close();//close the connection


						echo "</table>";

						//ALTER TABLE table_name AUTO_INCREMENT = value; //to reset the id increment in mysql

					?>
				</div>
			</table>
		</div>
	</body>
</html>