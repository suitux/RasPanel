<?php 
	include_once('resources/php/managers/WebPartManager.class.php');		//To load the WebParts
	include_once('resources/php/managers/Authentification.class.php');		//To check if the user it's logged in
	include_once('resources/php/managers/LocationManager.class.php');		//To go to another sites
	include_once('resources/php/managers/UserManager.class.php');

	//If it's no logged in, redirect to the login.	
	$auth = new Authentification();
	if(!$auth->isLoggedIn()) 
		LocationManager::redirectTo(LocationManager::ROOT);

	//To manage Permissions
	$um = new UserManager();	
?>

<html>
	<head>
		<meta charset="utf-8">
		<title>Raspberry Pi</title>
		<link rel="stylesheet" type="text/css" href="resources/css/lib/font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" href="resources/css/panel.css" />
		<link rel="icon" type="image/png" href="resources/img/raspberry.ico" />
		<script type="text/javascript" src="resources/javascript/lib/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="resources/javascript/scripts/left_bar.script.js"></script>
		<script type="text/javascript" src="resources/javascript/scripts/panel.script.js"></script>

	</head>
	<body class="background-color-light">

		<?php WebPartManager::load(WebPartManager::LEFT_BAR_COMPONENT); ?>
		
		<div id="panel_body">
			<div id="panel_container">
				<div id="logo_image_container"><img id="logo_image" src="resources/img/raspberry_opacity_30.png" /></div>
				
				<?php
					$privileged = true;
					if(isset($_GET['location'])) {
						switch($_GET['location']) {
							case 'home': 
								WebPartManager::load(WebPartManager::HOME_PART);		//Home
							break;

							case 'status':
								if(($privileged = $um->getById($_SESSION['id'])->getPrivileges()->getStatus()))
									WebPartManager::load(WebPartManager::STATUS_PART); 
							break;

							default: 
								WebPartManager::load(WebPartManager::HOME_PART);		//Home by default
							break;
						}
						
						if(!$privileged)
							WebPartManager::load(WebPartManager::NO_PERMISSION_PART);
					}
					else 
						WebPartManager::load(WebPartManager::HOME_PART);				//Home by default
				?>

			</div>			
		</div>
	</body>
</html>