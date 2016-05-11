<div class="instructors form">
<?php echo $this->Form->create('Instructor', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Add Instructor'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('position');
		echo $this->Form->input('Instructor.biography', array('class'=>'ckeditor'));
		echo $form->input('image', array('type'=>'file', 'label'=>'Image'));
		echo $this->Form->input('mail');
		echo $this->Form->input('facebook');
		echo $this->Form->input('linkedin');
		echo $this->Form->input('approved');
		echo $this->Form->input('weight', array('value'=> 0));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Instructors', true), array('action' => 'index'));?></li>
	</ul>
</div>