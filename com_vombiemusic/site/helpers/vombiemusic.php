<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.helper');

class VombieMusicHelper{
 
	/**
	* Returns a parsed url
	* @url 	The url to be parsed
	* @return domain.tld
	*/
	protected function getDomain($url) {
		$pieces = parse_url($url);
		$domain = isset($pieces['host']) ? $pieces['host'] : '';
		if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
			return $regs['domain'];
		}
	return false;
	}

	/**
	* Find the right embedding option and returns it as html
	*
	* @song_url Url to the video (currently only supporting - youtube - dailymotion)
	* @type 	Is it in a popup or iframe
	* @width 	Override options from settings
	* @height 	Override options from settings
	* @return 	As html
	* @TODO 	Let the user make their own plugins for this
	*/ 	

	public function embedVideo($song_url, $type = 'iframe', $width = null, $height = null){

		$app        = JFactory::getApplication();
		$params 	= $app->getParams();
		$document 	= JFactory::getDocument();

		$rel		= null;
		$iframe 	= null;
		$html 		= false;
		$width 		= ($width != null) ? $width : $params->get('modalWidth');
		$height		= ($height != null) ? $height : $params->get('modalHeight');
		//find the width and height from the settings for iframes
		if ($type == 'iframe'):
			$width 		= ($width != null) ? $width : $params->get('iframeWidth');
			$height		= ($height != null) ? $height : $params->get('iframeHeight');
		endif;

		if (!$song_url && JDEBUG):
			JError::raiseNotice(null, JText::_('COM_VOMBIEMUSIC_EMBEDVIDEO-FUNCTION_URL')); 
			return;
		endif;

		if ($type != 'iframe'):
			JHTML::_('behavior.modal');
		endif;

		$urltovideo = self::getDomain($song_url);	

		jimport('joomla.filesystem.file');

		//If a plugin for the url exits, will it be loaded, else uses a normal iframe.
		if (JFile::exists(JPATH_SITE.DS.'components'.DS.'com_vombiemusic'.DS.'plugin'.DS.'video'.DS.$urltovideo.'.php')) {

			include_once(JPATH_SITE.DS.'components'.DS.'com_vombiemusic'.DS.'plugin'.DS.'video'.DS.$urltovideo.'.php');
			$vid = explode(".", $urltovideo);
			
			$html = VombieMusicEmbedVideo::$vid[0]($song_url,$app->getParams(),$type,$width,$height);

		}		
	
		else{

			//uses the standard iframe/popup structure
			//you can add your own players from a different website.
			$rel 		= "rel=\"{url: '".$song_url."',handler:'iframe',size:{x:".$width.",y:".$height."}}\"";
			$iframe 	= "<iframe width=\"".$width."\" height=\"".$height."\" src=\"".$song_url."\" frameborder=\"0\" allowfullscreen></iframe>";

			$html 			= ($type == 'popup') ? $rel : $iframe;
		
		}
		if(!$html):
			JError::raiseError(500, JText::sprintf('COM_VOMBIEMUSIC_NO_HTML_EMBEDVIDEO', $song_url) );
			return false;
		endif;

	return $html;
	}

	/**
	* Iframe popup
	*
	* @url 		Url for the popup squeezebox window
	* @width 	The width of the popup (optional)
	* @height 	The heoght of the popup (optional)
	* @return 	A rel tag for <a>
	* @Todo 	Add more functions from squeezebox API.
	*/

	public function modalPopup($url, $width = null, $height = null){

		$app        = JFactory::getApplication();
		$params 	= $app->getParams();
		$document 	= JFactory::getDocument();
		JHTML::_('behavior.modal');

		$width 		= ($width) ? $width : $params->get('modalWidth');
		$height 	= ($height) ? $height : $params->get('modalHeight');

		$rel 		= "rel=\"{url:'".$url."',handler:'iframe',size:{x:".$width.",y:".$height."}}\"";
	return $rel;
	}

	/**
	* Will return a image tooltil
	* @image the path to url at server
	* @style css styles
	* @class css class
	* @id css id
	* @return tooltip html
	*/

	function VombieToolTip($image, $id = 'vombieTip', $style = null, $class = null, $type = 'image'){

		//will include joomla tooltip 
		JHTML::_('behavior.tooltip');

		$tooltip = null;
		if($type == 'image') {
			
			$tooltip = 
			JHTML::_('tooltip','<img src="'.JURI::base().'/'.$image.'" />','',
			'','<img src="'.$image.'" style="'.$style.'" class="'.$class.'" id="'.$id.'" />');
		}
		else{
			$tooltip = "No tooltip return from 'VombieHelper::VombieToolTip'";
		}
		return $tooltip;
	}

	/** 
	* I mention about to override squeezebox because of errors.
	* @handler 	the class at links who will open the popup
	* @parse 	the a tag which will be used to parse the data
	*/
	function vombieModal($handler = "a.modal", $parse = "rel"){
	
		JHTML::_('behavior.mootools');
		$document 	= JFactory::getDocument();
		$document->addScript('components/com_vombiemusic/assets/js/squeezebox-uncompressed.js','text/javascript');
		$document->addScriptDeclaration("window.addEvent('domready', function() {SqueezeBox.initialize({});SqueezeBox.assign($$('".$handler."'), {parse: '".$parse."'});});");
	}

 
}//class end
?>
