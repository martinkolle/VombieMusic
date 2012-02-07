<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
class VombieMusicViewSongs extends JView
{

	public function display($tpl = null) 
	{
		// get the Data
		$form = $this->get('Form');
		$items = $this->get('Items');
		$pagination = $this->get('Pagination');

 
		// Check for errors.
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		// Assign the Data
		$this->form = $form;
		$this->items = $items;
		$this->pagination = $pagination;

		$document = JFactory::getDocument();
		$document->addScript('components/com_vombiemusic/assets/sorttable.js','text/javascript');
 
		// Set the toolbar
		$this->addToolBar();
		$task = JRequest::getInt('task', null);
 
		// Display the template
		parent::display($tpl);
	}
 
	/**
	 * Setting the toolbar
	 */
	protected function addToolBar() 
	{
		$getId = JRequest::getInt('id');
		$task = JRequest::getInt('task', null);

		JToolBarHelper::title( ($task == 'edit') ? JText::sprintf('COM_VOMBIEMUSIC_PLAYLIST_EDIT', $getId) : JText::_('COM_VOMBIEMUSIC_PLAYLIST'));
		
		JToolBarHelper::addNew('song.add');
		JToolBarHelper::editList('song.edit');
		JToolBarHelper::divider();
		JToolBarHelper::publish('songs.publish');
		JToolBarHelper::unpublish('songs.unpublish');
		JToolBarHelper::divider();
		JToolBarHelper::deleteList('', 'songs.delete');

	}
}