<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/*
	This will import the details from the database and do the work!
*/
class VombieMusicViewSongs extends JView
{
	/**
	 * Vombiemusic view display method
	 * @return void
	 */

	 public $setting;
	function display($tpl = null) 
	{
		// Get data from the model
		$this->items = $this->get('Items');
 
 		//Load the popup and mootools
 		JHTML::_('behavior.mootools');
  		//load settings
  		$app 				= JFactory::getApplication();
		$settings 			= $app->getParams(); 
		$this->assignRef('setting',$settings);
   		
		//Add stylesheets
		$document = & JFactory::getDocument();
		$document->addStyleSheet(JURI::base().'components/com_vombiemusic/assets/css/vombiemusic.css');
 		$document->addStyleDeclaration('#sbox-window{background:black; /*will overwrite the default css style*/}');

 		// Check for errors.
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		} 
		// Display the template
		parent::display($tpl);
	}

}