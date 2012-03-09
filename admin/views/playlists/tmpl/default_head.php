<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<tr>
	<th width="5" class="sorttable_nosort">
		<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" />
	</th>
	<th width="20">
		<?php echo JText::_('COM_VOMBIEMUSIC_ID'); ?>
	</th>			
	<th>
		<?php echo JText::_('COM_VOMBIEMUSIC_PLAYLIST_NAME'); ?>
	</th>
	<th>
		<?php echo JText::_('COM_VOMBIEMUSIC_PLAYLIST_INFO'); ?>
	</th>
	<th>
		<?php echo JText::_('COM_VOMBIEMUSIC_PLAYLIST_IMAGES'); ?>
	</th>
	<th width="5">
		<?php echo JText::_('COM_VOMBIEMUSIC_PUBLISHED'); ?>
	</th>
</tr>