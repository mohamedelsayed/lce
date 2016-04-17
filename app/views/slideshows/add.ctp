<div class="slideshows form">
<?php echo $this->Form->create('Slideshow', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Add Slideshow'); ?></legend>
	<?php
		echo $form->input('image', array('type'=>'file', 'label'=>'Image'));
		echo $this->Form->input('link');
		$target_attributes = array('value' => 0, 'legend'=>'Target');
		echo $form->radio('target',$target_options, $target_attributes);
		echo $this->Form->input('approved');
		echo $this->Form->input('weight');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Slideshows', true), array('action' => 'index'));?></li>
	</ul>
</div>