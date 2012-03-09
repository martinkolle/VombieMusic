<?php

defined('_JEXEC') or die('Restricted access');

//Import the modelitem library
jimport('joomla.application.component.modelitem');


class VombieMusicModelPlaylist extends JModelItem
{ 
	
	/**
	 * Method to get Playlist
	 * @access public
	 * @return array
	 */
	function getSongs() {
   
		$db 	= $this->getDBO();			
		$query  = $db->getQuery(true);
		$id 	= JRequest::getInt('id');

		$query->select('a.id AS playlistId,a.song_id,a.playlist_id,a.ordering');
		$query->from('#__vombiemusic_song_playlist AS a');

		$query->select('b.id AS songId,b.name AS songName,b.artist AS songArtist,b.published AS songPublished, b.song_url, b.time AS songDuration, b.image AS songImage');
		$query->join('LEFT', '#__vombiemusic_song AS b ON b.id = a.song_id');

		$query->select('c.id AS catId, c.title AS catTitle, c.description AS catDescription, c.published AS catPublished');
		$query->join('LEFT', '#__categories AS c ON c.id = b.catid');

		$query->where('a.playlist_id = "'.(int) $id.'"');
		$query->where('b.published = 1');
		
		$nullDate	= $db->Quote($db->getNullDate());
		$nowDate	= $db->Quote(JFactory::getDate()->toMySQL());
		$query->where('(b.publish_up = '.$nullDate.' OR b.publish_up <= '.$nowDate.')');
		$query->where('(b.publish_down = '.$nullDate.' OR b.publish_down >= '.$nowDate.')');

		$query->order('a.ordering ASC');
		
		$db->setQuery( $query );
		$rows = $db->loadObjectList();

		if (empty($rows)) {
			return JError::raiseNotice(100,JText::_('COM_VOMBIEMUSIC_PLAYLIST_NO_SONGS'));
		}

		return $rows;
		
	}

	function getPlaylistInfo() {
		//get the category description and params
		$db     = JFactory::getDBO();                     
		$query  = $db->getQuery(true);
		$id     = JRequest::getInt('id');
        //let us load the informations from the son db
        $query->select('a.*');
        $query->from('#__vombiemusic_playlist AS a');
        $query->where('a.id = "'.(int) $id.'"');
        $db->setQuery( $query );
        $rows = $db->loadAssoc();

		if (empty($rows)) {
			return JError::raiseError(404,JText::_('COM_VOMBIEMUSIC_PLAYLIST_NOT_FOUND'));
		}

		return $rows;
	}
}

?>