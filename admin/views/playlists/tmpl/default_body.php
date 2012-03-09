<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<?php foreach($this->items as $i => $item): ?>
	<tr class="row<?php echo $i % 2; ?>">
		<td>
			<?php echo JHtml::_('grid.id', $i, $item->id); ?>
		</td>
		<td>
			<?php echo $item->id; ?>
		</td>
		<td>
			<a href="<?php echo JRoute::_('index.php?option=com_vombiemusic&task=playlist.edit&id='.$item->id); ?>"><?php echo $item->name; ?>
		</td>
		<td>
			<?php echo $item->info; ?>
		</td>
		<td>
			<?php echo $item->image; ?>
		</td>
		<td>
			<?php echo JHtml::_('jgrid.published', $item->published, $i, 'playlists.', true, 'cb'); ?>
		</td>
	</tr>
<?php endforeach; ?>