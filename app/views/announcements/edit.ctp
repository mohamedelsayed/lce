<div class="announcements form">
<?php echo $this->Form->create('Announcement', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Edit Announcement'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title', array("label" => 'Title'));
		echo $this->Form->input('Announcement.body', array('class'=>'ckeditor'));
		echo $this->Form->input('weight');
		echo $this->Form->input('approved');?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>