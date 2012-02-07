<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
class VombieMusicViewUpload extends JView
{

	public function display($tpl = null) 
	{
 		// Check for errors.
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}

		JToolBarHelper::title(JText::_('COM_VOMBIEMUSIC_VIEW_UPLOAD'));

		//get the hosts name
		jimport('joomla.environment.uri' );
		$host = JURI::root();
 
		$document =& JFactory::getDocument();
		$document->addScript($host.'administrator/components/com_vombiemusic/swfupload/swfupload.js');
		$document->addScript($host.'administrator/components/com_vombiemusic/swfupload/swfupload.queue.js');
		$document->addScript($host.'administrator/components/com_vombiemusic/swfupload/fileprogress.js');
		$document->addScript($host.'administrator/components/com_vombiemusic/swfupload/handlers.js');
		$document->addStyleSheet($host.'administrator/components/com_vombiemusic/swfupload/default.css');

		//when we send the files for upload, we have to tell Joomla our session, or we will get logged out 
$session = & JFactory::getSession();
 
$swfUploadHeadJs ='
var swfu;
 
window.onload = function()
{
 
var settings = 
{
        //this is the path to the flash file, you need to put your components name into it
	flash_url : "'.$host.'administrator/components/com_vombiemusic/swfupload/swfupload.swf",
 
        //we can not put any vars into the url for complicated reasons, but we can put them into the post...
        upload_url: "index.php",
	post_params: 
	{
		"option" : "com_vombiemusic",
		"controller" : "upload",
		"view" : "upload",
		"task" : "upload",
		/*"id" : "'.$myItemObject->id.'",*/
		"'.$session->getName().'" : "'.$session->getId().'",
		"format" : "raw"
	}, 
        //you need to put the session and the "format raw" in there, the other ones are what you would normally put in the url
	file_size_limit : "5 MB",
        //client side file chacking is for usability only, you need to check server side for security
	file_types : "*.jpg;*.jpeg;*.gif;*.png",
	file_types_description : "All Files",
	file_upload_limit : 100,
	file_queue_limit : 100,
	custom_settings : 
	{
		progressTarget : "fsUploadProgress",
		cancelButtonId : "btnCancel"
	},
	debug: false,
 
	// Button settings
	button_image_url: "'.$host.'administrator/components/com_vombiemusic/swfupload/images/TestImageNoText_65x29.png",
	button_width: "85",
	button_height: "29",
	button_placeholder_id: "spanButtonPlaceHolder",
	button_text: \'<span class="theFont">Choose Files</span>\',
	button_text_style: ".theFont { font-size: 13; }",
	button_text_left_padding: 5,
	button_text_top_padding: 5,
 
	// The event handler functions are defined in handlers.js
	file_queued_handler : fileQueued,
	file_queue_error_handler : fileQueueError,
	file_dialog_complete_handler : fileDialogComplete,
	upload_start_handler : uploadStart,
	upload_progress_handler : uploadProgress,
	upload_error_handler : uploadError,
	upload_success_handler : uploadSuccess,
	upload_complete_handler : uploadComplete,
	queue_complete_handler : queueComplete	// Queue plugin event
};
swfu = new SWFUpload(settings);
};
 
';
 
//add the javascript to the head of the html document
$document->addScriptDeclaration($swfUploadHeadJs);

		// Display the template
		parent::display($tpl);
	}
}