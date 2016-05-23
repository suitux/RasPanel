<?php

	/**
	 * Class to load the WebParts of the RasPanel
	 */
	class WebPartManager {

		/**
		 * Left bar
		 */
		const LEFT_BAR_COMPONENT 	= 'resources/webparts/components/left_bar.part.html';

		/**
		 * Home WebPart
		 */
		const HOME_PART				= 'resources/webparts/parts/home.html.php';

		/**
		 * Status WebPart
		 */
		const STATUS_PART			= 'resources/webparts/parts/status.html.php';

		/**
		 * No permission WebPart
		 */
		const NO_PERMISSION_PART 	= 'resources/webparts/parts/nopermission.html.php';

		/**
		 * Default empty constructor
		 */
		public function __construct() {}


		/**
		 * Loads a file into another
		 * @param  String $filetoload File to load
		 */
		public static function load($filetoload) {
			include_once($filetoload);
		}
	}


?>