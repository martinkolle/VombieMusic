<?php 

defined('_JEXEC') or die;

	$dailymotionId 	= explode("/video/",$song_url);
	$id 		 	= explode("_",$dailymotionId[1]);
	$url_video		= "http://dailymotion.com/embed/video/".$id[0];
	$settings		= "?autoplay=".$params->get('modalAutoPlay');			
	$rel 			= "rel=\"{url: '".$url_video.$settings."',handler:'iframe',size:{x:".$width.",y:".$height."}}\"";
			
	$iframe 		= "<iframe width=\"".$width."\" height=\"".$height."\" src=\"".$url_video."\" frameborder=\"0\" allowfullscreen></iframe>";

	$html = ($type == 'popup') ? $rel : $iframe;

?>