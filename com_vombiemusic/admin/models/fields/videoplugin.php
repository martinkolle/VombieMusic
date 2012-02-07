<?php
// No direct access to this file
defined('_JEXEC') or die;
 
jimport('joomla.form.formfield');
jimport('joomla.filesystem.folder');


class JFormFieldVideoPlugin extends JFormField
{
	/**
	 * The field type.
	 * @var		string
	 */
	protected $type = 'VideoPlugin';
 
	protected function getInput()
	{

		$fileList	= JFolder::files(JPATH_SITE.DS.'components'.DS.'com_vombiemusic'.DS.'plugin'.DS.'video');
		$html = '';

		if(!$fileList):
			$html = JText::_('COM_VOMBIEMUSIC_SETTINGS_VIDEO_NO_PLUGINS');
		
		else:
				
			$html .= '<div style="width:100%; float:right;">';
			
			foreach($fileList as $file){	
				$html .='<div style="height:20px; padding:10px; font-size:20px; border-bottom:2px solid #ccc;">'. str_replace('.php', '', $file);
				$html .= '</div>';
			}
			

			$html .= '</div>';

		endif;

		return 	$html;
	}
}