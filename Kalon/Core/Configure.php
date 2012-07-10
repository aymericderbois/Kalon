<?php

class Configure extends Object {

	static $data = array();

	/**
	 * Enregistre une donnee dans le tableau static $data
	 * @param string $name La key d'emregistrement
	 * @param mixed $value La valeur a enregistrer
	 */
	public static function write($name, $value) {
		self::$data[$name] = $value;
	}

	/**
	 * Recupere une valeur de configuration
	 * @param string $name La key d'enregistrement
	 * @return string
	 */
	public static function read($name) {
		if (array_key_exists($name, self::$data)) {
			return (self::$data[$name]);
		}
		return (null);
	}

}