<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * Category view
 */
class VombieMusicViewCategories extends JView
{


      function display($tpl = null) 
      {
            $this->items    = $this->get( 'Data');
            $this->assignRef('item', $items);
                                           						
            // Check for errors.
            if (count($errors = $this->get('Errors'))) 
            {
                  JError::raiseError(500, implode('<br />', $errors));
                  return false;
            }
            $document = & JFactory::getDocument();
            $document->addStyleSheet(JURI::base().'components/com_vombiemusic/assets/css/vombiemusic.css');
            // Display the view
            parent::display($tpl);
        }
}