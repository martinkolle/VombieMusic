<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

require_once(JPATH_COMPONENT . '/helpers/songs.php');
require_once(JPATH_COMPONENT . '/helpers/playlists.php');

//shortcut

?>
<div id="vombieMusicContainer">
<div id="playlists">
<h1 id="vombieMusic"><?php echo $this->header; ?></h1>

<?php 
foreach($this->items as $i => $item):
?>

<div class="vombieMusicSong" id="<?php echo $item->id; ?>">
	<div class="vombieMusicSongInner">
		<?php
			if ($this->setting->get('playlistsImageTooltip')):		
		 		echo VombieMusicHelper::VombieToolTip($item->image);
		 	else :
		 		echo '<img src="'.JURI::base().'/'. $item->image.'" style="float:left;" />';
		 	endif;
?>
<div class="vombieMusicSongPlay">
	<?php if($this->setting->get('playlistsReadMore')): ?>
		<div class="vombieMusicSongPlayReadMore" style="top:40px !important">
			<span class="vombieMusicButton green">
				<a class="vombieMusicSongPlay" href="<?php echo JRoute::_('index.php?option=com_vombiemusic&view=playlist&id='.$item->id); ?>">
				<?php echo JText::_('COM_VOMBIEMUSIC_SONG_MORE_INFO'); ?>
				</a>
			</span>
		</div>
	<?php endif; ?>
</div>

		<span class="vombieMusicSongName">
			<a class="vombieMusicSongName" href="<?php echo JRoute::_('index.php?option=com_vombiemusic&view=playlist&id='.$item->id); ?>"><?php echo $item->name; ?></a>
			</span>
			<span class="vombieMusicPlaylistsGenre">
				<?php echo 
				(VombieMusicHelperPlaylists::getPlaylistCount($item->id))
				? JText::sprintf('COM_VOMBIEMUSIC_SONGS_IN_PLAYLIST',VombieMusicHelperPlaylists::getPlaylistCount($item->id)) : JText::_('COM_VOMBIEMUSIC_NO_SONGS_IN_PLAYLIST');
				?>
			</span>
			<?php if($item->genre): ?>
 			<span class="vombieMusicPlaylistsGenre"> <?php echo $item->genre; ?></span>
 			<?php endif; ?>
	</div>
</div>
<?php endforeach; ?>
</div>
</div> 