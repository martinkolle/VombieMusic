<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
class VombieMusicViewPlaylists extends JView
{
        /**
         * Vombiemusic view display method
         * @return void
         */
        function display($tpl = null) 
        {
                // Get data from the model
                $this->items    = $this->get('Items');
                $app            = JFactory::getApplication();
                $settings       = $app->getParams(); 
                $menus          = &JSite::getMenu();
                $menu           = $menus->getActive(); 
                $document       = & JFactory::getDocument();
                $header         = $settings->get('page_title', $menu->title); 
                $this->assignRef('header',$header);
                $this->assignRef('setting',$settings);

 
                
                //Add stylesheets
                $document->addStyleSheet(JURI::base().'components/com_vombiemusic/assets/css/vombiemusic.css');

                $title_spacer = " - ";

                if ($menu)
                {
                        $settings->def('page_heading', $settings->get('page_title', $menu->title));
                } else {
                        $settings->def('page_heading', JText::_('JGLOBAL_ARTICLES'));
                }
                $title = $settings->get('page_title', '');

                $document->setTitle($title);

                if ($settings->get('menu-meta_description'))
                {
                        $document->setDescription($settings->get('menu-meta_description'));
                }

                if ($settings->get('menu-meta_keywords'))
                {
                        $document->setMetadata('keywords', $settings->get('menu-meta_keywords'));
                }

                if ($settings->get('robots'))
                {
                        $document->setMetadata('robots', $settings->get('robots'));
                }


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