<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	//Logs the user out of the session
	session_start();
	session_unset();
	session_destroy();

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
		<title>Logout</title>
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
			          <li><a href="pictures.php">Pictures</a></li>
			          <li><a href="directions.php">Directions</a></li>
			          <li><a href="contact.php">Contact</a></li>
			          <li><a href="login.html">Login</a></li>
		 	          <li><a href="register.html">Register</a></li>
		 	          <li><a href="logout.php" class="selected">Logout</a></li> 	          
			        </ul>
	      		</nav>
			</header>
		</div>
		<div id="content">
			<p>You are now logged out!</p>
		</div>
	</body>
</html>