<div class="teamMembers form">
<?php echo $this->Form->create('TeamMember', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Add Member'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('position');
		echo $this->Form->input('TeamMember.biography', array('class'=>'ckeditor'));
		echo $form->input('image', array('type'=>'file', 'label'=>'Image'));
		echo $this->Form->input('mail');
		echo $this->Form->input('linkedin');
		$type_attributes = array('value' => 0, 'legend'=>'Type');
		echo $form->radio('type',$type_options, $type_attributes);
		echo $this->Form->input('approved');
		echo $this->Form->input('weight');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Members', true), array('action' => 'index'));?></li>
	</ul>
</div>