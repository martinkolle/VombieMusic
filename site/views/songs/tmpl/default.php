<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>

<div id="vombieMusicContainer">
<h2 id="vombieMusic"><?php //echo $this->setting->heading; ?></h2>

<?php 
foreach($this->items as $i => $item):

$item->time = ($item->time == '0') ? '00:00' : $item->time;
?>

<div class="vombieMusicSong" id="<?php echo $item->songId; ?>">
	<div class="vombieMusicSongInner">
		<?php echo VombieMusicHelper::VombieToolTip($item->image); ?>
<div class="vombieMusicSongPlay">
	<?php if($item->song_url): ?>
		<div class="vombieMusicSongPlayListen" style="<?php echo (!$this->setting->get('songReadMore')) ? 'top:40px' : ''; ?>">
			<span class="vombieMusicButton grey">
				<a class="vombieMusicSongListen modal" <?php echo VombieMusichelper::embedVideo($item->song_url,'popup'); ?>
				 href="<?php echo $item->song_url; ?>"><?php echo JText::_('COM_VOMBIEMUSIC_SONG_LISTEN'); ?>
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
			<a class="vombieMusicSongName" href="<?php echo JRoute::_('index.php?option=com_vombiemusic&view=song&id='.$item->songId); ?>"><?php echo $item->name; ?></a>
			</span>
			<span class="vombieMusicSongArtist"> <?php echo $item->artist; ?></span>

			<span class="vombieMusicSongTime">(<?php echo $item->time; ?>)</span>
	</div>
</div>
<?php endforeach; ?>
</div>