<div class="cats form">
<?php echo $this->Form->create('Category', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Edit Category'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title', array("label" => 'Title'));
		//echo $this->Form->input('parent_id',array('empty'=>''));
		//echo $this->Html->image("backend/loader.gif", array('id'=>'loader', 'style'=> 'display: none', 'border' => '0'));
		echo $this->Form->input('weight');
		echo $this->Form->input('approved');			
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>