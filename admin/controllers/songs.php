<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controlleradmin');

class VombieMusicControllerSongs extends JControllerAdmin
{
	public function getModel($name = 'Song', $prefix = 'VombieMusicModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);

		return $model;
	}
}