<div class="events form">
<?php echo $this->Form->create('Event', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Add Event'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('date');
		echo $this->Form->input('timing');
		echo $this->Form->input('location');
		echo $this->Form->input('agenda');
		if($isAdmin == 1){
			echo $this->Form->input('approved');	
		}else{
			echo $this->Form->input('approved', array('type' => 'hidden', 'value' => 1));			
		}
		echo $this->Form->input('member_id', array('type' => 'hidden', 'value' => $userInfoFront['id']));?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>