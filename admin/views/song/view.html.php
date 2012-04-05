<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
class VombieMusicViewSong extends JView
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
		$this->setLayout('edit');
		$document = JFactory::getDocument();

		$document->addScriptDeclaration('
		function addDocumentUpload(title) {
			document.getElementById("jform_document").value = title;
			SqueezeBox.close();
	}
		');
 
		// Display the template
		parent::display($tpl);
	}
 
	protected function addToolBar() 
	{
		$getId = JRequest::getInt('id');

		JRequest::setVar('hidemainmenu', true);
		$isNew = ($this->item->id == 0);
		JToolBarHelper::title($isNew ? 
		JText::_('COM_VOMBIEMUSIC_SONG_NEW') : 
		JText::sprintf('COM_VOMBIEMUSIC_SONGS_EDIT', $getId)
);
		//Standard toolbars	
		JToolBarHelper::apply('song.apply', 'JTOOLBAR_APPLY');
		JToolBarHelper::save('song.save');
		JToolBarHelper::addNew('song.save2new', 'JTOOLBAR_SAVE_AND_NEW');
		JToolBarHelper::divider();
		JToolBarHelper::cancel('song.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');

	}
}