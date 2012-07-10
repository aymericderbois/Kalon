<?php

class HtmlHelper extends Object {
  
  /**
   * Retourne une image correctement formatee prenant en compte si le mode
   * rewrite est active.
   * @param type $name Le nom de l'image (plus le dossier si necessaire)
   * @param array $options Tableau de parametre d'une image
   * @return string La balise image correctement formatee
   */
  public function image($name, array $options = array()) {
    $url = '';
    if (!Configure::read('mod_rewrite'))
      $url = WEBROOT;
    $url .= 'images' . DS . $name;
    $image = '<img src="'.$url.'"';
    foreach ($options as $key => $value) {
      $image .= ' ' . $key . ' = "' . $value . '"';
    }
    $image .= ' />';
    
    return ($image);
  }
}