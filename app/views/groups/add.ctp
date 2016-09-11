<div class="groups form">
<?php echo $this->Form->create('Group', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Add Group'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('weight', array('value'=> 0));
		echo $this->Form->input('approved');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Groups', true), array('action' => 'index'));?></li>
	</ul>
</div>