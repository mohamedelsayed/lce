<div class="values form">
<?php echo $this->Form->create('Value', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Add Value'); ?></legend>
	<?php
		echo $this->Form->input('title', array("label" => $titleLabel));
        //echo $this->Form->input('title_ar', array("label" => $titleLabel));
		echo $this->Form->input('Value.body', array('class'=>'ckeditor'));
        //echo $this->Form->input('Value.body_ar', array('class'=>'ckeditor'));
		echo $form->input('image', array('type'=>'file', 'label'=>'Image'));
        echo $this->Form->input('weight', array('default'=>0));
		echo $this->Form->input('approved');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Values', true), array('action' => 'index'));?></li>	
	</ul>
</div>