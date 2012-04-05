<?php

defined('_JEXEC') or die;
JToolBarHelper::title(JText::_('COM_VOMBIEMUSIC_VIEW_UPLOAD'));

?>
<form id="upload" action="index.php?option=com_vombiemusic&task=uploadFile&tmpl=component" method="POST" enctype="multipart/form-data">
<input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="30000000" />
<div>
	<div id="filedrag">Drop files here</div>
</div>
<div id="submitbutton">
	<input type="file" id="fileselect" name="fileselect[]" multiple="multiple" />
	<button type="submit">Upload Files</button>
</div>
</form>
<div id="progress"></div>
<div id="messages"></div>
<script type="text/javascript" src="components/com_vombiemusic/assets/filedrag.js"></script>

<?php
	echo $this->loadTemplate('files');