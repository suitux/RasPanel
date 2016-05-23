<?php 

	include_once(dirname(__FILE__) . '/Processor.class.php');
	include_once(dirname(__FILE__) . '/RAM.class.php');
	include_once(dirname(__FILE__) . '/HDD.class.php');
	include_once(dirname(__FILE__) . '/../managers/Authentification.class.php');
	include_once(dirname(__FILE__) . '/../managers/LocationManager.class.php');

	/**
	 * Manages the System.
	 * Includes: 
	 * 	- Processor
	 * 	- RAM
	 * 	- HDD
	 * 	- Network
	 */
	class System {

		/**
		 * Processor of the System
		 * @var Processor
		 */
		private $processor;

		/**
		 * RAM of the System
		 * @var RAM
		 */
		private $ram;

		/**
		 * HDD of the System
		 * @var HDD
		 */
		private $hdd;

		function __construct() {
			$this->processor = new Processor();
			$this->ram = new RAM();
			$this->hdd = new HDD();
		}

		/**
		 * Returns the Processor to manage it
		 * @return Processor Processor of the system
		 */
		public function getProcessor() {
			return $this->processor;
		}

		/**
		 * Returns the Ram to manage it
		 * @return RAM RAM of the System
		 */
		public function getRAM() {
			return $this->ram;
		}

		/**
		 * Returns the HDD to manage it
		 * @return HDD HDD of the system
		 */
		public function getHDD() {
			return $this->hdd;
		}

		/**
		 * Returns the actual temperature of the system
		 * @return int Actual temperature of the system
		 */
		function getTemp() {
			$temp = exec("cat /sys/class/thermal/thermal_zone0/temp");
			$temp /= 1000;
			$temp = round($temp, 0);
			return $temp;
		}
	}


	/*---- WebService by GET ----*/

	//If info it's set: 
	if(isset($_GET['info'])) {

		$auth 	= new Authentification();	//Authentification manager
		$um		= new UserManager();		//User permission manager

		if($auth->isLoggedIn() && $privileged = $um->getById($_SESSION['id'])->getPrivileges()->getStatus()) {	//If the user it's logged in and have perms

			//Creating new System..
			$sys = new System();

			switch ($_GET['info']) {
				case 'system': 				//All Information
					$toReturn = 
						array('processor' 	=> $sys->getProcessor()->toArray(), 
								'ram' 		=> $sys->getRAM()->toArray(), 
								'hdd' 		=> $sys->getHDD()->toArray(), 
								'temp' 		=> $sys->getTemp());
					break;
				case 'hdd': 				//HDD Information
					$toReturn = $sys->getHDD()->toArray();
					break;
				case 'ram':					//RAM Information
					$toReturn = $sys->getRAM()->toArray();
					break;		
				case 'processor': 			//CPU Information
					$toReturn = $sys->getProcessor()->toArray();
					break;
				case 'temp': 				//Temperature Information
					$toReturn = $sys->getTemp();
					break;
				default: 					//All information
					$toReturn = array('error' => 'No data requested.');
					break;
			}
			echo json_encode($toReturn);
		} else 
			LocationManager::redirectTo(LocationManager::ROOT);	//Redirect to root
	} 


?>