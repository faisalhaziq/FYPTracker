<?php
	$server = "localhost";
	$user = "root";
	$pass = "";
	$db_name = "fypattend";

	$conn = new mysqli($server, $user, $pass, $db_name);

	if ($conn -> connect_errno) {
	echo "Failed to connect to server. " . $conn -> connect_error;
	exit();
	}else{
		//echo "Connection Success!";
	}
?>