<?php

//$conn = mysqli_connect('localhost','root','','user_db');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Retrieve the user data from the form
	$email = $_POST['email'];  
	$password = $_POST['password'];

	// Hash the password for security
	$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

	// Connect to the MySQL database
	$servername = "localhost";
	$password = "password";
	$dbname = "user_db";

	$conn = new mysqli($servername, $password, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	// Prepare the SQL statement to insert the user data
	$stmt = $conn->prepare("INSERT INTO user_db (email, password) VALUES ( ?, ?)");
	$stmt->bind_param("sss",  $email, $hashedPassword);

	if ($stmt->execute()) {
		echo "Signup successful!";
	} else {
		echo "Error: " . $stmt->error;
	}
    
	$stmt->close();
	$conn->close();
}
?>
