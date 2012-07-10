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
 * 
 * Ce fichier contient un ensemble de configuration de Kalon                                            
 */

/**
 * Est a 0 si le mode rewrite n'est pas active, 1 sinon
 */
Configure::write('mod_rewrite', 0);

/**
 * Niveau d'affichage du debug
 * Le niveau "n" contient aussi les infos de "n - 1"
 *  - 0 : Pas d'affichage
 *  - 1 : Encore non defini
 *  - 2 : Affiche le temps de chargement de la page 
   */
Configure::write('debug', 0);