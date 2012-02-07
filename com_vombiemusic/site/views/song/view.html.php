<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
class VombieMusicViewSong extends JView
{
	// Overwriting JView display method
	function display($tpl = null) 
	{
		// Assign data to the view
		$this->item = $this->get('Item');

                /*
                //Include facebook like button - wil be added in a later version(if not find better way to include this)
                jimport('joomla.application.module.helper');
                $modules = JModuleHelper::getModule('mod_facebooklike');

                $this->assignRef('module', $module);
                */

		JHTML::_('behavior.mootools');
		$document =  JFactory::getDocument();
		$document->addStyleSheet(JURI::base().'components/com_vombiemusic/assets/css/vombiemusic.css');
		$document->addScriptDeclaration("
		window.addEvent('domready',function() {
			new Fx.SmoothScroll({links: '.scroll',duration: 200,wheelStops: false},window);
			var toggleSlide = new Fx.Slide('vombieMusicBoxInner');
			//var toggleSlideImg = new Fx.Slide('vombieSongImage');
		/*	$('vombiedescToggle').addEvent('click', function(event){ event.stop();toggleSlide.toggle(); 
				//toggleSlideImg.hide();
  			}); */
		});
		",'text/javascript');

		$this->embed = VombieMusicHelper::embedVideo($this->item->song_url, 'iframe');
		$app     	= JFactory::getApplication();
        $params		= $app->getParams(); 
        $this->assignRef('params',$params);


        $menus  = $app->getMenu();
        $menu   = $menus->getActive();
        $document = & JFactory::getDocument();
        $title  = null;
        $desc   = null;
        $key    = null;

        if($menu){
                $title  = $this->params->get('page_title', $menu->title);
                $desc   = $this->params->get('menu-meta_description');
                $key    = $this->params->get('menu-meta_keywords');
        }

        if(empty($title)){
                if($this->item->metatitle){
                        $title = $this->item->metatitle;
                }
                else{
                        $title = $this->item->name;
                }

        }

        if(empty($desc)){
                if($this->item->metadesc){
                        $desc = $this->item->metadesc;
                }
                else{
                        $desc = null;
                }
        }

        if(empty($key)){
                if($this->item->metakey){
                        $key = $this->item->metakey;
                }
        }

        if ($this->params->get('robots')){
                $document->setMetadata('robots', $this->params->get('robots'));
        }

        //Set the meta tags
        $document->setTitle($title);
        $document->setDescription($desc);
        $document->setMetadata('keywords', $key);


		// Check for errors.
	if (count($errors = $this->get('Errors'))) 
	{
		JError::raiseError(500, implode('<br />', $errors));
	       	return false;
	}
	if(JRequest::getVar('task') == 'document'){
        	$tpl = 'document';
		$document->addStyleDeclaration('body, #all{background:rgb(204, 204, 204) !important;}','text/css');	
		}
	// Display the view
	parent::display($tpl);
	
        }
}