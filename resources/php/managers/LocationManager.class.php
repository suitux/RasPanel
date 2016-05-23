<?php

	/**
	 * Class to move the user thought the locations of the RasPanel
	 */
	class LocationManager {

		/**
		 * BasePath of the server
		 * @var string
		 */
		protected static $basePath = "../../../";

		const ROOT	= '';
		const PANEL = 'panel.html.php';

		/**
		 * Redirects to a specific URL
		 * @param  String $path Path to go
		 */
		public static function redirectTo($path) {
			header("Location: " . self::$basePath . $path);
		}

		/**
		 * Redirects to an url
		 * @param  string $url Url to redirect
		 */
		public static function redirectToURL($url) {
			header("Location: " . $url);
		}


	}


?>