<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
require_once(JPATH_COMPONENT . '/helpers/songs.php');
?>

<div id="vombieMusicContainer">
	<h1 id="vombieMusic" class="song">
		<?php echo $this->item->name; ?> - 
		<span id="vombieMusicArtist" class="song">
			<em><?php echo $this->item->artist; ?></em>
		</span>
	</h1>
	<div id="vombieMusicBox" class="song">
			<div id="vombieMusicBar">
		<ul>
			<li><a href="#vombieMusicVideo" class="scroll">Video</a></li>
			<?php if ($this->item->document1 || $this->item->document2): ?>

			<li><a href="index.php?option=com_vombiemusic&view=song&task=document&tmpl=component&id=<?php echo $this->item->id; ?>" <?php echo VombieMusichelper::modalPopup('index.php?option=com_vombiemusic&view=song&task=document&tmpl=component&id='.$this->item->id, '600', '400'); ?> class="modal">Text</a>
			</li>
			<?php endif; ?>
		</ul>
		</div>
		<div id="vombieMusicBoxInner" class="song">
			<div id="vombieMusicDescription" class="song">
				<?php echo $this->item->info; ?>
				<?php echo VombieMusicHelper::VombieToolTip($this->item->image, 'vombieSongImage'); ?>
			</div>

		</div>
	</div>
	<?php if($this->item->song_url): ?>
	<div id="vombieMusicVideo" class="song">
	
		<div id="vombieMusicVideo-inner" class="song">
		<?php echo VombieMusichelper::embedVideo($this->item->song_url, 'iframe', '600','320'); ?>
		</div>
	</div>
	<?php endif; ?>
</div>