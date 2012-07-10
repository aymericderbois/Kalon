<?php

class MysqlDriver extends Driver{

	/**
	 * Start quote
	 *
	 * @var string
	 */
	var $startQuote = "`";
	
	/**
	 * End quote
	 *
	 * @var string
	 */
	public $endQuote = "`";

	public function connect($host, $user, $password, $db){
		if(!mysql_connect($host, $user, $password, $db)) {
			die('Impossible de se connecter à la base de donnée' . mysql_error());
		}
		if(!mysql_select_db($db)){
			die('Impossible de sélectionner la base de ' . $db . ' ' . mysql_error());
		}

	}

	public function query($query){
		return mysql_query($query);
	}

	/**
	 * Récupère les colonnes d'une table dans un tableau.
	 */
	public function showColumns($tableName){
		$req = $this->query('SHOW FULL COLUMNS FROM ' . $tableName);
		$columns = array();
		while($cols = mysql_fetch_assoc($req)){
			array_push($columns, $cols);
		}
	}
}