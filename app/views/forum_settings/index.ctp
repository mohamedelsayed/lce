<?php global $base_url;?>
<div class="settings form">
<?php echo $this->Form->create('Setting', array('url' => $base_url.'/forum_settings'));?>
	<fieldset>
 		<legend><?php __('Settings'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('color1', array('label' => 'Public Events Color'));
		echo $this->Form->input('color2', array('label' => 'Community Events Color'));
		echo $this->Form->input('color3', array('label' => 'Community Meetings Color'));?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<script type="text/javascript">
jQuery('#SettingColor1').colorPicker();
jQuery('#SettingColor2').colorPicker();
jQuery('#SettingColor3').colorPicker();
</script>