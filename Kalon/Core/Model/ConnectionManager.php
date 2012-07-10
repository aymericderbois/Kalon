<?php

class ConnectionManager extends Object {

	public $config = null;
	/**
	 * All instance
	 * 
	 * @var array 
	 */
	public  $dataSources = array();

	public function __construct() {
		$_dbFile = APP . 'Config/Database.php';
		if (file_exists($_dbFile)) {
			require_once($_dbFile);
			if (class_exists('DBConfig')) {
				$this->config = new DBConfig();
			}
			else {
				die('DBConfig class doesn\'t exist in '.$_dbFile);
			}
		}
		else {
			die($_dbFile . ' doesn\'t exist');
		}
	}



}