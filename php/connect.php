<?php


// Create connection
$conn = mysqli_connect("localhost", "username", "password","cssummativedb");
    

	// Check connection
	if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        echo "Connection failed";
	}
    echo "Connected successfully <br>";
    
?>