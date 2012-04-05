<?php
// No direct access to this file
defined('_JEXEC') or die;
 
jimport('joomla.form.formfield');
 
/**
*	Generates a list of songs for the playlsit
**/
class JFormFieldVombieMusicUpload extends JFormField
{
	/** 
	 * The field type.
	 * @var		string
	 */
	protected $type = 'Upload';
 
	/**
	 * Method to get the songs in playlist fra the db.
	 *
	 * @return	string		The songs in a table
	 */
	protected function getInput()
	{
					//get the id
		$id = JRequest::getInt('id');
		JHTML::_('behavior.mootools');
		JHTML::_('behavior.modal');


	return "<div class=\"button2-left\"><div class=\"blank\"><a href=\"index.php?option=com_vombiemusic&view=upload&tmpl=component&id=".$id."\" class=\"modal \" style=\"float:left;\" rel=\"{url: 'index.php?option=com_vombiemusic&task=playlistSongs&tmpl=component&id=".$id."',handler:'iframe',size:{x:360,y:350}}\">Upload Songs</a></div></div>
			<div id=\"vombiemusic_upload\"></div>
			<input type=\"text\" name=\"jform[document]\" id=\"jform_document\" value=\"\" class=\"inputbox\" size=\"40\">
	";
	}
}