<?php

	include_once(dirname(__FILE__) . '/../entities/User.class.php');
	include_once(dirname(__FILE__) . '/../src/password_hash.lib.php');
	include_once(dirname(__FILE__) . '/UserManager.class.php');

	if(!isset($_SESSION))
		session_start();

	/**
	 * Class to authentificate the users
	 */
	class Authentification {

		/**
		 * UserManager to manage the users
		 * @var UserManager
		 */
		private $userManager;

		/**
		 * Default constructor. 
		 * Inits the UserManager
		 */
		public function __construct() {
			$this->userManager = new UserManager();
		}

		/**
		 * Check if an user exists and the password it's correct
		 * @param  User   $user User to check
		 * @return Integer Code.
		 * Codes: 
		 * 		1: User login it's correct
		 * 		0: User's password it's incorrect
		 * 	   -1: User's name it's incorrect 
		 */
		public function login(User $user) {
			$userToLogin = $this->userManager->getByName($user->getName());

			if($userToLogin->getId() != null) 
				if(password_verify(htmlentities($user->getHash()), $userToLogin->getHash()))
					return 1;
				else 
					return 0;
			else 
				return -1;
			
		}

		/**
		 * Check if there is an user logged in
		 * @return boolean True: An user it's logged in. False: There are no user's logged on the panel
		 */
		public function isLoggedIn() {
			if(isset($_SESSION['id'])) 
				return $this->userManager->isin($this->userManager->getById($_SESSION['id']));
			else 
				return false;
		}
	}
?>