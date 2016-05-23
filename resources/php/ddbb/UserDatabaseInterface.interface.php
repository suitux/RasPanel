<?php

	include_once(dirname(__FILE__) . '/../entities/User.class.php');

	/**
	 * Interface with generic user get and add functions
	 */
	interface UserDatabaseInterface {

		/**
		 * Returns an arraylist of all the users of the storage
		 * @return ArrayList of users
		 */
		public function getAll();

		/**
		 * Returns an user by his ID
		 * @param  int $id ID of the user
		 * @return User     User that has the same ID from the request
		 */
		public function getById($id);

		/**
		 * Returns an user by his Name
		 * @param  string $name Name of the user
		 * @return User     User that has the same Name from the request       
		 */
		public function getByName($name);

		/**
		 * Adds an user to the storage
		 * @param User   $user     User to add to the database
		 * @return User||array 	   Returns the inserted users or the array with the errors of MySQL
		 */	
		public function add(User $user);

		/**
		 * Deletes an user from the storage
		 * @param  User   $user User to be deleted in the storage
		 * @return User       Returns the deleted user. If there aren't deleted users, returns a null user
		 */
		public function delete(User $user);

		/**
		 * Updates an specific user's information in the storage
		 * @param  User   $oldUser Old User to update
		 * @param  User   $newUser New User to update
		 * @return User 		   The User updated if the update it's successful. A null User, if the update isn't successful
		 */
		public function update(User $oldUser, User $newUser);

		/**
		 * Sets if an user it's logged in
		 * @param User $user User to set
		 * @param bool $isin If it's in = true. If not = false
		 */
		public function setIn(User $user, $isin);

		/**
		 * Check if the User is logged in
		 * @param  User   $user User to chech
		 * @return Boolean      True: The user it's logged in. False: The user isn't logged in.
		 */
		public function isin(User $user);

	}

?>