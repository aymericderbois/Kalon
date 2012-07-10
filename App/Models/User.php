<?php

class User extends AppModel {

	var $validate = array(
			'User' => array(
					'username' => array(
							'between' => array(
									'rule' => array('between', 2, 10),
									'message' => 'Le username doit être entre 2 et 10 caractères'
							)
					)
			)
	);

	function __construct() {
		parent::__construct();
		$this->testValidate();
	}

	function testValidate() {
		$toTest = array('username' => 'c');
		$this->validate($toTest);
	}

}