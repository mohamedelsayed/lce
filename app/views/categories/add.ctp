<div class="categories form">
<?php echo $this->Form->create('Category', array('type'=>'file', 'url' => $actual_link));?>
	<fieldset>
 		<legend><?php __('Add Category'); ?></legend>
	<?php
		echo $this->Form->input('title', array("label" => 'Title'));
		//echo $this->Form->input('parent_id',array('empty'=>''));
		//echo $this->Html->image("backend/loader.gif", array('id'=>'loader', 'style'=> 'display: none', 'border' => '0'));
		echo $this->Form->input('weight', array('default'=>0));
		echo $this->Form->input('approved');	
		echo $this->Form->input('type', array('type' => 'hidden', 'value' => $type));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>