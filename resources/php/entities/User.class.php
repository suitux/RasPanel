<?php
	include_once(dirname(__FILE__) . '/Privileges.class.php');

	/**
	 * Encapsulates the basic information of an User
	 */
	class User {

		/**
		 * ID of the user
		 * @var Integer
		 */
		private $id;

		/**
		 * User's name
		 * @var String
		 */
		private $name;

		/**
		 * User's mail
		 * @var String
		 */
		private $mail;

		/**
		 * User's Phone
		 * @var Integer
		 */
		private $phone;

		/**
		 * User's Hash
		 * @var String
		 */
		private $hash;

		/**
		 * User Privileges
		 * @var Privileges
		 */
		private $privileges;

		/**
		 * Default constructor with all user params
		 * @param int $id    		ID of the user
		 * @param string $name  	User's name
		 * @param string $mail  	User's mail
		 * @param string $phone 	User's phone
		 * @param string $hash 	User's hash
		 */
		public function __construct($id, $name, $mail, $phone, $hash) {
			$this->id 		= $id;
			$this->name 	= $name;
			$this->mail 	= $mail;
			$this->phone 	= $phone;
			$this->hash 	= $hash;
		}

		/**
		 * Creates a user with name and password to log in
		 * @param  String $name     Name of the user
		 * @param  String $password Password of the user
		 * @return User           	Created user
		 */
		public static function withNameAndPassword($name, $password) {
			$instance = new self();
			$instance->setName($name);
			$instance->setHash($password);
			return $instance;
		}

		/* Getters and Setters */

		public function setId($id) {
			$this->id = $id;
		}
		public function getId() {
			return $this->id;
		}

		public function setName($name) {
			$this->name = $name;
		}
		public function getName() {
			return $this->name;
		}

		public function setMail($mail) {
			$this->mail = $mail;
		}
		public function getMail() {
			return $this->mail;
		}

		public function setPhone($phone) {
			$this->phone = $phone;
		}
		public function getPhone() {
			return $this->phone;
		}

		public function setHash($hash) {
			$this->hash = $hash;
		}
		public function getHash() {
			return $this->hash;
		}

		public function setPrivileges($privileges) {
			$this->privileges = $privileges;
		}
		public function getPrivileges() {
			return $this->privileges;
		}

		public function __toString() {
			return "User: {" . $this->id . "," . $this->name . "," . $this->mail . "," . $this->phone . ", " . $this->hash . ", ". $this->privileges ."}";
		}
	}
?>