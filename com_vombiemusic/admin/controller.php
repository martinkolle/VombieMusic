<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla controller library
jimport('joomla.application.component.controller');
 
 /**
 	This will set the standard view and add submenu to backend,
 	And ofcourse execute the view!
 **/
class VombieMusicController extends JController
{
	/**
	 * display task
	 *
	 * @return void
	 */
	function display($cachable = false) 
	{

		// set default view if not set
		JRequest::setVar('view', JRequest::getCmd('view', 'cpanel'));
		VombieMusicHelper::addSubmenu(JRequest::getCmd('view', 'cpanel'));
 
		// call parent behavior
		parent::display($cachable);
	}

/**
	Ajax update of the ordering
	@edited martiinkolle.dk
*/
	function ajaxOrderingPlaylist() {
	
		JRequest::checkToken('get') or die( 'Invalid Token' );

		$db 	= JFactory::getDBO();
		$id 	= JRequest::getInt('id');
		$order 	= JRequest::getInt('order');

		if($id && $order){	
			$db->setQuery(" UPDATE #__vombiemusic_song_playlist 
							SET ordering = ".$order."
							WHERE id =".$id );
		}

		if (!$db->query()){
			JError::raiseError(500, $db->getErrorMsg() );
		}

	}

/**
	Delete song from playlist
	@deletes the record from the database
	@TODO: Token and security
*/

	function ajaxDeletePlaylistSong(){
		
		JRequest::checkToken('get') or die( JText::_('Invalid Token'));

		$db 		= JFactory::getDBO();
		$delete_id 	= JRequest::getVar('delete');
		if ($delete_id)
			{
				$db->setQuery('DELETE FROM #__vombiemusic_song_playlist WHERE id = '.(int)$delete_id);
			}
		
		if (!$db->query())
		{
			JError::raiseError(500, $db->getErrorMsg() );
		}

	}

	function ajaxNewPlaylistSong(){

	JRequest::checkToken('get') or die( JText::_('Invalid Token'));

		$db 		= JFactory::getDBO();
		$query 		= $db->getQuery(true);
		$playlist_id= JRequest::getVar('playlist_id');
		$song_id 	= JRequest::getVar('song_id');
		$html 		= null;
		$loadSongs	= JRequest::getInt('loadsongs');
		$document 	= JFactory::getDocument();


		if ($playlist_id && $song_id){
			$query->select('y.id');
			$query->from('#__vombiemusic_song AS y');
			$query->where('y.id = "'.$song_id.'"');
			$db->setQuery((string)$query);
			$db->query();
			$num_rows = $db->getNumRows();

			if($num_rows > 0){
				$db->setQuery("
				INSERT INTO #__vombiemusic_song_playlist 
				(id,playlist_id,song_id)
				VALUES ('','".$playlist_id."','".$song_id."')
				");
			} else{
				$html .= JText::_('COM_VOMBIEMUSIC_NO_SONG_FOUND');
			}
		}

		if ($db->query() || $loadSongs == '1'){
			$query->select('a.id AS playlistId,a.song_id,a.playlist_id,a.ordering');
			$query->from('#__vombiemusic_song_playlist AS a');

			$query->select('b.id,b.name,b.artist,b.published');
			$query->join('LEFT', '#__vombiemusic_song AS b ON b.id = a.song_id');

			$query->where('a.playlist_id = '.(int)$playlist_id);
			$query->order('a.ordering');

			//execute the sql
			$db->setQuery((string)$query);
			$songs = $db->loadObjectList();
			$style = "color:#f00 !important; display:block; width:40px; float:right; padding-left:10px; padding-top:1px;";
				
			if($songs){
				foreach($songs as $song){
				$html .= '
					<div class="record" id="record-'.$song->playlistId.'">
						<a onclick="deleteSongPlaylist('.$song->playlistId.',$(\''.$song->playlistId.'\'))" id="'.$song->playlistId.'" class="ajaxDelete" style="'.$style.'">Delete</a>
        				<strong>'.$song->name.'</strong>
						<span style="float:right;">
						<input type="text" class="sortorder" id="'.$song->playlistId.'" onchange="ordering('.$song->playlistId.',this.value)" name="'.$song->playlistId.'" value="'.$song->ordering.'" />
					</span>
					</div>';
				}

			}
			else{ 
				$html .= JText::_('COM_VOMBIEMUSIC_NO_SONGS_IN_PLAYLIST');
			}

			//problems with request.html
			//$html .='<div class="record" id="songNameBox"><input type="text" id="ajaxSongName" name="ajaxSongName" /></div>';
		}

		if (!$db->query()){
			JError::raiseError(500, $db->getErrorMsg());
		}

	echo $html;

	}

/*
	Simple ajax search system
	@Used 		for the playlist system.
	@TODO: 		just add token system for security reason
	@return 	simple json <- not json at all...
*/

	function ajaxSearchSongs(){

		//JRequest::checkToken('get') or die( JText::_('Invalid Token'));

		$db = JFactory::getDBO();
		$min = 3;
		$max = 50;
		$choices = 10;
		$search = (string) stripslashes(strip_tags(JRequest::getVar('search')));

		$query = "SELECT DISTINCT name,id,info FROM #__vombiemusic_song WHERE name LIKE '%".mysql_escape_string($search)."%' LIMIT $choices";
		$db->setQuery($query);
		$rows = $db->loadAssocList();
		$count = count($rows);
		$current = 0;

		/*This will retun a simple json document for th search*/
		header('Content-type: application/json');
		echo "[ ";
		foreach ($rows as $row)
		{
			echo '["'.$row["id"].'", "'.$row['name'].'"]';

			if (++$current < $count):
				echo ','; 
    		endif;

		}
		echo " ]";
	}

	function playlistSongs()
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

		$document->addScript('components/com_vombiemusic/assets/playlist.js', 'text/javascript');
		$document->addScript('components/com_vombiemusic/assets/cwcomplete.js', 'text/javascript');
		$document->addStyleSheet('components/com_vombiemusic/assets/cwcomplete.css','text/css');
		$document->addScript('components/com_vombiemusic/assets/redips-drag.js','text/javascript');

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
	echo $html;
	}
}

