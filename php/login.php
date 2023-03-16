<?php
// Start the session

$conn = mysqli_connect('localhost','root','','user_db');

session_start();

// Include the Redis and MySQL configuration files
require_once('redis.php');
require_once('mysql.php');

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
	// Redirect to the profile page
	header('Location: profile.php');
	exit;
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Get the form data
	$email = $_POST['email'];
	$password = $_POST['password'];

	// Get the user from the database
	$stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ?");
	$stmt->bind_param('s', $email);
	$stmt->execute();
	$result = $stmt->get_result();
	$user = $result->fetch_assoc();

	// Check if the user exists and the password is correct
	if ($user && password_verify($password, $user['password'])) {
		// Set the user ID in the session
		$_SESSION['user_id'] = $user['id'];

		// Set the session ID in Redis
		$redis->setex('session:' . session_id(), 3600, $user['id']);

		// Return a JSON response indicating success
		echo json_encode(array('success' => true));
		exit;
	}
	else {
		// Return a JSON response indicating failure
		echo json_encode(array('success' => false, 'message' => 'Invalid email or password'));
		exit;
	}
}
?>
