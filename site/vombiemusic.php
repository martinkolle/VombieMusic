<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import joomla controller library
jimport('joomla.application.component.controller');
$controller = JController::getInstance('VombieMusic');

//Load the database
JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_vombiemusic'.DS.'tables');
JLoader::register('VombieMusicHelper', dirname(__FILE__) . DS . 'helpers' . DS . 'vombiemusic.php');

// Perform the Request task
$controller->execute(JRequest::getCmd('task'));
 
// Redirect if set by the controller
$controller->redirect();