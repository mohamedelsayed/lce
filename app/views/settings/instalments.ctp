<div class="settings form">
<?php echo $this->Form->create('Setting');?>
	<fieldset>
 		<legend><?php __('Edit SettingS'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('number_of_instalments');
		echo $this->Form->input('value_for_each_installment');?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>