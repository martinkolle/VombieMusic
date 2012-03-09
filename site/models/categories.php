<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
 


class VombieMusicModelCategories extends JModelItem
{ 
	var $_data = null;
	
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * Method to get Categories
	 * @access public
	 * @return array
	 */
	function getData() {
   
		$db =& $this->getDBO();			
		$where = $this->_buildWhere();	
		$query = "SELECT * FROM #__categories ". $where ." ORDER BY rgt ";		
		
		$db->setQuery( $query );
		$rows = $db->loadObjectList();

		return $rows;
	}
	
	/**
	 * Method to get Query Where
	 * @access public
	 * @return array
	 */
	function _buildWhere() {
	
    $user	=& JFactory::getUser();
		$this_user = $user->id;
		
		$where = array();
		
		if ($this_user==0) {
		$where[] = 'access = 1';
		}
		
		$where[] = 'parent_id = 1';
		$where[] = 'extension = "com_vombiemusic" ';
		$where[] = 'published = 1';
		$where 		= ( count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '' );

		return $where;	
	}
}