<?php


// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * Category view
 */
class VombieMusicViewPlaylist extends JView
{
        // Overwriting JView display method
        function display($tpl = null) 
        {
        $this->items    = $this->get('Songs');
        $this->playlist = $this->get('PlaylistInfo');

        $app      = JFactory::getApplication();
        $settings = $app->getParams(); 
        $this->assignRef('setting',$settings);
        $this->assignRef('item', $this->items);

        $this->params = JComponentHelper::getParams('com_vombiemusic');


        $app    = JFactory::getApplication();
        $menus  = $app->getMenu();
        $menu   = $menus->getActive();
        $document = & JFactory::getDocument();

              //  $this->params->def('page_heading', $this->params->get('page_title', $menu->title));

        if($menu){
                $title  = $this->params->get('page_title', $menu->title);
                $desc   = $this->params->get('menu-meta_description');
                $key    = $this->params->get('menu-meta_keywords');
        }

        if(empty($title)){
                if($this->playlist['metatitle']){
                        $title = $this->playlist['metatitle'];
                }
                else{
                        $title = $this->playlist['name'];
                }

        }

        if(empty($desc)){
                if($this->playlist['metadesc']){
                        $desc = $this->playlist['metadesc'];
                }
                else{
                        $desc = null;

                }
        }

        if(empty($key)){
                if($this->playlist['metakey']){
                        $key = $this->playlist['metakey'];
                }

        }

        if ($this->params->get('robots')){
                $document->setMetadata('robots', $this->params->get('robots'));
        }

        //Set the meta tags
        $document->setTitle($title);
        $document->setDescription($desc);
        $document->setMetadata('keywords', $key);

        $document->addStyleSheet(JURI::base().'components/com_vombiemusic/assets/css/vombiemusic.css');

        // Check for errors.
        if (count($errors = $this->get('Errors'))) 
        {
                JError::raiseError(500, implode('<br />', $errors));
                return false;
        }
        // Display the view
        parent::display($tpl);
        }
}