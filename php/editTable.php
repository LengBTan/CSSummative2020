<!DOCTYPE html>
<html lang=en>
	<head>
		<title>TeacherDB</title>
		<link rel="stylesheet" href="./style.css">
	</head>
	
	<body>

		<!-- Table of the database-->
		<table>

			<tr>
				<th>Id</th>
				<th>First name</th>
				<th>Last name</th>
				<th>Email</th>
				<th>Present</th>
				<th>Sign in time</th>
			</tr>

            <?php

                include "connect.php";

				$sql = "SELECT id, firstname, lastname, email, present, reg_date FROM studentdb";
				$result = $conn->query($sql);

				

				if ($result -> num_rows > 0){
					while($row = $result -> fetch_assoc())
					echo "
					<form>
					<tr>
					<td><input type='text' value=".$row["id"]."></td>
					<td><input type='text' value=".$row["firstname"]."></td>
					<td><input type='text' value=".$row["lastname"]."></td>
					<td><input type='text' value=".$row["email"]."></td>
					<td><input type='text' value=".$row["present"]."></td>
					<td>". $row["reg_date"]."</td>
					</tr>";
				}else{
					echo "no students on the list.";
				}



				

				
				$conn -> close();

                
				//$sql = "UPDATE studentdb SET "
				


				function submit (){
			
				}
				

				echo "</table> <br>
				<input type='submit' name='submit' value='submit'>
				</form>";
		
			?>
            

		



		






        
		<br><!-- remove later when stylizing-->

		<br>
			<form action="/php/teacherTable.php" method="POST">
				<input type="button" value="done" onclick="window.location.href='/php/teacherTable.php'">
			</form>

	</body>
</html>