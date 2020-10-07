<!DOCTYPE html>
<html>
	<head>
	<title> database application</title>
	</head>
	
	<body>
	</body>
	
	
	<?php
$servername = "localhost";
$username = "username";
$password = "password";
$db = "cssummativedb";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$db);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully <br>";



$sql = "CREATE TABLE StudentDB (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50),
present BOOLEAN NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

)";

if ($conn->query($sql) === TRUE) {
  echo "Table created successfully <br>";
} else {
  echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
	
	
	
	



</html>
