<?php

	/**
	 * Privileges class to manage privileges of an user
	 */
	class Privileges {

		/**
		 * Access to the status panel
		 * @var boolean
		 */
		private $status;

		/**
		 * Access to the files of the user
		 * @var boolean
		 */
		private $files;

		/**
		 * Access to a shell
		 * @var boolean
		 */
		private $shell;

		/**
		 * Access to the configuration of the panel
		 * @var boolean
		 */
		private $config;

		/**
		 * Default constructor with all params
		 * @param boolean
		 * @param boolean
		 * @param boolean
		 * @param boolean
		 * @param boolean
		 */
		public function __construct($status, $files, $shell, $config) {
			$this->status 	= $status;
			$this->files 	= $files;
			$this->shell 	= $shell;
			$this->config 	= $config;
		}

		public function getStatus(){
			return $this->status;
		}
		public function setStatus($status){
			$this->status = $status;
		}

		public function getFiles(){
			return $this->files;
		}
		public function setFiles($files){
			$this->files = $files;
		}

		public function getShell(){
			return $this->shell;
		}
		public function setShell($shell){
			$this->shell = $shell;
		}

		public function getConfig(){
			return $this->config;
		}
		public function setConfig($config){
			$this->config = $config;
		}

		public function __toString() {
			return "Privileges: {" . 	"Status: "	. $this->status .
										", Files: "	. $this->files  .
										", Shell: "	. $this->shell	.
										", Config: ". $this->config . "}";
		}
	}
?>