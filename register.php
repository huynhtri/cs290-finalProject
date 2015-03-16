
<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	//includes hidden info to get access to the database
	include 'dbInfo.php';

	//Connects to the database and gives an error if it does not connect properly
	$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	if(!$mysqli || $mysqli->connect_errno){
		echo 'Cannot log in to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error;
	} 
	//Checks for duplicate username and if there isn't, it proceeds with the registration
	else{
		//Used to identify if the user entered the wrong information
		$wrongInfo = 1;

		//Stores the input to usernamd and password variable
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];

		//Checks for duplicate usernames
		$userInfo = array();

		if(!($stmt = $mysqli->prepare('SELECT username FROM loginDatabase'))){
			echo 'Prepare failed: (' . $mysqli->errno . ') ' . $mysqli->error;
		}
		if(!$stmt->execute()){
			echo 'Execute failed: (' . $stmt->errno . ') ' . $stmt->error;
		}
		if(!$stmt->bind_result($pullUserInfo)){
			echo 'Binding parameters failed: (' . $stmt->errno . ') ' . $stmt->error;
		}
		while($stmt->fetch()){
			array_push($userInfo, $pullUserInfo);
		}

		//Matches the inputted username database. If it does match, do not create new account.
		foreach($userInfo as $checkInfo){
			if($checkInfo === $username){
				echo 'Error, username already exists. Please enter another username.';
				$wrongInfo = 0;
				break;
			}
		}

		//If wrongInfo is 0, that means that the username already exists so it does not update database.
		if($wrongInfo === 1){
			//If there are no errors, proceed to adding the movies to the database
			if(!($stmt = $mysqli->prepare("INSERT INTO loginDatabase(username, password, email, firstName, lastName) 
				VALUES ('$username', '$password', '$email', '$firstName', '$lastName')"))){
				echo 'Prepare registration failed...';
			}
			if(!$stmt->execute()){
				echo 'Execute registration failed...';
			}
			else{
				echo 'Your account has been created. Please log in again to view the contents.';
			}
		}
	}
?>
