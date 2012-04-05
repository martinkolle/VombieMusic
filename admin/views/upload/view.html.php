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
		$document = JFactory::getDocument();
		if(JRequest::getVar('tpl') == 'files'):
			$tpl = 'files';
		else:
		$document = JFactory::getDocument();
		$document->addStyleDeclaration('
#filedrag
{
	display: none;
	font-weight: bold;
	text-align: center;
	padding: 1em 0;
	margin: 1em 0;
	color: #555;
	border: 2px dashed #555;
	border-radius: 7px;
	cursor: default;
}
#filedrag.hover
{
	color: #f00;
	border-color: #f00;
	border-style: solid;
	box-shadow: inset 0 3px 4px #888;
}
#progress p
{
	display: block;
	width: 99%;
	min-height:20px;
	vertical-align:center;
	padding: 2px 5px;
	margin: 3px;
	border: 1px inset #446;
	border-radius: 5px;
	background: #eee url("components/com_vombiemusic/assets/images/progress.png") 100% 0 repeat-y;
}

#progress p.success
{
	background: #0c0 none 0 0 no-repeat;
}

#progress p.failure
{
	background: #FF0000 none 0 0 no-repeat;
}
.uploaded_image{width:100px;height:100px}

','text/css');
		endif;
		// Display the template
		parent::display($tpl);
	}
}