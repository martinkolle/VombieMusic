<?php
defined('_JEXEC') or die;
JToolBarHelper::title(JText::_('COM_VOMBIEMUSIC_VIEW_UPLOAD_FILES'));

$basePath = 'components/com_vombiemusic/uploads/';
	if (file_exists($basePath))
	{
		// Get the list of files and folders from the given folder
		$fileList	= JFolder::files($basePath);
		$folderList = JFolder::folders($basePath);
	}
	foreach($fileList as $file){
		echo '<a onclick="if (window.parent) window.parent.addDocumentUpload(\''.$file.'\')">';
		echo '<img src="'.$basePath.$file.'" style="width:20px;height:20px;">';
		echo $file.'</br>';
		echo '<hr/>';
		echo '</a>';
		echo '<span style="float:right;">Delete</span>';
	}

	foreach($folderList as $folder){
		echo '<a onclick="if (window.parent) window.parent.deleteFolder(\''.$folder.'\')">';
		echo $folder.'</br>';
		echo '<hr/>';
		echo '</a>';
		echo '<span style="float:right;">Delete</span>';
	}

?>
