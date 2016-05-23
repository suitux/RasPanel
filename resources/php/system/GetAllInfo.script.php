<?php 

	/**
	 * Script to get all the information of the System to fill the Status panel
	 * This script, returns a JSON.
	 */

	include_once('../managers/WebPartManager.class.php');		//To load the WebParts
	include_once('../managers/Authentification.class.php');		//To check if the user it's logged in
	include_once('../managers/LocationManager.class.php');		//To go to another sites
	include_once('../managers/UserManager.class.php');
	include_once("../system/System.class.php");

	//If it's no logged in, redirect to the login.	
	$auth = new Authentification();
	if(!$auth->isLoggedIn()) 
		LocationManager::redirectTo(LocationManager::ROOT);

	//To manage Permissions
	$um = new UserManager();

	//If the user has privileges: 
	if(($privileged = $um->getById($_SESSION['id'])->getPrivileges()->getStatus())) {

		//Number of processes to be shown in the CPU box
		$numberOfProcesses = 8;

		//Creating new system
		$system = new System();

		//Getting Processor
		$processor = $system->getProcessor();

		//Getting RAM
		$ram = $system->getRam();

		//Getting HDD
		$hdd = $system->getHDD();

		$jsonReturned = new Array();

	}



?>