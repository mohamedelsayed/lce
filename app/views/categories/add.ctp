<?php /*echo $this->Javascript->link('forum/ajax/get_categories', false); ?>
<script type="text/javascript">
$(document).ready(function(){	
	//Get categories by Mohamed Elsayed.	
	$("#CategoryParentId").change(function(){	
		getCategories($(this), 'Category', 'parent_id', '');
	});
});
</script>*/?>
<div class="categories form">
<?php echo $this->Form->create('Category', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Add Category'); ?></legend>
	<?php
		echo $this->Form->input('title', array("label" => 'Title'));
		echo $this->Form->input('parent_id',array('empty'=>''));
		//echo $this->Html->image("backend/loader.gif", array('id'=>'loader', 'style'=> 'display: none', 'border' => '0'));
		echo $this->Form->input('weight', array('default'=>0));
		echo $this->Form->input('approved');	
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<?php /*<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Categories', true), array('action' => 'index'));?></li>
		<li><?php //echo $this->Html->link(__('List Artists', true), array('controller' => 'artists', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Artist', true), array('controller' => 'artists', 'action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Categories', true), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Parent Cat', true), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Nodes', true), array('controller' => 'nodes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Node', true), array('controller' => 'nodes', 'action' => 'add')); ?> </li>
	</ul>
</div>*/?>