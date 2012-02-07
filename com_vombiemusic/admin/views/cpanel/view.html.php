<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * HelloWorlds View
 */
class VombieMusicViewCpanel extends JView
{
	/**
	 * HelloWorlds view display method
	 * @return void
	 */
	function display($tpl = null) 
	{	
 
		// Check for errors.
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		$this->addToolBar();
		$document 	= JFactory::getDocument();
		$params = JComponentHelper::getParams('com_vombiemusic');

		if($params->get('shortcutBackend')) :
			$document->addScript('components/com_vombiemusic/assets/shortcut.js','text/javascript');
			$document->addScriptDeclaration("
				shortcut.add('Ctrl+S',function() {
					window.location = 'index.php?option=com_vombiemusic&task=song.add';
				});
		
				$$('#redirect').setStyles({
width: '100%', height: '100%'});


			",'text/javascript');
		
		endif;

 
		// Display the template
		parent::display($tpl);
	}
	
	
	
	/**
	 * Creates the buttons view
	 **/
	function addIcon( $image, $view, $text, $notVombie = null)
	{
		$lang		=& JFactory::getLanguage();
		$link = ($notVombie) ? $view : 'index.php?option=com_vombiemusic&view=' . $view;
		
		echo '<div class="icon">';
		echo '	<a href="'.$link.'">';
		echo '<img src="../media/com_vombiemusic/images/'.$image.'.png" alt="'.$text.'" />';
		echo '		<span>'.$text.'</span>';
		echo 	'</a>';
		echo '</div>';
	}
	
		protected function addToolBar() 
	{
		JToolBarHelper::title(JText::_('COM_VOMBIEMUSIC_CPANEL'));
		JToolBarHelper::preferences('com_vombiemusic');
	}
	
	
	
}