<?php

	/**
	 * Logs out an User.
	 * Inits the $_SESSION.
	 * If the S_SESSION['id'] it's set, logs out the user and redirects it to the Login Page
	 */
	include_once(dirname(__FILE__) . '/../managers/Authentification.class.php');
	include_once(dirname(__FILE__) . '/../managers/LocationManager.class.php');
	include_once(dirname(__FILE__) . '/../managers/UserManager.class.php');

	if(!isset($_SESSION))
		session_start();


	if(isset($_SESSION['id'])) {
		$um = new UserManager();
		$um->setIn($um->getById($_SESSION['id']), false);
		session_destroy();

		LocationManager::redirectTo(LocationManager::ROOT);
	}
	LocationManager::redirectTo(LocationManager::ROOT);

?>