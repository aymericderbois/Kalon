<?php

class Validation extends Object {

	function getInstance() {
		static $instance = array();

		if (!$instance) {
			$instance = new Validation();
		}
		return $instance;
	}

	/**
	 * 
	 * @param string $value
	 * @param int $min
	 * @param int $max
	 * @return bool 
	 */
	function between($value, $min, $max) {
		$_len = mb_strlen($value);
		return ($_len >= $min && $_len <= $max);
	}

}