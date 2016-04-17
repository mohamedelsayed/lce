<div class="subscribers form">
<?php 
echo $this->Form->create('Subscriber', array('type'=>'file'));?>
<fieldset>
    <legend><?php __('Edit Subscriber'); ?></legend>
    <div id="form">
		<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('email');
		echo $this->Form->input('phone');
		echo $this->Form->input('job');
		//echo $this->Form->input('user_id',array('type'=>'hidden'));		
		?>
    </div>
</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Subscriber.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Subscriber.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Subscribers', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('New Subscriber', true), array('action' => 'add')); ?></li>
	</ul>
</div>