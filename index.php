<?php 
	include_once('resources/php/managers/Authentification.class.php');		//To check if the user it's logged in
	include_once('resources/php/managers/LocationManager.class.php');		//To go to another sites

	//If it's no logged in, redirect to the login.	
	$auth = new Authentification();
	if($auth->isLoggedIn()) 
		LocationManager::redirectTo(LocationManager::PANEL);
?>
<html>
	<head>
		<title>Raspberry Pi</title>
		<link rel="icon" type="image/png" href="resources/img/raspberry.ico" />
		<link rel="stylesheet" type="text/css" href="resources/css/index.css" />
	</head>
	<body class="background-color-light">
		<div id="login_container"> 
			<div class="login">
				<div class="login_box background-white">
					<nav class="header dark-primary-color">
						<h1 class="text-color-white">Login</h1>
					</nav>
					<div class="inputs">
						<form method="POST" action="resources/php/scripts/login.script.php">
							<input type="text" name="username" placeholder="Username" />
							<input type="password" name="password" placeholder="Password" />
							<button class="dark-primary-color text-color-white" name="submit">Log in</button> 
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>