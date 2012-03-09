<?php

defined('_JEXEC') or die('Restricted access');

//Import the modelitem library
jimport('joomla.application.component.modelitem');


class VombieMusicModelCategory extends JModelItem
{ 
	
	/**
	 * Method to get category
	 * @access public
	 * @return array
	 */
	function getSongs() {
   
		$db 	=& $this->getDBO();			
		$query  = $db->getQuery(true);
		$id 	= JRequest::getInt('id');
		
		//let us load the informations from the son db
		$query->select('a.id AS songId,a.name,a.catid,a.image,a.published,a.access,a.song_url,a.document1,a.info,a.params, b.id, b.title AS categoryname, a.artist, a.time, a.song_url AS songurl, a.publish_up, a.publish_down');
		$query->from('#__vombiemusic_song AS a');

		//load the category details.
		$query->select('b.id AS category_id, b.title AS category_title, b.alias AS category_alias, b.access AS category_alias');
		$query->join('LEFT','#__categories AS b ON b.id = a.catid');


		$query->where('a.catid = "'.(int) $id.'"');
		$query->where('a.published = 1');
		
		$nullDate	= $db->Quote($db->getNullDate());
		$nowDate	= $db->Quote(JFactory::getDate()->toMySQL());
		$query->where('(a.publish_up = '.$nullDate.' OR a.publish_up <= '.$nowDate.')');
		$query->where('(a.publish_down = '.$nullDate.' OR a.publish_down >= '.$nowDate.')');

		
		$db->setQuery( $query );
		$rows = $db->loadObjectList();

		if (empty($rows)) {
				return JError::raiseError(404,JText::_('COM_VOMBIEMUSIC_CATEGORY_NOT_FOUND'));
		}

		return $rows;
		
	}
}

?>