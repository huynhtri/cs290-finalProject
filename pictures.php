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
		<title>Pictures</title>
		<link rel="stylesheet" href="main.css" type="text/css">
	</head>
	<body>
		<div id="headerPart">
			<header>
				<h1>This Amazing Piano Studio</h1>
				<nav>
			        <ul>
			          <li><a href="index.php">Home</a></li>
			          <li><a href="bio.php">Biography</a></li>
			          <li><a href="pictures.php" class="selected">Pictures</a></li>
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
			<img src="pictures/student1.jpg" style="max-width: 45%">
			<br>
			<img src="pictures/student2.jpg" style="max-width: 45%">
			<br>
			<img src="pictures/student3.jpg" style="max-width: 45%">
			<br>
			<img src="pictures/student4.jpg" style="max-width: 45%">
			<br>
		</div>
	</body>
</html>