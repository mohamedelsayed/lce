<div class="members form">
<?php echo $this->Form->create('Member', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Add Member'); ?></legend>
	<?php
		echo $this->Form->input('fullname');
		//$options=array('1'=>'Male','0'=>'Female');
		//$attributes=array('value'=>1, 'legend'=>'Gender');
		//echo $form->radio('gender',$options,$attributes);
		echo $this->Form->input('email');		
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('mobile');
		echo $this->Form->input('job_title');
		echo $this->Form->input('approved');
		echo $this->Form->input('block_posts_notification');
		echo $this->Form->input('block_comments_notification');
		echo $this->Form->input('block_announcements_notification');
		echo $this->Form->input('block_events_notification');
		if(count($roles) > 1){
			echo $this->Form->input('role', array('type' => 'select', 'options' => $roles));
		}
		echo $form->input('image', array('type'=>'file'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<?php /*<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Members', true), array('action' => 'index'));?></li>
	</ul>
</div>*/?>