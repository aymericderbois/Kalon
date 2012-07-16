<?php

/**
 * La classe connectionManager est un singleton
 * Elle sert à contenir la connexion à la base de données.
 */
class ConnectionManager extends Object
{

	private static $instance_ = null;
	public $config = null;

	/**
	 * All instance
	 * 
	 * @var array 
	 */
	public $dataSources = array();

	private function __construct(){}

	public static function getInstance()
	{
		if (is_null(self::$instance_)) {
			self::$instance_ = new Singleton();
		}
		return self::$instance_;
	}

	/**
	 * Initialisation
	 */
	public function init()
	{
		$_dbFile = APP . 'Config' . DS . 'Database.php';
		if (file_exists($_dbFile)) {
			require_once($_dbFile);
			if (class_exists('DBConfig')) {
				$this->config = new DBConfig(); 
				// Fixme charger le driver BDD
			} else {
				die('DBConfig class doesn\'t exist in ' . $_dbFile);
			}
		} else {
			die($_dbFile . ' doesn\'t exist');
		}
	}

}