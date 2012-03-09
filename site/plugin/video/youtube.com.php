<?php 
defined('_JEXEC') or die;

class VombieMusicEmbedVideo{

	function youtube($song_url,$params,$type,$width,$height){

		$youtubeId 		= explode("?v=", $song_url);
		$embedYoutubeId = $youtubeId[1];
		$url_video		= "http://youtube.com/embed/".$embedYoutubeId;
		$settings		= "?autoplay=".$params->get('modalAutoPlay')."&hd=".$params->get('modalHd');
						
		$rel 			= "rel=\"{url: '".$url_video.$settings."',handler:'iframe',size:{x:".$width.",y:".$height."}}\"";
		$iframe 		= "<iframe width=\"".$width."\" height=\"".$height."\" src=\"".$url_video."\" frameborder=\"0\" allowfullscreen></iframe>";

		$html = ($type == 'popup') ? $rel : $iframe;

		return $html;
	}
}//class end
?>