<?php 

	/**
	 * Manages the RAM
	 */
	class RAM {

		function __construct() {

		}

		/**
		 * Gets the Total RAM in MB
		 * @return Int The total RAM of the system
		 */
		function getTotal() {
			foreach(file('/proc/meminfo') as $ri)
				$m[strtok($ri, ':')] = strtok('');

			return round($m['MemTotal'] / 1024);
		}

		/**
		 * Gets the Free RAM in MB
		 * @return Int The free RAM of the system
		 */
		function getFree() {
			foreach(file('/proc/meminfo') as $ri)
				$m[strtok($ri, ':')] = strtok('');

			return round($m['MemFree'] / 1024);
		}

		/**
		 * Gets the Buffered RAM in MB
		 * @return Int The buffered RAM of the system
		 */
		function getInBuffer() {
			foreach(file('/proc/meminfo') as $ri)
				$m[strtok($ri, ':')] = strtok('');

			return round($m['Buffers'] / 1024);
		}

		/**
		 * Gets the Catched RAM in MB
		 * @return Int The catched RAM of the system
		 */
		function getCatched() {
			foreach(file('/proc/meminfo') as $ri)
				$m[strtok($ri, ':')] = strtok('');

			return round($m['Cached'] / 1024);
		}

		/**
		 * Liberates RAM of the System
		 * (Requires ROOT perms)
		 */
		function flush() {
			exec("sudo sync; echo 3 > /proc/sys/vm/drop_caches");
		}

		/**
		 * Executes all the functions and returns a Array with the data
		 * @return Json 	Json encoded data
		 */	
		function toArray() {
			foreach(file('/proc/meminfo') as $ri)
				$m[strtok($ri, ':')] = strtok('');

			$toreturn = array('total' => round($m['MemTotal'] / 1024), 'free' => round($m['MemFree'] / 1024), 'buffer' => round($m['Buffers'] / 1024), 'cached' => round($m['Cached'] / 1024));
			
			return $toreturn;
		}

		/**
		 * Executes all the functions and returns a Json with the data
		 * @return Json 	Json encoded data
		 */	
		function toJson() {
			return json_encode($this->toArray());
		}
	}
?>