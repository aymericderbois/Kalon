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

class Router extends Dispatcher
{

	private static $instance;
	private $routes = array();

	function __construct()
	{
		
	}

	function __clone()
	{
		
	}

	private static function getInstance()
	{
		if (!(self::$instance instanceof self)) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Permet d'ajouter une route
	 * 
	 * @param string $url
	 * @param string $destination 
	 */
	public static function connect($url, $destination, $params)
	{
		$Router = self::getInstance();
		$tmp = array(
			'url' => $url,
			'destination' => $destination,
			'params' => $params
		);
		array_push($Router->routes, $tmp);
	}

	/**
	 *
	 * @param string $url 
	 */
	public static function parse($url)
	{
		$Router = self::getInstance();
		$_url = $Router->cleanUrl($url);
		$_explodeUrl = explode('/', $_url);
		debug($_explodeUrl);
		debug($Router->routes);
		return $_url;
	}
}
