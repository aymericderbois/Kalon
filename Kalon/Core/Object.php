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

class Object {

	function toString() {
		$class = get_class($this);
		return $class;
	}

}