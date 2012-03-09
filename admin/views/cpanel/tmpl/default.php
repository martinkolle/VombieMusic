<div id="cpanel">

<?php 

	echo $this->addIcon('all_songs','songs',JText::_('COM_VOMBIEMUSIC_VIEW_SONGS'));

	echo $this->addIcon('new_song','index.php?option=com_vombiemusic&task=song.add',JText::_('COM_VOMBIEMUSIC_VIEW_NEW_SONG'), true);

	echo $this->addIcon('category','index.php?option=com_categories&extension=com_vombiemusic',JText::_('COM_VOMBIEMUSIC_VIEW_CATEGORY'), true);

	echo $this->addIcon('new_category','index.php?option=com_categories&extension=com_vombiemusic&task=category.add',JText::_('COM_VOMBIEMUSIC_VIEW_NEW_CATEGORY'), true);
?>

</div>

<div id="redirect"> hej</div>