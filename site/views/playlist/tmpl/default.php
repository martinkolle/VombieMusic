<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

require_once(JPATH_COMPONENT . '/helpers/songs.php');

?>
<div id="vombieMusicContainer">
	<div id="vombieMusicTop">
		<div class="vombieMusicTopDesc">
			<h2 id="vombieMusic"><?php echo $this->playlist['name']; ?></h2>
			<div class="VombieMusicDescription">
			<?php echo $this->playlist['info']; ?>
			</div>
			<span class="vombieMusicButton grey category">
			<?php echo JText::sprintf('COM_VOMBIEMUSIC_SONGS_IN_PLAYLIST', count($this->items)); ?>
			</span>
		</div>
		<div class="vombieMusicCategoryImg">
		<?php
			if ($this->setting->get('playlistImageTooltip')):		
		 		echo VombieMusicHelper::VombieToolTip($this->playlist['image'],'');
		 	else :
		 		echo '<img src="'.JURI::base().'/'. $this->playlist['image'].'" />';
		 	endif;

		?>
		
		</div>
	</div>

<?php 
foreach($this->items as $i => $item):

$item->songDuration = ($item->songDuration == '0') ? '00:00' : $item->songDuration;

?>

<div class="vombieMusicSong" id="<?php echo $item->songId; ?>">
	<div class="vombieMusicSongInner">
		<img src="<?php echo JURI::base()."/". $item->songImage; ?>" style="height:50px; width:50px; float:left;" />
<div class="vombieMusicSongPlay">
	<?php if($item->song_url): ?>
		<div class="vombieMusicSongPlayListen" style="<?php echo (!$this->setting->get('songReadMore')) ? 'top:40px' : ''; ?>">
			<span class="vombieMusicButton grey">
				<a class="vombieMusicSongListen modal" <?php echo VombieMusicHelper::embedVideo($item->song_url, 'popup'); ?>				 href="<?php echo $item->song_url; ?>"><?php echo JText::_('COM_VOMBIEMUSIC_SONG_LISTEN'); ?>
				</a>
			</span>
		</div>
	<?php endif; ?>
	<?php if($this->setting->get('songReadMore')): ?>
		<div class="vombieMusicSongPlayReadMore" style="<?php echo (!$item->song_url) ? 'top:40px !important' : ''; ?>">
			<span class="vombieMusicButton green">
				<a class="vombieMusicSongPlay" href="<?php echo JRoute::_('index.php?option=com_vombiemusic&view=song&id='.$item->songId); ?>">
				<?php echo JText::_('COM_VOMBIEMUSIC_SONG_MORE_INFO'); ?>
				</a>
			</span>
		</div>
	<?php endif; ?>
</div>

		<span class="vombieMusicSongName">
			<a class="vombieMusicSongName" href="<?php echo JRoute::_('index.php?option=com_vombiemusic&view=song&id='.$item->songId); ?>"><?php echo $item->songName; ?></a>
			</span>
			<span class="vombieMusicSongArtist"> <?php echo $item->songArtist; ?></span>

			<span class="vombieMusicSongTime">(<?php echo $item->songDuration; ?>)</span>
	</div>
</div>
<?php endforeach; ?>
</div>