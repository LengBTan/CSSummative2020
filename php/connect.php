<?php

function connect(){
    $servername = "localhost";
	$username = "username";
	$password = "password";
    $db = "cssummativedb";
    
    // Create connection
	$conn = mysqli_connect($servername, $username, $password,$db);

	// Check connection
	if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        return "Connection failed";
	}
    echo "Connected successfully <br>";
    return "Connected successfully";
    }
?>