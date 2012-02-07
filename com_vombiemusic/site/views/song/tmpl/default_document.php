<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

	if ($this->item->document1 || $this->item->document2):
		
		$documents = array($this->item->document1, $this->item->document2);
		
		foreach($documents as $document){
			if ($document): 
				$html = '
				<a class="modal" href="http://docs.google.com/viewer?embedded=true&url='.$document.'" '.VombieMusicHelper::modalPopup('http://docs.google.com/viewer?url='.$document).'>
				<div class="vombieMusicDock" style="color:#666;	vertical-align: middle;font-size:30px;width:70%; margin: 0 auto; background:#00922D;border-radius:5px; height:100px;text-align:center;">
				<div class="vombieMusicDocInner" style="padding:10px;"><span>';
				$doc = explode("/", $document);
				$doc = explode(".", $doc[1]);
				$html .= $doc[0];
				$html .= "</span></div></div></a>";

			echo $html;
			else :
				JText::_('COM_VOMBIEMUSIC_SONG_NO_FILES');
			endif;
		}
	
	endif;
?>