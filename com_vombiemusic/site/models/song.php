<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
 

class VombieMusicModelSong extends JModelItem
{
	/**
	 * @var string msg
	 */
	protected $msg;
 
	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param	type	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 * @return	JTable	A database object
	 * @since	1.6
	 */
	public function getTable($type = 'song', $prefix = 'VombieMusicTable', $config = array()) 
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	/**
	 * Get the message
	 * @return string The message to be displayed to the user
	 */
	public function getItem() 
	{

			$id = JRequest::getInt('id');
			$db = $this->getDbo();
			$query = $db->getQuery(true);
			
			$query->select('c.*');
			$query->from('#__vombiemusic_song AS c');

			$query->select('d.title AS category_title, d.alias AS category_alias, d.access AS category_access');
			$query->join('LEFT', '#__categories AS d on d.id = c.catid');

			$query->where('c.id = '.(int) $id);
			$query->where('c.published = 1');
			
			$nullDate	= $db->Quote($db->getNullDate());
			$nowDate	= $db->Quote(JFactory::getDate()->toMySQL());
			$query->where('(c.publish_up = '.$nullDate.' OR c.publish_up <= '.$nowDate.')');
			$query->where('(c.publish_down = '.$nullDate.' OR c.publish_down >= '.$nowDate.')');
			
			$db->setQuery($query);
			$data = $db->loadObject();
			
			if ($db->getErrorMsg()) {
				return JError::raiseError(505,$db->getErrorMsg());
			}

			if (empty($data)) {
				return JError::raiseError(404,JText::_('COM_VOMBIEMUSIC_SONG_NOT_FOUND'));
			}
	
		return $data;
	}
}