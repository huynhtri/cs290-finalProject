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
		<title>Biography</title>
		<link rel="stylesheet" href="main.css" type="text/css">
	</head>
	<body>
		<div id="headerPart">
			<header>
				<h1>This Amazing Piano Studio</h1>
				<nav>
			        <ul>
			          <li><a href="index.php">Home</a></li>
			          <li><a href="bio.php" class="selected">Biography</a></li>
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
			<img src="pictures/francisco.jpg" alt="Francisco Bio Picture" style="max-width: 45%">
			<h3>Francisco Naranjo</h3>
			<p>Francisco Naranjo graduated Magna Cum Laude from Northern Arizona University (NAU) 
				in 2012.  He received a Bachelor’s of Music Education Degree with emphasis in solo 
				piano and tuba. During his time at NAU, Francisco participated in various performance 
				groups including piano ensemble, concert band, marching band, and choir. His passion 
				for music and traveling led him to travel throughout Europe where he had the opportunity 
				to study Spanish music at the University of Granada in Granada, Spain.  In addition, 
				he participated in the Chinese Music and Culture program at the Shenyang Conservatory 
				of Music in Shenyang, China after returning from Spain.</p>
			<p>Mr. Naranjo is a member of the Phoenix Music Teachers Association (PMTA), Arizona 
				Music Teachers Association (ASMTA) Music Teachers National Association (MTNA), the 
				National Association for Music Education, the National Piano Guild, and the Arizona 
				Music Educators Association (AMEA). Aside from teaching piano at Music Works Academy, 
				Mr. Naranjo is the music teacher at BASIS Ahwatukee, working with 4th-11th grade 
				students in a variety of music classes that include general music, choir, band, and 
				class piano.</p>
			<h3>Brody Short's 2015 PMTA Piano Ensemble Performance</h3>
			<iframe width="420" height="315" src="https://www.youtube.com/embed/0S6-15ICVLM" frameborder="0" allowfullscreen></iframe>
		</div>
	</body>
</html>