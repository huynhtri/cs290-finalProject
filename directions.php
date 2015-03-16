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
		<title>Directions</title>
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
			          <li><a href="directions.php" class="selected">Directions</a></li>
			          <li><a href="contact.php">Contact</a></li>
			          <li><a href="login.html">Login</a></li>
		 	          <li><a href="register.html">Register</a></li>
		 	          <li><a href="logout.php">Logout</a></li> 	          
			        </ul>
	      		</nav>
			</header>
		</div>
		<div id="content">
			<h3>Google Maps API</h3>
			<p>This API only shows two location pointers to see both addresses on the map</p>
			<div id="map-canvas"></div>
			<p>Enter the starting and ending address in the textbox below to view both locations on google maps. Note that if both
				points are not seen on the map, that means that the map is zoomed in too far. Just zoom out to see both points in that
				case.</p>
			Enter starting address:<input type="text" id="currentLocation"><br>
			Enter ending address: <input type="text" id="endPoint"><br>
			<button id="seeLocation" onclick="javascript:codeAddress(); return false" style="height: 25px; width: 150px;">Search Locations</button>
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
    zoom: 8,
    center: new google.maps.LatLng(49.5, -113.35)
	};
	geocoder = new google.maps.Geocoder();

	map = new google.maps.Map(document.getElementById('map-canvas'),
		mapOptions);
}

//Gathers the point coordinates based on what the user inputs and puts them on the map
function codeAddress() {
  var address = document.getElementById("currentLocation").value;
  var point1;
  var point2;

  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      point1 =results[0].geometry.location;
      map.setZoom(8);
      marker1 = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location                 
      });
    } else {
        alert("Geocode was not successful for the following reason: " + status);
    }
  });
	
	var address = document.getElementById("endPoint").value;
  geocoder.geocode( { 'address': address}, function(results, status) {
	  if (status == google.maps.GeocoderStatus.OK) {
	    point2 =results[0].geometry.location;
	    map.setZoom(8);
	    marker2 = new google.maps.Marker({
	        map: map,
	        position: results[0].geometry.location                 
	    });

	  //Calculates the center of position 1 and 2 and then sets the center
	  positionLat = (marker1.position.lat() + marker2.position.lat()) / 2;
	  positionLng = (marker1.position.lng() + marker2.position.lng()) / 2;

	  map.setCenter(new google.maps.LatLng(positionLat, positionLng));
	  } else {
	      alert("Geocode was not successful for the following reason: " + status);
	  }
	});

}
</script>

