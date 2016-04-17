<div class="articles form">
<?php echo $this->Form->create('Subscriber', array('type'=>'file'));?>
<fieldset>
    <legend><?php __('Add Subscriber'); ?></legend>
    <div id="form">
		<?php
		echo $this->Form->input('name');
		echo $this->Form->input('email');
		echo $this->Form->input('phone');
		echo $this->Form->input('job');
		//echo $this->Form->input('user_id');		
		?>
    </div>
</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Subscribers', true), array('action' => 'index'));?></li>
	</ul>
</div>