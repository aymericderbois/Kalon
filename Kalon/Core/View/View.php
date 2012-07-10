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
class View {

  private $controller = null;

  public function __construct($controller) {
    $this->controller = $controller;
  }

  public function render($filename) {
    // Récupération des variables envoyées à la vues
    foreach ($this->controller->vars as $k => $v) {
      $this->{$k} = $v;
    }
    // On charge les helpers
    $this->loadHelpers();

    $script_for_layout = '';
    $title_for_layout = $this->controller->title;

    $viewFile = APP . 'Views/' . $this->controller->controllerName . '/' . ucfirst($this->controller->actionName) . '.ctp';
    if (file_exists($viewFile)) {
      ob_start();
      require($viewFile);
      $content_for_layout = ob_get_clean();
      if ($this->controller->layout == null) {
        echo $content_for_layout;
      }
      else {
        $layoutFile = APP . 'Views/Layouts/' . $this->controller->layout . '.ctp';
        if (file_exists($layoutFile)) {
          require($layoutFile);
        }
        else {
          die('The layout : ' . $layoutFile . ' doesn\'t exist ! ');
        }
      }
    }
    else {
      die('The view : ' . $viewFile . ' doesn\'t exist !');
    }
  }

  /**
   * Charge les helpers qui sont dans la variable $this->controller->helpers.
   * Par défault on recherche d'abord les helpers de l'APP et ensuite ceux du core. Cela permet
   * de réécrire les helpers du core.
   */
  public function loadHelpers() {
    $result = array();
    foreach ($this->controller->helpers as $helper) {
      if (file_exists(APP . 'Views/Helpers/' . $helper . 'Helper.php')) {
        require(APP . 'Views/Helpers/' . $helper . 'Helper.php');
        $helperClassName = $helper . 'Helper';
        $this->{$helper} = new $helperClassName();
      }
      else if (file_exists(KALON . 'Core/View/Helpers/' . $helper . 'Helper.php')) {
        require(KALON . 'Core/View/Helpers/' . $helper . 'Helper.php');
        $helperClassName = $helper . 'Helper';
        $this->{$helper} = new $helperClassName();
      }
      else {
        die('Aucun helper ' . $helper . ' trouvé !');
      }
    }
  }

  /**
   * @param string $name 
   */
  public function element($name, $vars = array()) {
    $filename = $this->controller->app . 'Elements/' . $name . '.php';
    if (file_exists($filename)) {
      // On load les récupère les helpers
      foreach ($this->instanceHelpers as $key => $value) {
        $$key = $value;
      }
      // On récupère les variables à envoyer.
      foreach ($vars as $k => $v) {
        $$k = $v;
      }
      require_once $filename;
    }
    else {
      die('The element : ' . $filename . ' doesn\'t exist!');
    }
  }

}