<?php

/**
 *  ##  ##   #####   ###   ##   ##       ##      ####     ####  ###   ##
 *  ## ##    ##      ## ## ##   ##     ##  ##    ##  ##    ##   ## ## ##
 *  ####     #####   ##  ####   ##    ##    ##   ##   ##   ##   ##  ####
 *  ## ##    ##      ##   ###   ##     ##  ##    ## ##     ##   ##   ###
 *  ##  ##   #####   ##    ##   #####    ##      ###      ####  ##    ##
 *
 * @author : DERBOIS Aymeric
 * @since : 0.01
 *
 * @copyright DERBOIS Aymeric
 * @license MIT License
 */
class Dispatcher {

	/**
	 * Constructor
	 */
	function __construct() {
		
	}

	/**
	 * 
	 */
	function dispatch($url) {
		/**
		 * It is a basic routing
		 * We clean the url and after we get some information include on the url
		 */
		$_url = $this->cleanUrl($url);
		$_explodeUrl = explode('/', $_url);

		$controller = ucfirst($_explodeUrl[0]);
		$action = $_explodeUrl[1];
		
		/**
		 * We load the Controller class
		 */
		if (file_exists(KALON . 'Core' . DS . 'Controller' . DS . 'Controller.php')) {
			require_once(KALON . 'Core' . DS . 'Controller' . DS . 'Controller.php');
		} else {
			exit('Critical error : Controller.php not found on Kalon core');
		}

		/**
		 * We load the AppController. It is on Controller folder
		 */
		if (file_exists(APP . 'Controllers' . DS . 'AppController.php')) {
			require_once(APP . 'Controllers' . DS . 'AppController.php');
		} else {
			exit('Critical error : AppController must be on Controllers folder');
		}

		/**
		 * We load the controller needed
		 * Before loading the class we verify that the action exist
		 */
		$controllerFile = APP . 'Controllers' . DS . $controller . 'Controller.php';
		if (file_exists($controllerFile)) {
			require_once($controllerFile);
			$controllerClassName = $controller . 'Controller';
			$Controller = new $controllerClassName();
			if (method_exists($Controller, $action)) {
				$Controller->load($controller, $action, array());
			} else {
				die('Method ' . $action . ' not found in ' . $controllerFile);
			}
		} else {
			die('Critical error :' . $controllerFile . ' not found !');
		}
	}

	/**
	 * Supprime les éléments génant de l'url
	 * 	1 - Supprime les caractères pourris en début et fin de chaines
	 * 	2 - Passe l'ensemble de la chaine en minuscule
	 * 	3 - Supprime le / en fin de chaine
	 *  4 - Supprime le / en debut de chaine
	 * @param string $url 
	 */
	public function cleanUrl($url) {
		$_url = strtolower(trim($url));
		$_url = substr($_url, -1) == '/' ? substr($_url, 0, -1) : $_url;
		$_url = $_url[0] == '/' ? substr($_url, 1, strlen($_url)) : $_url;
		return $_url;
	}

}