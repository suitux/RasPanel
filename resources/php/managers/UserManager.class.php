<?php
	include_once(dirname(__FILE__) . '/../entities/User.class.php');
	include_once(dirname(__FILE__) . '/../ddbb/UserDB.class.php');
	include_once(dirname(__FILE__) . '/../src/password_hash.lib.php');

	/**
	 * Manages the users from the storage
	 */
	class UserManager {

		/**
		 * Connection to the storage to manage the Users
		 * @var UserDB
		 */
		private $userDB;

		/**
		 * Default constructor: Inits the Storage
		 */
		public function __construct() {
			$this->userDB = new UserDB();
		}

		/**
		 * Returns an arraylist of all the users of the storage
		 * @return ArrayList of users
		 */
		public function getAll() {
			return $this->userDB->getAll();
		}

		/**
		 * Returns an user by his ID
		 * @param  int $id ID of the user
		 * @return User     User that has the same ID from the request
		 */
		public function getById($id) {
			return $this->userDB->getById($id);
		}

		/**
		 * Returns an user by his Name
		 * @param  string $name Name of the user
		 * @return User     User that has the same Name from the request       
		 */
		public function getByName($name) {
			return $this->userDB->getByName($name);
		}

		/**
		 * Adds an user to the storage
		 * @param User   $user     User to add to the storage
		 * @param string $password Password of the user
		 */
		public function add(User $user) {
			$user->setHash(password_hash($user->getHash(), PASSWORD_BCRYPT));		//Hashing password
			return $this->userDB->add($user);
		}
		
		/**
		 * Deletes an user from the storage
		 * @param  User   $user User to be deleted in the storage
		 * @return User       Returns the deleted user. If there aren't deleted users, returns a null user
		 */
		public function delete(User $user) {
			return $this->userDB->delete($user);
		}

		/**
		 * Sets if an user it's logged in
		 * @param User $user User to set
		 * @param bool $isin If it's in = true. If not = false
		 */
		public function setIn(User $user, $isin) {
			return $this->userDB->setIn($user, $isin);
		}

		/**
		 * Check if the User is logged in
		 * @param  User   $user User to chech
		 * @return Boolean      True: The user it's logged in. False: The user isn't logged in.
		 */
		public function isin(User $user) {
			return $this->userDB->isin($user);
		}
	}
?>