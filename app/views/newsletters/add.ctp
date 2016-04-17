<div class="articles form">
<?php echo $this->Form->create('Newsletter', array('type'=>'file'));?>
<fieldset>
    <legend><?php __('Add Newsletter'); ?></legend>
    <div id="form">
		<?php
		//echo $this->Form->input('user_id', array('label'=>'To'));
		echo $this->Form->input('from_name');
		echo $this->Form->input('from_email', array());
		echo $this->Form->input('subject');
		echo $this->Form->input('Newsletter.body', array('class'=>'ckeditor'));	
		//echo $this->Form->input('use_signature');	
		?>
    </div>
</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Newsletters', true), array('action' => 'index'));?></li>
	</ul>
</div>