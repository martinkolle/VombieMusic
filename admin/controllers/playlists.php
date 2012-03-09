<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controlleradmin');

class VombieMusicControllerPlaylists extends JControllerAdmin
{
	public function getModel($name = 'Playlist', $prefix = 'VombieMusicModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);

		return $model;
	}
}