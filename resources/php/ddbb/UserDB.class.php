<?php
	include_once(dirname(__FILE__) . '/../entities/User.class.php');
	include_once(dirname(__FILE__) . '/../entities/Privileges.class.php');
	include_once(dirname(__FILE__) . '/../constants/DDBB.constants.php');
	include_once(dirname(__FILE__) . '/UserDatabaseInterface.interface.php');

	/**
	 * Allows to the programmer accessing to the DDBB and get all user's information
	 */
	class UserDB implements UserDatabaseInterface {

		/**
		 * Result to return
		 * @var Query's result
		 */
		private $result;

		/**
		 * Query to execute. It is the parsed .ini file with all the Queries
		 * @var array[string]
		 */
		protected $query;

		/**
		 * Connection to the DDBB
		 * @var MySQLi
		 */
		protected $connection;

		/**
		 * Default constructor
		 */
		public function __construct() {
			$this->connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
			$this->query = parse_ini_file(dirname(__FILE__) . "/../constants/DDBB_query.ini");
		}

		/**
		 * Returns an arraylist of all the users of the DDBB
		 * @return ArrayList of users [description]
		 */
		public function getAll() {

			$userList = array();

			$this->result = $this->connection->query($this->query['SELECT_ALL_USER']);

			foreach ($this->result as $user) {
				array_push($userList, new User(intval($user['id']), $user['name'], $user['mail'], intval($user['phone']), $user['hash']));
			}

			return $userList;
			
		}

		/**
		 * Returns an user by his ID
		 * @param  int $id ID of the user
		 * @return User     User that has the same ID from the request
		 */
		public function getById($id) {
			
			//Prepare the query: 
			$stmt = $this->connection->prepare($this->query['SELECT_USER_BY_ID']);
			//Bind params
			$stmt->bind_param("i", $id);
			//Execute: 
			$stmt->execute();
			//Bind result: 
			$stmt->bind_result($uid, $uname, $umail, $uphone, $uhash, $uisin, $status, $files, $shell, $config);
			//Fetch the result. If there are no results, return a null user
			if($stmt->fetch()) {
				$user = new User($uid, $uname, $umail, $uphone, $uhash, $uisin);
				$user->setPrivileges(new Privileges($status, $files, $shell, $config));	
				return $user;
			}

			return new User(null, null, null, null, null, null);			
		}

		/**
		 * Returns an user by his Name
		 * @param  string $name Name of the user
		 * @return User     User that has the same Name from the request       
		 */
		public function getByName($name) {
			//Prepare the query: 
			$stmt = $this->connection->prepare($this->query['SELECT_USER_BY_NAME']);
			//Bind params
			$stmt->bind_param("s", $name);
			//Execute: 
			$stmt->execute();
			//Bind result: 
			$stmt->bind_result($uid, $uname, $umail, $uphone, $uhash, $uisin, $status, $files, $shell, $config);
			//Fetch the result. If there are no results, return a null user
			if($stmt->fetch()) {
				$user = new User($uid, $uname, $umail, $uphone, $uhash, $uisin);
				$user->setPrivileges(new Privileges($status, $files, $shell, $config));	
				return $user;
			}

			return new User(null, null, null, null, null);	
		}

		/**
		 * Adds an user to the DDBB
		 * @param User   $user     User to add to the database
		 * @return User||array 	   Returns the inserted user or the array with the errors of MySQL
		 */	
		public function add(User $user) {

			//Prepare the query: 
			$stmt = $this->connection->prepare($this->query['ADD_USER']);
			//Bind params
			$stmt->bind_param("issis", $user->getId(), $user->getName(), $user->getMail(), $user->getPhone(), $user->getHash());
			//Execute: 
			if(!$stmt->execute())
				return $stmt->error_list;

			return $this->getById($user->getId());
		}

		/**
		 * Deletes an user from the DDBB
		 * @param  User   $user User to be deleted in the DDBB
		 * @return User       Returns the deleted user. If there aren't deleted users, returns a null user
		 */
		public function delete(User $user) {
			//Prepare the query: 
			$stmt = $this->connection->prepare($this->query['DELETE_USER']);
			//Bind params
			$stmt->bind_param("i", $user->getId());
			//Execute: 
			$stmt->execute();
			
			if($stmt->affected_rows == 0)
				return new User(null, null, null, null, null, null);	

			return $user;

		}

		/**
		 * Updates an specific user's information in the storage
		 * @param  User   $oldUser Old User to update
		 * @param  User   $newUser New User to update
		 * @return User 		   The User updated if the update it's successful. A null User, if the update isn't successful
		 */
		public function update(User $oldUser, User $newUser) {
			//Prepare the query: 
			$stmt = $this->connection->prepare($this->query['UPDATE_USER']);
			//Bind params
			$stmt->bind_param("ssisi", $newUser->getName(), $newUser->getMail(), $newUser->getPhone(), $newUser->getHash(), $oldUser->getId());
			//Execute: 
			$stmt->execute();
			
			if($stmt->affected_rows == 0)
				return new User(null, null, null, null, null, null);	

			return $newUser;
		}

		/**
		 * Sets if an user it's logged in
		 * @param User $user User to set
		 * @param bool $isin If it's in = true. If not = false
		 */
		public function setIn(User $user, $isin) {
			//Prepare the query: 
			$stmt = $this->connection->prepare($this->query['SET_ISIN']);
			//Bind params
			$stmt->bind_param("ii", $isin, $user->getId());
			//Execute: 
			$stmt->execute();
			
			if($stmt->affected_rows == 0)
				return new User(null, null, null, null, null);

			return $isin;
		}

		/**
		 * Check if the User is logged in
		 * @param  User   $user User to chech
		 * @return Boolean      True: The user it's logged in. False: The user isn't logged in.
		 */
		public function isin(User $user) {
			//Prepare the query: 
			$stmt = $this->connection->prepare($this->query['GET_ISIN']);
			//Bind params
			$stmt->bind_param("i", $user->getId());
			//Execute: 
			$stmt->execute();
			//Bind result: 
			$stmt->bind_result($uisin);
			//Fetch the result. If there are no results, return a null user
			if($stmt->fetch())
				return $uisin;

			return new User(null, null, null, null, null);	
		}
	}




?>