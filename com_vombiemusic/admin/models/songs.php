<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
// import the Joomla modellist library
jimport('joomla.application.component.modellist');

class VombieMusicModelSongs extends JModelList
{
	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return	string	An SQL query
	 */
	protected function getListQuery()
	{
		// Create a new query object.		
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		// Select some fields
		$query->select('a.*');
		// From the hello table
		$query->from('#__vombiemusic_song AS a');
		return $query;
	}
	/**
	 * Method to remove a playlist
	 *
	 * @return	boolean	True on success
	 */
	function delete($cid = array())
	{
		if (count( $cid ))
		{
			// Create a new query object.		
			$db = JFactory::getDBO();
			$cids = implode( ',', $cid );

			$db->setQuery('DELETE FROM #__vombiemusic_playlist WHERE id IN ( '.(int)$cids.' )');

			$this->_db->setQuery( $query );

			if (!$db->query()) {
				throw new Exception($db->getErrorMsg());
			}
		}

		return true;
	}
}