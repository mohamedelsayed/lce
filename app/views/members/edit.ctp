<div class="members form">
<?php echo $this->Form->create('Member', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Edit Member'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('fullname');
		//$options=array('1'=>'Male','0'=>'Female');
		//$attributes=array('value'=>$this->data['Member']['gender'], 'legend'=>'Gender');
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
			if($this->data['Member']['id'] == $userInfoFront['id']){
				echo $this->Form->input('role', array('type' => 'hidden'));		
			}else{
				echo $this->Form->input('role', array('type' => 'select', 'options' => $roles));
			}
		}else{
			echo $this->Form->input('role', array('type' => 'hidden'));			
		}?>
		<div class="input forum_image_view forum_image_view_forum">
			<?php echo $this->element('forum/image_view', array('controller'=>'members', 'image'=>array('id'=>$this->data['Member']['id'], 'image'=>$this->data['Member']['image'])));?>
		</div>
		<?php echo $this->Form->input('image', array('type'=>'file'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<?php /*<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Member.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Member.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Members', true), array('action' => 'index'));?></li>
	</ul>
</div>*/?>