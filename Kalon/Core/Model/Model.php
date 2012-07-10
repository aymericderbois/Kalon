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
class Model extends Object
{

	/**
	 * 
	 * @var object
	 */
	private $dbDriver = null;
	/**
	 * Tableau contenant les valeurs à valider
	 * @var array
	 */
	private $toValidate = array();
	/**
	 * Règle de validation des données
	 * @var array
	 */
	public  $validate = array();
	/**
	 * Name of the model
	 * @var string
	 */
	public  $name = '';
	/**
	 * Nom de la table
	 * @var string 
	 */
	protected $table = '';
	protected $prefix = '';
	
  public function __construct()
	{
		require_once('Drivers/Driver.php');

		$this->name = empty($this->name) ? get_class($this) : $this->name;
		$this->table = empty($this->table) ? get_class($this) . 's' : $this->table;
	}

	public function test()
	{
		require_once('Drivers/MysqlDriver.php');
		$this->dbDriver = new MysqlDriver();
		$this->dbDriver->connect('localhost', 'root', 'root', 'myrank');
		$this->dbDriver->showColumns('users');
	}

	/**
	 * Parcours le tableau $validate et vérifie que les conditions sont bien 
	 * respectées.
	 * 
	 * Les messages d'erreurs sont mis dans la variable de classe ayant le nom
	 * suivant : $name.'ValidateError' accessible via la fonction getValidateErrors
	 * 
	 * TODO: Gérer les regexps !
	 * 
	 * @param array $values
	 * @param string $name 
	 * @return bool : True si pas d'erreur, false sinon
	 */
	public function validate($values, $name = null)
	{
		require_once('Validation.php');
		$Validation = Validation::getInstance();
		$this->toValidate = $values;
		$_name = is_null($name) ? $this->name : $name;
		$error = $_name . 'ValidateErrors';
		$this->{$error} = array();
		// Parcours des différents champs ayant des règles
		// $name = le nom du champs, $rules le tableau contenant les règles
		foreach($this->validate[$_name] as $_name => $rules){
			if(isset($values[$_name])){
				// Le champs à été envoyer, on va vérifier qu'il suit correctement
				// les règles établies
				foreach($rules as $key => $rule){
					// Il y a deux index : 
					//  - rule : la fonction à appeller
					//  - message : Le message d'erreur à sauvegarder
					$_args = is_array($rule['rule']) ? $rule['rule'] : array($rule['rule']);
					// $_args[0] = nom de la fonction de validation à appeller
					// On insère dans args[0] le contenu du champs
					// Le dernier paramètre est le nom du champs ('username' par exemple)
					$_validationMethod = $_args[0];
					$_args[0] = $values[$_name];
					$_args[] = $_name;
					if(!call_user_func_array(array($Validation, $_validationMethod), $_args)){
						$this->{$error}[$_name] = $rule['message'];
						break;
					}
				}
			} else{
				// TODO: Chercher le champs 'required' et tester sa valeur
			}
		}
		return(empty($this->{$error}));
	}

	/**
	 * Retourne le tableau des erreurs
	 * 
	 * @param string $name
	 * @return array 
	 */
	public function displayFieldsErrors($name = null)
	{
		$_name = is_null($name) ? $this->name : $name;
		$_name = $_name . 'ValidateErrors';
		$_errorArray = isset($this->{$_name}) ? $this->{$_name} : array();
		return $_errorArray;
	}

}