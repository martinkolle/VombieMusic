<?php
// No direct access to this file
defined('_JEXEC') or die;
 
jimport('joomla.form.formfield');
 
/**
*	Generates a list of songs for the playlsit
	@return A list of the songs, or a error message if a new playlist!
	@
**/
class JFormFieldVombieMusicListAllPlaylistSongs extends JFormField
{
	/**
	 * The field type.
	 * @var		string
	 */
	protected $type = 'VombieMusicListAllPlaylistSongs';
 
	/**
	 * Method to get the songs in playlist fra the db.
	 *
	 * @return	string		The songs in a table
	 */
	protected function getInput()
	{
		//get the id
		$id 		= JRequest::getInt('id');
		$settings	= JComponentHelper::getParams('com_vombiemusic');
		$document 	= JFactory::getDocument();
		$html 		= null;

		
		//Include mootools
		JHTML::_('behavior.mootools');

		//contact the db
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('a.id AS playlistId,a.song_id,a.playlist_id,a.ordering');
		$query->from('#__vombiemusic_song_playlist AS a');

		$query->select('b.id,b.name,b.artist,b.published');
		$query->join('LEFT', '#__vombiemusic_song AS b ON b.id = a.song_id');
		$query->where('a.playlist_id = "'.(int) $id.'"');
		$query->order('a.ordering ASC');


		//execute the sql
		$db->setQuery((string)$query);
		$songs = $db->loadObjectList();

		$document->addScript('administrator/components/com_vombiemusic/assets/playlist.js', 'text/javascript');
		$document->addScript('administrator/components/com_vombiemusic/assets/cwcomplete.js', 'text/javascript');
		$document->addStyleSheet('administrator/components/com_vombiemusic/assets/cwcomplete.css','text/css');
		$document->addScript('administrator/components/com_vombiemusic/assets/redips-drag.js','text/javascript');

		$document->addScriptDeclaration('
		//Variables for vombiemusic
		var playlist_id = "'.JRequest::getVar('id').'";
		var token = "'.JUtility::getToken().'";
window.addEvent(\'domready\',function() {

ac2 = new CwAutocompleter( \'ajaxSongName\', \'index.php?option=com_vombiemusic&task=ajaxSearchSongs&format=raw&\',
		{
			targetfieldForKey: \'ajaxSongId\',
			onChoose: function(selection) {
				//selection.key: is set by the cwcompleter
				ajaxNewSave(playlist_id, selection.key, token, $(\'ajaxSongId\'), $(\'ajaxSongName\'))
			}
		}
	);

}); 
		');
		
		$document->addStyleSheet(JURI::root( true ).'/administrator/components/com_vombiemusic/assets/playlist.css');
		//I'm lazy
		if ($songs && $id != '')
		{
			$html .= '
<div id="message"></div>
<form action="index.php?option=com_vombiemusic&task=UpdateOrderingPlaylist" action="post">
<div class="allSongs" id="allSongs"></div>
<div class="record" id="songNameBox"><input type="text" id="ajaxSongName" name="ajaxSongName" /></div>
</form>';
		
		} 
		else if (!$id)
		{
			$html = "<div id=\"message-box\">".JText::_('VOMBIEMUSIC_SAVE_AND_REOPEN')."</div>";
		}
		else {
			$html .='<div class="allSongs" id="allSongs"></div>
			<div class="record" id="songNameBox"><input type="text" id="ajaxSongName" name="ajaxSongName" /></div>';

		}
	return $html;
	}
}