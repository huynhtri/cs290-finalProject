/*********************************************************************
* AJAX Portion 
*********************************************************************/
//Function that logs the user in to the website
function login(){
	//Gets the ID values from the html page and puts them in variables
	loginMessage = document.getElementById('loginMessage');
	var username = document.getElementById("username").value;
	var password = document. getElementById("password").value;

	//If username or password is empty, tells user to fill them in. Else, proceed to login.
	if(username == "" || password == ""){
		loginMessage.innerHTML = "You must fill in both username and password.";
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
				xmlHttp.open("POST", "login.php", true);
				xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				xmlHttp.onreadystatechange = checkServerStatus;

				//Sets up the data to be sent to the server
				var sendData = "username=" + username + "&" + "password=" + password;
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
				loginMessage.innerHTML = text;
			}
			else
				alert(xmlHttp.statusText);
		}
	}
}

