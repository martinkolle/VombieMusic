<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
?>
<form action="<?php echo JRoute::_('index.php?option=com_vombiemusic&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="song-form">
 
    <div class="width-60 fltlft">
        <fieldset class="adminform">
            <legend><?php echo JText::_( 'COM_VOMBIEMUSIC_SONG_DETAILS' ); ?></legend>
            <ul class="adminformlist">
<?php foreach($this->form->getFieldset('song') as $field): ?>
                <li><?php echo $field->label;echo $field->input;?></li>
<?php endforeach; ?>
            </ul>
        </fieldset>
    </div>
 
    <div class="width-40 fltlft">
        <fieldset class="adminform">
            <legend><?php echo JText::_( 'COM_VOMBIEMUSICE_PARAMS' ); ?></legend>
            <ul class="adminformlist">
<?php foreach($this->form->getFieldset('params') as $field): ?>
                <li><?php echo $field->label;echo $field->input;?></li>
<?php endforeach; ?>
            </ul>
        </fieldset>
    </div>
     
    <div class="width-40 fltlft">
        <fieldset class="adminform">
            <legend><?php echo JText::_( 'COM_VOMBIEMUSIC_METADATA' ); ?></legend>
            <ul class="adminformlist">
<?php foreach($this->form->getFieldset('metadata') as $field): ?>
                <li><?php echo $field->label;echo $field->input;?></li>
<?php endforeach; ?>
            </ul>
        </fieldset>
    </div>
 
    <div>
        <input type="hidden" name="task" value="song.edit" />
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>
