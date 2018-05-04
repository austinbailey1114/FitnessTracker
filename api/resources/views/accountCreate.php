<?php

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="./css/accountCreate.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
	<div id="container">
		<form action="./users/addUser" method="post">
			<div id="nameDiv">
				<p id="promptName">Name:</p>
				<input type="text" name="name" id="nameInput" placeholder="name">
			</div>
			<div id="emailDiv">
				<p id="promptEmail">Email:</p>
				<input type="text" name="email" id="emailInput" placeholder="example@example.com">
			</div>
			<div id="usernameDiv">
				<p id='promptUsername'>Username:</p>
				<input type="text" name="username" id='usernameInput' placeholder="username">
			</div>
			<div id="passwordDiv">
				<p id="promptPassword">Password:</p>
				<input type="text" name="password" id="passwordInput" placeholder="password">
			</div>
			<button id="button">Create</button>
		</form>
	</div>
</body>
<script type="text/javascript">
	
	function checkUsername(value, id, reset) {
		var xhttp = new XMLHttpRequest();
		xhttp.open('POST', './api/users.php?user=' + value, false);
		xhttp.send();
		var success = JSON.parse(xhttp.responseText);
		if (success['success']) {
			var prompt = document.getElementById(id);
			prompt.innerHTML = "<img src='./images/warning.png' height='20' width='20' style='margin-right: 5px;'>Username Taken";
		} else {
			var prompt = document.getElementById(id);
			prompt.textContent = reset;
		}
	}

	function checkEmail(email) {
		var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    	if (re.test(email)) {
    		var prompt = document.getElementById('promptEmail');
    		prompt.textContent = "Email:";
    	} else {
    		var prompt = document.getElementById('promptEmail');
    		prompt.innerHTML = "<img src='./images/warning.png' height='20' width='20' style='margin-right: 5px;'>Invalid Email";
    	}
	}

	function arrayContains(username, takenUsernames) {
    	return (takenUsernames.indexOf(username) > -1);
	}

	var usernameInput = document.getElementById('usernameInput');
	usernameInput.addEventListener('input', function() { checkUsername(usernameInput.value, 'promptUsername', 'Username: ')});
	var emailInput = document.getElementById('emailInput');
	emailInput.addEventListener('blur', function() {checkEmail(emailInput.value)});
	
</script>
</html>