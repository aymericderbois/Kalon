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
class Controller extends Object {

	/**
	 * Contient l'ensemble des valeurs que l'ont souhaite envoyer à la vue
	 * 
	 * @var array
	 */
	public $vars = array();

	/**
	 * Liste des models à charger
	 * @var array 
	 */
	public $uses = false;

	/**
	 * Liste des helpers à charger
	 * @var array
	 */
	public $helpers = array();

	/**
	 * Permet de savoir si la fonction render à déjà été appellé (dans l'action par exemple);
	 *
	 * @var bool
	 */
	private $isRendered = false;
	public $controllerName = '';
	public $actionName = '';
	public $title = '';
	public $layout = 'Default';

	public function __construct() {
		
	}

	public function load($controller, $action, $params) {
		$this->controllerName = $controller;
		$this->actionName = $action;
		$this->loadModels();
		require_once(KALON . 'Core/View/View.php');
		call_user_func_array(array($this, $action), $params);
		$this->render($action);
	}

	/**
	 * Permet de charger un model en fonction de son nom.
	 * 
	 * @param string $modelClass
	 */
	public function loadModel($modelClass) {
		if (file_exists(APP . 'Models' . DS . $modelClass . '.php')) {
			require APP . 'Models' . DS . $modelClass . '.php';
			$this->{ucfirst($modelClass)} = new $modelClass();
		} else {
			$class = 'class ' . $modelClass . ' extends AppModel { }';
			eval($class);
			$this->{ucfirst($modelClass)} = new $modelClass();
		}
	}

	/**
	 * Cette fonction permet d'instancier l'ensemble des models qui sont dans la variable $this->uses.
	 * Si $this->uses == false alors on charge le model par défault
	 * Si $this->uses == array() on ne charge aucun model, même pas app_model !
	 * Sinon on charge les models contenu dans le array.
	 */
	public function loadModels() {
		if (is_bool($this->uses) || (is_array($this->uses) && sizeof($this->uses) > 0)) {
			// On va charger le app_model de l'application si il existe. Sinon on charge le app_model du core.
			// On charge l'ensemble des models de la liste
			require_once(KALON . 'Core' . DS . 'Model' . DS . 'Model.php');
			if (file_exists(APP . 'AppModel.php')) {
				require_once(APP . 'AppModel.php');
			} else {
				require_once(KALON . 'Core' . DS . 'Model' . DS . 'AppModel.php');
			}
			if ($this->uses === false) {
				// Il n'y a pas de model choisis, on en prends celui par défault
				// On met le mot au singulier (en supprimant le "s")
				$modelName = substr($this->controllerName, 0, strlen($this->controllerName) - 1);
				$this->loadModel($modelName);
			} else {
				foreach ($this->uses as $v) {
					$modelName = substr($v, 0, strlen($v) - 1);
					$this->loadModel($modelName);
				}
			}
		}
	}

	/**
	 * Permet d'envoyer une variable à la vue.
	 * 
	 * @param string $var
	 * @param type $value 
	 */
	public function set($var, $value) {
		$this->vars[$name] = $var;
	}

	/**
	 * Cette fonction appelle la vue et lui passe l'ensemble des infos
	 * nécessaires.
	 * 
	 * 1- On charge les variables à envoyer à la vue
	 * 
	 * @param string $filename 
	 */
	public function render($filename) {
		if (!$this->isRendered) {
			$this->isRendered = true;

			$this->beforeRender();

			$View = new View($this);
			$View->render($filename);

			$this->afterRender();
		}
	}

	public function redirect($url, $statut = 404) {
		
	}

	public function beforeRender() {
		
	}

	public function afterRender() {
		
	}

}