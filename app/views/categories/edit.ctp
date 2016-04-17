<?php /*echo $this->Javascript->link('forum/ajax/get_categories', false); ?>
<script type="text/javascript">
$(document).ready(function(){	
	//Get categories by Mohamed Elsayed.	
	$("#CategoryParentId").change(function(){	
		getCategories($(this), 'Category', 'parent_id', '');
	});
});
</script>*/?>
<div class="cats form">
<?php echo $this->Form->create('Category', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Edit Category'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title', array("label" => 'Title'));
		echo $this->Form->input('parent_id',array('empty'=>''));
		//echo $this->Html->image("backend/loader.gif", array('id'=>'loader', 'style'=> 'display: none', 'border' => '0'));
		echo $this->Form->input('weight');
		echo $this->Form->input('approved');			
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<?php /*<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Cat.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Cat.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Cats', true), array('action' => 'index'));?></li>
		<li><?php //echo $this->Html->link(__('List Artists', true), array('controller' => 'artists', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Artist', true), array('controller' => 'artists', 'action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Cats', true), array('controller' => 'cats', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Parent Cat', true), array('controller' => 'cats', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Nodes', true), array('controller' => 'nodes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Node', true), array('controller' => 'nodes', 'action' => 'add')); ?> </li>
	</ul>
</div>*/?>