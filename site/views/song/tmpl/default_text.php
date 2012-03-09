<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

	if ($this->item->document1 || $this->item->document2):
		
		$documents = array($this->item->document1, $this->item->document2);
		
		foreach($documents as $document){

			$html = '<div id="vombieMusicDocuments"><span>'
			echo $document;
			echo "</div></span>";
		}

	endif;
?>