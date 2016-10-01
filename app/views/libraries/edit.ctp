<div class="libraries form">
<?php echo $this->Form->create('Library', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Edit Library'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title', array("label" => 'Title'));
		echo $this->Form->input('module', array('options' => $forum_modules_types));
		echo $this->Form->input('type', array('options' => $forum_libraries_types));
		echo $this->Form->input('google_drive_url', array('type' => 'text'));
		echo $this->Form->input('youtube_url', array('type' => 'text'));
		echo $this->Form->input('weight');
		echo $this->Form->input('approved');			
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>