<?php
	
	/**
	 * Class to manage the HDD
	 */
	class HDD {

		/**
		 * Base Dir of the HDD
		 */
		private $dir;

		/**
		 * Default constructow
		 * @param string $dir Base directory of the HDD
		 */
		public function __construct($dir = "/") {
			$this->dir = $dir;
		}

		/**
		 * Converts Bytes to MegaBytes for human readability
		 * @param  int $bytes  	Bytes to convert
		 * @return int        	Bytes converted to MegaBytes
		 */
		public function humanSize($bytes) {
			$bytes /= 1024000;
			return($bytes);
		}

		/**
		 * Returns the free space of the disk
		 * @return int Free space of the disk
		 */
		function getFree() {
			$free = disk_free_space($this->dir);
			return $free;
		}

		/**
		 * Returns the total space of the disk
		 * @return int Total Space of the disk
		 */
		function getTotal() {
			$total = disk_total_space($this->dir);
			return $total;
		}

		/**
		 * Returns the used space of the disk
		 * @return int Used space of the disk
		 */
		function getUsed() {
			$used = $this->getTotal() - $this->getFree();
			return $used;
		}

		/**
		 * Executes all the functions and returns a Array with the data
		 * @return Json 	Json encoded data
		 */	
		function toArray() {
			return array('free' => $this->getfree(), 'total' => $this->getTotal(), 'used' => $this->getUsed());
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