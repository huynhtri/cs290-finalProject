
<?php
	session_start();

	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	//includes hidden info to get access to the database
	include 'dbInfo.php';

	//Connects to the database and gives an error if it does not connect properly
	$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	if(!$mysqli || $mysqli->connect_errno){
		echo 'Cannot log in to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error;
	} 
	//Checks if the input matches the SQL DB. If it does, it logs the user in. If not, gives an error to the user.
	else{
		//Used to identify if the user entered the wrong information
		$wrongInfo = 0;

		//Stores the input to usernamd and password variable
		$username = $_POST['username'];
		$password = $_POST['password'];

		//Accesses the database to check if username and password matches the database
		$userInfo = array();
		$passwordInfo = array();

		if(!($stmt = $mysqli->prepare('SELECT username, password FROM loginDatabase'))){
			echo 'Prepare failed: (' . $mysqli->errno . ') ' . $mysqli->error;
		}
		if(!$stmt->execute()){
			echo 'Execute failed: (' . $stmt->errno . ') ' . $stmt->error;
		}
		if(!$stmt->bind_result($pullUserInfo, $pullPasswordInfo)){
			echo 'Binding parameters failed: (' . $stmt->errno . ') ' . $stmt->error;
		}
		while($stmt->fetch()){
			array_push($userInfo, $pullUserInfo);
			array_push($passwordInfo, $pullPasswordInfo);
		}

		//Matches the inputted username and password with the database
		foreach($userInfo as $checkInfo1){
			foreach($passwordInfo as $checkInfo2){
				if($checkInfo1 === $username && $checkInfo2 === $password){
					echo 'Login Successful';
					$_SESSION['username'] = $username;
					$wrongInfo = 1;
					break;
				}
			}
		}

		//If wrongInfo is 0, the user entered an invalid username or password
		if($wrongInfo === 0){
			echo 'Error... Invalid username or password';
		}
	}
?>
