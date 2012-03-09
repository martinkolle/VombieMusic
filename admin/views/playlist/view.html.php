<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
class VombieMusicViewPlaylist extends JView
{

	public function display($tpl = null) 
	{
		// get the Data
		$form = $this->get('Form');
		$item = $this->get('Item');
 
		// Check for errors.
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		// Assign the Data
		$this->form = $form;
		$this->item = $item;
 
		// Set the toolbar
		$this->addToolBar();
  
		// Set the document
		$this->setDocument();

		// Display the template
		parent::display($tpl);
	}
 
	protected function addToolBar() 
	{
		JRequest::setVar('hidemainmenu', true);
		$user = JFactory::getUser();
		$userId = $user->id;
		$isNew = $this->item->id == 0;
		JToolBarHelper::title($isNew ? JText::_('COM_VOMBIEMUSIC_PLAYLIST_NEW') : JText::_('COM_VOMBIEMUSIC_PLAYLIST_EDIT'), 'vombiemusic');
		
		JToolBarHelper::apply('playlist.apply', 'JTOOLBAR_APPLY');
		JToolBarHelper::save('playlist.save', 'JTOOLBAR_SAVE');
		JToolBarHelper::custom('playlist.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
		JToolBarHelper::divider();
		JToolBarHelper::cancel('playlist.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
	}

	protected function setDocument() 
	{
		$isNew = $this->item->id == 0;
		$document = JFactory::getDocument();
		$document->setTitle($isNew ? JText::_('COM_VOMBIEMUSIC_CREATING') : JText::_('COM_VOMBIEMUSIC_PLAYLIST_EDITING'));
	}
}
