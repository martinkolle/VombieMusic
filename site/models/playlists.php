<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import the Joomla modellist library
jimport('joomla.application.component.modellist');

class VombieMusicModelPlaylists extends JModelList
{

	/**
	* Get the data from the datasbe
	* @return sql query
	*/

	protected function getListQuery()
	{
		// Create a new query object.		
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		// Select some fields
		$query->select('a.*');
		$query->from('#__vombiemusic_playlist AS a');
		$query->where('a.published = 1');
		//TODO!! acces and so on
		//$query->where('a.access = ???');

		$nullDate	= $db->Quote($db->getNullDate());
		$nowDate	= $db->Quote(JFactory::getDate()->toMySQL());
		$query->where('(a.publish_up = '.$nullDate.' OR a.publish_up <= '.$nowDate.')');
		$query->where('(a.publish_down = '.$nullDate.' OR a.publish_down >= '.$nowDate.')');

		return $query;
	}
}