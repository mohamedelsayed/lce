<div class="comments form">
<?php echo $this->Form->create('Comment');?>
	<fieldset>
 		<legend><?php __('Add Comment'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('body');
		echo $this->Form->input('approved');
		//echo $this->Form->input('member_id');
		echo $this->Form->input('article_id');
		//echo $this->Form->input('advice_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Comments', true), array('action' => 'index'));?></li>
		<li><?php //echo $this->Html->link(__('List Members', true), array('controller' => 'members', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Member', true), array('controller' => 'members', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Articles', true), array('controller' => 'articles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Article', true), array('controller' => 'articles', 'action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Advices', true), array('controller' => 'advices', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Advice', true), array('controller' => 'advices', 'action' => 'add')); ?> </li>
	</ul>
</div>