<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.modellist');

class VombieMusicModelSongs extends JModelList
{

	/**
	* Get the text from the databse
	* @return Sql query
	*/

	protected function getListQuery()
	{
		// Create a new query object.		
		$db 		= JFactory::getDBO();
		$query 		= $db->getQuery(true);
		$nullDate	= $db->Quote($db->getNullDate());
		$nowDate	= $db->Quote(JFactory::getDate()->toMySQL());

		// Select some fields
		$query->select('a.id AS songId,a.name,a.catid,a.image,a.published,a.access,a.song_url,a.document1,a.info,a.params, a.artist, a.time,a.publish_up,a.publish_down');
		$query->from('#__vombiemusic_song AS a');

		$query->select('b.id, b.title AS categoryname');
		$query->join('LEFT', '#__categories AS b ON b.id = a.catid ');

		$query->where('(a.publish_up = '.$nullDate.' OR a.publish_up <= '.$nowDate.')');
		$query->where('(a.publish_down = '.$nullDate.' OR a.publish_down >= '.$nowDate.')');
		$query->where('a.published = 1');

		//I'm returning to hell :(
		return $query;
	}
}