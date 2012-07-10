<?php

/**
 *  ##  ##   #####   ###   ##   ##       ##      ####     ####  ###   ##    
 *  ## ##    ##      ## ## ##   ##     ##  ##    ##  ##    ##   ## ## ##    
 *  ####     #####   ##  ####   ##    ##    ##   ##   ##   ##   ##  ####    
 *  ## ##    ##      ##   ###   ##     ##  ##    ## ##     ##   ##   ###    
 *  ##  ##   #####   ##    ##   #####    ##      ###      ####  ##    ##    
 *  
 * @author : DERBOIS Aymeric
 * @version : 0.01
 * @since : 0.01
 * 
 * @copyright DERBOIS Aymeric
 * @license MIT License                                                
 */

ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);

define('DS', DIRECTORY_SEPARATOR);
define('APP', 'App' . DS);
define('CORE', '..' . DS);
define('KALON', 'Kalon' . DS);
define('ROOT', dirname(__FILE__) . DS);
define('WEBROOT', 'Webroot' . DS);

require('Kalon/Basics.php');
require('Kalon/Core/Object.php');

require('Kalon/Core/Configure.php');
require(APP . DS . 'Config/Core.php');

require_once('Kalon/Libs/Dispatcher.php');
require_once('Kalon/Libs/Router.php');

require_once(APP . 'Config/Routes.php');

// Fix en attendant un routing correct
$_GET['p'] = array_key_exists('p', $_GET) && !empty ($_GET['p']) ? $_GET['p'] : '/pages/index/';

$Dispatcher = new Dispatcher();
$Dispatcher->dispatch(isset($_GET['p']) ? $_GET['p'] : null);


if (Configure::read('debug') == 2)
  echo round((xdebug_time_index() * 1000), 2);
