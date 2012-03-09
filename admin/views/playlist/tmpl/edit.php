<?php
// No direct access
defined('_JEXEC') or die;
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
?>
<form action="<?php echo JRoute::_('index.php?option=com_vombiemusic&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="VOMB-fIEMUSICorm" class="form-validate">
 
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo JText::_( 'COM_VOMBIEMUSIC_PARAMS' ); ?></legend>
			<ul class="adminformlist">
<?php foreach($this->form->getFieldset('playlist') as $field): ?>
				<li><?php echo $field->label;echo $field->input;?></li>
<?php endforeach; ?>
			</ul>
	</div>
 
	    <div class="width-40 fltlft">
        <fieldset class="adminform">
            <legend><?php echo JText::_( 'COM_VOMBIEMUSIC_PARAMS' ); ?></legend>
            <ul class="adminformlist">
<?php foreach($this->form->getFieldset('params') as $field): ?>
                <li><?php echo $field->label;echo $field->input;?></li>
<?php endforeach; ?>
            </ul>
        </fieldset>
    </div>
     
    <div class="width-40 fltlft">
        <fieldset class="adminform">
            <legend><?php echo JText::_( 'COM_VOMBIEMUSIC_PARAMSS' ); ?></legend>
            <ul class="adminformlist">
<?php foreach($this->form->getFieldset('metadata') as $field): ?>
                <li><?php echo $field->label;echo $field->input;?></li>
<?php endforeach; ?>
            </ul>
        </fieldset>
    </div>
 
	<div>
		<input type="hidden" name="task" value="playlist.edit" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
