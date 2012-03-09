<?php
// No direct access to this file
defined('_JEXEC') or die;

class VombieMusicHelper
{
	
	public static function addSubmenu($vName)
	{
		JSubMenuHelper::addEntry(
			JText::_('COM_VOMBIEMUSIC_CPANEL'),
			'index.php?option=com_vombiemusic',
			$vName == 'cpanel'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_VOMBIEMUSIC_SONGS'),
			'index.php?option=com_vombiemusic&view=songs',
			$vName == 'songs'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_VOMBIEMUSIC_CATEGORY'),
			'index.php?option=com_categories&extension=com_vombiemusic',
			$vName == 'categories'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_VOMBIEMUSIC_PLAYLIST'),
			'index.php?option=com_vombiemusic&view=playlists',
			$vName == 'playlists'
		);
		if ($vName=='categories') {
			JToolBarHelper::title(
			JText::sprintf('COM_VOMBIEMUSIC',JText::_('com_vombiemusic')),'');
		}
	}
	
}
?>