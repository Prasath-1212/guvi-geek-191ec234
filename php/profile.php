<?php

session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
  header('Location: php/login.php');
  exit();
}

// Connect to Redis server
$redis = new Redis();
$redis->connect('localhost', 6379);

// Get user data from Redis
$userData = $redis->get($_SESSION['username']);

// Decode user data
$userData = json_decode($userData, true);

// Check if user data exists
if (!$userData) {
  header('Location: php/login.php');
  exit();
}

// Get user profile data from MySQL database
$pdo = new PDO('mysql:host=localhost;dbname=mydatabase', 'username', 'password');
$stmt = $pdo->prepare('SELECT * FROM users_db WHERE username = :username');
$stmt->execute(array('username' => $_SESSION['username']));
$userProfileData = $stmt->fetch(PDO::FETCH_ASSOC);

// Display user profile information
echo '<h1>Welcome,    </h1>';
echo '<p>Age: '.$userProfileData['age'].'</p>';
echo '<p>Date of Birth: '.$userProfileData['dob'].'</p>';
echo '<p>Contact: '.$userProfileData['contact'].'</p>';
?>
