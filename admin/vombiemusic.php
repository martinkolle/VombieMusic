<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

//Load ths submenus
JLoader::register('VombieMusicHelper', dirname(__FILE__) . DS . 'helpers' . DS . 'vombiemusic.php');
 
// import joomla controller library
jimport('joomla.application.component.controller');

$controller = JController::getInstance('VombieMusic');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();