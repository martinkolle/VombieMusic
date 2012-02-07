<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.helper');

class VombieMusicHelperPlaylists{

	/**
	* Find the numbers of songs in a playlist
	* @return Sql query
	*/

	function getPlaylistCount($id){
		// Create a new query object.		
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		// Select some fields
		$query->select('a.*');
		$query->from('#__vombiemusic_song_playlist AS a');
		$query->where('a.playlist_id = '.$id);
		//TODO!! acces and so on
		//$query->where('a.access = ???');

		$nullDate	= $db->Quote($db->getNullDate());
		$nowDate	= $db->Quote(JFactory::getDate()->toMySQL());
		$query->where('(a.publish_up = '.$nullDate.' OR a.publish_up <= '.$nowDate.')');
		$query->where('(a.publish_down = '.$nullDate.' OR a.publish_down >= '.$nowDate.')');

		$db->setQuery($query);
		$rows = $db->loadObjectList();

		return count($rows);


	}
}//class end
?>
