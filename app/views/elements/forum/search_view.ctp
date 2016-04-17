<h2>
	<?php echo "Search:";?>
</h2>
<div style="width: 350px;">
	<?php echo $this->Form->create($currentModel, array('action'=>'index'));
	echo $this->Form->input($currentModel.'.'.$currentField);
	echo $this->Form->end(__('Search', true));
	?>
</div>