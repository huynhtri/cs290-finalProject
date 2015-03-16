/*********************************************************************
* AJAX Portion 
*********************************************************************/
//Function that creates an account for the user
function register(){
	//Gets the ID values from the html page and puts them in variables
	registerMessage = document.getElementById('registerMessage');
	var username = document.getElementById("username").value;
	var password = document. getElementById("password").value;
	var confirmPassword	= document. getElementById("confirmPassword").value;
	var email = document. getElementById("email").value;
	var firstName = document. getElementById("firstName").value;
	var lastName = document. getElementById("lastName").value;

	//If username or password is empty, tells user to fill them in. Else, proceed to login.
	if(username == "" || password == "" || confirmPassword == "" || email == "" || firstName == "" || lastName == ""){
		registerMessage.innerHTML = "Invalid entry - You must fill in all information...";
	}
	else if(!(password == confirmPassword)){
		registerMessage.innerHTML = "Invalid entry - Passwords do not match...";
	}
	else{
		var xmlHttp = createXmlHttpRequestObject();
		process();
	}

	function createXmlHttpRequestObject(){
		var xmlHttp;

		if(window.XMLHttpRequest)
			xmlHttp = new XMLHttpRequest();
		else
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");

		return xmlHttp;
	}

	function process(){
		if(xmlHttp){
			try{
				xmlHttp.open("POST", "register.php", true);
				xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				xmlHttp.onreadystatechange = checkServerStatus;

				//Sets up the data to be sent to the server
				var sendData = "username=" + username + "&" + "password=" + password + "&" + "email=" + email
							 + "&" + "firstName=" + firstName + "&" + "lastName=" + lastName;
				xmlHttp.send(sendData);
			} 
			catch(e){
				alert(e.toString());
			}
		}
	}

	//Function that checks if server works.
	function checkServerStatus(){
		if(xmlHttp.readyState===4){
			if(xmlHttp.status===200){
				text = xmlHttp.responseText;
				registerMessage.innerHTML = text;
			}
			else
				alert(xmlHttp.statusText);
		}
	}
}

