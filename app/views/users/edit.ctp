<div class="users form">
<?php echo $this->Form->create('User', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		$options=array('1'=>'Male','0'=>'Female');
		$attributes=array('value'=>$this->data['User']['gender'], 'legend'=>'Gender');
		echo $form->radio('gender',$options,$attributes);
		echo $this->Form->input('email');
		echo $this->element('backend/image_view', array('controller'=>'users', 'image'=>array('id'=>$this->data['User']['id'], 'image'=>$this->data['User']['image'])));
		echo $this->Form->input('image', array('type'=>'file'));
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		/*if ($this->data['User']['group_id'] != 0)
			echo $this->Form->input('group_id');*/
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('User.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('User.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('action' => 'index'));?></li>
	</ul>
</div>