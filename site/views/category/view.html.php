<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
class VombieMusicViewCategory extends JView
{

        function display($tpl = null) 
        {
                // Get data from the model
                $this->items = $this->get('Songs');
 
                //Load the popup and mootools
                JHTML::_('behavior.mootools');
                //load settings
                $app      = JFactory::getApplication();
                $settings = $app->getParams(); 
                $this->assignRef('setting',$settings);
                
                //Add stylesheets
                $document = & JFactory::getDocument();
                $document->addStyleSheet(JURI::base().'components/com_vombiemusic/assets/css/vombiemusic.css');
                $document->addStyleDeclaration('#sbox-window{background:black; /*will overwrite the default css style*/}');

                //get the category description and params
                $db     = JFactory::getDBO();                     
                $query  = $db->getQuery(true);
                $id     = JRequest::getInt('id');
                
                //let us load the informations from the son db
                $query->select('a.*');
                $query->from('#__categories AS a');

                $query->where('a.id = "'.(int) $id.'"');
                
                $db->setQuery( $query );
                $this->category = $db->loadAssoc();

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