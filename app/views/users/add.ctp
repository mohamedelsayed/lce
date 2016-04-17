<div class="users form">
<?php echo $this->Form->create('User', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('name');
		$options=array('1'=>'Male','0'=>'Female');
		$attributes=array('value'=>1, 'legend'=>'Gender');
		echo $form->radio('gender',$options,$attributes);
		echo $this->Form->input('email');
		echo $form->input('image', array('type'=>'file'));
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		//echo $this->Form->input('group_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Users', true), array('action' => 'index'));?></li>
	</ul>
</div>