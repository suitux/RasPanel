<?php

	/**
	 * Manages the processor
	 */
	class Processor {

		function __construct() {

		}

		/**
		 * Return a table with the processes actives
		 * @param  integer $numberOfProcesses 	Max processes to return
		 * @return Array      					Array with a table. The table contains the headers.             
		 */
		function getTableOfProcesses($numberOfProcesses = 5) {
			$display = array();
			$exec = shell_exec('ps aux --sort=-pcpu | head -' . $numberOfProcesses);
			$output = preg_split('/[\r\n]+/', $exec);
			
			for($i = 0; $i != $numberOfProcesses; $i++)
				$display[$i] = preg_split('/[\s,]+/', $output[$i]);

			return $display;
		}

		/**
		 * Returns a percentage of the CPU usage
		 * @return int Percentage of the CPU usage
		 */
		function getUsage() {
			exec('ps -aux', $processes);
			$cpuUsage = 0;
			foreach($processes as $process) {
				$cols = split(' ', ereg_replace(' +', ' ', $process));
				if (strpos($cols[2], '.') > -1)
					$cpuUsage += floatval($cols[2]);
			}

			return $cpuUsage;
		}

		/**
		 * Executes all the functions and returns a Array with the data
		 * @return Json 	Json encoded data
		 */	
		function toArray() {
			return array('processes' => $this->getTableOfProcesses(), 'usage' => $this->getUsage());
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