<?php

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="./css/login.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
	<div id="mainDiv">
		<?php
		if (isset($_GET['message'])) {
			echo "<h1>Login failed. Please try again.</h1>";
		} else {
			echo "<h1>Sign in to LiftApp</h1>";
		}
		?>
		<form action="{{ path_for('auth.signin') }}" method="post">
			<input type="text" name="username" id="usernameInput" placeholder="Username">
			<input type="password" name="password" id="passwordInput" placeholder="Password">
			<button id="login">Login</button>
			<p id="createAccount"><a href="./createAccount">Create an account</a></p>
		</form>
	</div>

</body>
<script type="text/javascript">
	function setup() {
		var userNameInput;
		userNameInput = document.getElementById('usernameInput');
		userNameInput.focus();
	}

	window.addEventListener('load', setup, false);

	$('div').hide().fadeIn(1000);

</script>
</html>
