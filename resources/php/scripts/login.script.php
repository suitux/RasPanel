<?php
	
	/**
	 * Logs in a User.
	 * This script, include the Authentification module, the LocationManager module and the UserManager module.
	 * Inits the $_SESSION
	 * If a $_SESSION['id'] its initialized, checks if the user it's logged in to the database
	 * If the user isn't logged on the DDBB, checks if the user password and the username are correct.
	 * If they are incorrect, redirects to the Login Page. 
	 */
	
	include_once(dirname(__FILE__) . '/../managers/Authentification.class.php');
	include_once(dirname(__FILE__) . '/../managers/LocationManager.class.php');
	include_once(dirname(__FILE__) . '/../managers/UserManager.class.php');

	if(!isset($_SESSION))
		session_start();

	if(!isset($_SESSION['id'])) {

		$auth = new Authentification();

		$loginCode = $auth->login(new User(0, $_POST['username'], null, null, $_POST['password']));

		switch ($loginCode) {
			case 0:	//User's password it's incorrect
				LocationManager::redirectTo(LocationManager::ROOT . "?loginStatus=0");
				break;
			case 1: //User login it's correct
				$um = new UserManager();

				$userLogedIn = $um->getByName($_POST['username']);

				$_SESSION['id'] = $userLogedIn->getId();	//Init a SESSION variable with the User's ID
				$um->setIn($userLogedIn, true);				//Set user in on the DDBB

				LocationManager::redirectTo(LocationManager::PANEL);				
				break;
			case -1: //User's name it's incorrect 
				LocationManager::redirectTo(LocationManager::ROOT . "?loginStatus=-1");
				break;
			default:
				LocationManager::redirectTo(LocationManager::ROOT . "?loginStatus=u");
				break;
		}
	} else {
		LocationManager::redirectTo(LocationManager::PANEL);
	}


?>