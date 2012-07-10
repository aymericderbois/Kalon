<?php

/**
 * Servira plus tard pour la gestion du cache ;)
 */
class Driver extends Object {

	private $config = array();

	public function __construct($config = array()) {
		$this->config = $config;
	}

}