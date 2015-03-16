<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	session_start();

	if(isset($_SESSION['username'])){
		$username = $_SESSION['username'];
		echo 'You are logged in as ' . $username;
	} else{
		$username = NULL;
		echo 'You are not logged in.';
	}

	//includes hidden info to get access to the database
	include 'dbInfo.php';

	//Connects to the database and gives an error if it does not connect properly
	$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	if(!$mysqli || $mysqli->connect_errno){
		echo 'Cannot log in to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error;
	} 
	
	//If add comments is filled out, it checks if there's a username logged in and then submits comment
	if(isset($_SESSION['username'])){
		if(isset($_POST['addComment'])){
			$name = $_POST['fullName'];
			$email = $_POST['email'];
			$message = $_POST['message'];

			//Checks if any of the post form textboxes are blank 
			if($name == null){
				echo '<br>Name must be filled in...<br/>';
			}
			if($email == null){
				echo '<br>Email must be filled in...<br/>';
			}
			if($message == null){
				echo '<br>Message must be filled in...<br/>';
			}	
			if($name != null && $email != null && $message != null){
				if(!($stmt = $mysqli->prepare("INSERT INTO contactLog(name, username, email, message) VALUES ('$name', '$username', '$email', '$message')"))){
					echo 'Prepare video failed...';
				}
				if(!$stmt->execute()){
					echo 'Execute video failed...';
				}
			}
		}
	} else{
		echo '<br>You must be logged in to add a comment.';
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Contact</title>
		<link rel="stylesheet" href="main.css" type="text/css">
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
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
			          <li><a href="contact.php" class="selected">Contact</a></li>
			          <li><a href="login.html">Login</a></li>
		 	          <li><a href="register.html">Register</a></li>
		 	          <li><a href="logout.php">Logout</a></li> 	          
			        </ul>
		      	</nav>
			</header>
		</div>
		<div id="content">
			<h3>Location</h3>
			<div id="map-canvas"></div>
			<h3>Contact Us</h3>
			<p>The Amazing Piano Studio (All fake info)<br>
				9999 W Some St <br>
				Phoenix, AZ 46897 <br>
				(602)867-5309</p>
			<h3>Enter message here (You must be logged in to enter a message:</h3>
			<form action='contact.php' method='POST'>
				<label>Name:</label><input type='text' name='fullName'><br>
				<label>Email:</label><input type='text' name='email'><br><br>
				Message: <textarea name="message" style="height: 5em; width: 20em"></textarea><br>
				<input type='submit' name='addComment' value="Send Message"><br>
			</form>
			<table>
				<h3>Message History</h3>
				<p>Note that all messages can be viewed by admin only.</p>
				<thead>
					<tr>
		  			<th>Name</th>
		  			<th>Email</th>
		  			<th>Message</th>
					</tr>
				</thead>
				<tbody>
					<?php
						//Displays the content history grabbed from SQL
						if(!($username === NULL || $username === 0)){
							$name = NULL;
							$email = NULL;
							$message = NULL;

							if($username === "admin"){
								if(!($stmt = $mysqli->prepare("SELECT name, username, email, message FROM contactLog"))){
									echo 'Prepare failed: (' . $mysqli->errno . ') ' . $mysqli->error;
								}
							} else{
								if(!($stmt = $mysqli->prepare("SELECT name, username, email, message FROM contactLog WHERE username = '$username'"))){
									echo 'Prepare failed: (' . $mysqli->errno . ') ' . $mysqli->error;
								}
							}
							if(!$stmt->execute()){
								echo 'Execute failed: (' . $stmt->errno . ') ' . $stmt->error;
							}
							if(!$stmt->bind_result($name, $username, $email, $message)){
								echo 'Binding parameters failed: (' . $stmt->errno . ') ' . $stmt->error;
							}
							while($stmt->fetch()){
								echo '<tr>';
								echo '<td>' . $name . '</td>';
								echo '<td>' . $email . '</td>';
								echo '<td>' . $message . '</td>';			
								echo '</tr>';
							}
						} 
					?>
				</tbody>
			</table>
		</div>
	</body>
</html>

<script>
//@ sourceURL=mapWindow.js
//Runs the google maps right when it loads
window.onload = initialize;

var map;

//Function that runs the APi when the web page loads
function initialize(){
  var mapOptions = {
    zoom: 11,
    center: new google.maps.LatLng(33.45, -112.07)
	};
	geocoder = new google.maps.Geocoder();

	map = new google.maps.Map(document.getElementById('map-canvas'),
		mapOptions);

  var address = "100 N 15th Ave, Phoenix, AZ";
  var point;

  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      point =results[0].geometry.location;
      map.setZoom(11);
      marker1 = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location                 
      });
    } else {
        alert("Geocode was not successful for the following reason: " + status);
    }
  });
}
</script>