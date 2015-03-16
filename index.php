<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	session_start();

	if(isset($_SESSION['username'])){
		$username = $_SESSION['username'];
		echo 'You are logged in as ' . $username;
	} else{
		echo 'You are not logged in.';
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link rel="stylesheet" href="main.css" type="text/css">
	</head>
	<body>
		<div id="headerPart">
			<header>
				<h1>This Amazing Piano Studio</h1>
				<nav>
	        <ul>
	          <li><a href="index.php" class="selected">Home</a></li>
	          <li><a href="bio.php">Biography</a></li>
	          <li><a href="pictures.php">Pictures</a></li>
	          <li><a href="directions.php">Directions</a></li>
	          <li><a href="contact.php">Contact</a></li>
	          <li><a href="login.html">Login</a></li>
 	          <li><a href="register.html">Register</a></li>
 	          <li><a href="logout.php">Logout</a></li> 	          
	        </ul>
      	</nav>
			</header>
		</div>
		<div id="content">
			<br>
			<img src="pictures/piano.jpg" style="max-width: 45%">
			<h3>This Amazing Piano Studio</h3>
			<p>We provide private piano lessons for people of all ages for those who would
				like to go on a journey of music. We teach all different styles from classical,
				jazz, comtemporary, etc. We have been around for over 1,000 years and have
				introduced more than 9,000 students to the joy of music.</p>
			<img src="pictures/pianoPlaying.jpg" style="max-width: 45%">
			<img src="pictures/pianoRecital.jpg" style="max-width: 45%">
			<p>We offer group classes, private lessons, and workshops all around the world! 
				If one of your dreams is to play the piano. We have created the best way for
				you to start so you will easily play popular pieces in a short amount of time.
				If you would like to start your child at an early age, this program will help
				children develop perfect pitch as well!</p>
		</div>
	</body>
</html>