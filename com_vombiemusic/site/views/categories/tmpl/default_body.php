<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

require_once(JPATH_COMPONENT.DS.'/helpers/category.php');
?>
<?php foreach($this->items as $i => $item): 

$json = $item->params;
$obj = json_decode($json);
						 
?>

<script type="text/javascript">
/* window.addEvent('domready', function() {
  $$("img.enlarge").addEvent("mouseover", function() {
		new Element ( 'img' , { 'src' : this.get('src') , 'style' :  'position:relative;' });
	});
});*/

window.addEvent('domready', function() {
$$('img.enlarge').each(function(img) {
  var src = img.getProperty('src');
  img.addEvent('mouseenter', function() { var enlarged_image = new Element ('img',{ 'src' : src , 'style' :  'position:absolute;z-index:999; border:10px solid black;','id': 'enlarged_image' });
var image = new Element ('img.enlargedImage[src='+src+']')

 });
  img.addEvent('mouseleave', function() {});
});
});
</script>

<div class="vombieMusicList vombieMusicCategories" id="<?php echo $item->id; ?> vombieMusicCategory">
<div class="vombieMusicInner">
<img class="enlarge" src="<?php echo JURI::base()."/". $obj->{'image'}; ?>" style="height:50px; width:50px; float:left;" />
	<a class="vombieMusicCategories" href="<?php echo JRoute::_('index.php?option=com_vombiemusic&view=category&id='.$item->id); ?>"><?php echo $item->title; ?></a>

<span class="vombieMusicCategoryDesc"><?php echo $item->description; ?></span>
<span class="vombieMusicSongCountSong"><?php echo JText::sprintf('COM_VOMBIEMUSIC_SONGS_IN_CATEGORY', countSongsCategory($item->id)); ?></span>

</div>
</div>
<?php endforeach; ?>