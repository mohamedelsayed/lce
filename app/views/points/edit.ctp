<div class="points form">
<?php echo $this->Form->create('Point', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Edit Point'); ?></legend>
	<?php
		echo $this->Form->input('id');
        echo $this->Form->input('title', array("label" => $titleLabel));
        //echo $this->Form->input('title_ar', array("label" => $titleLabel));
        echo $this->Form->input('Point.body', array('class'=>'ckeditor'));
        //echo $this->Form->input('Point.body_ar', array('class'=>'ckeditor'));
		echo $this->element('backend/image_view', array('image'=>array('id'=>$this->data['Point']['id'], 'image'=>$this->data['Point']['image']), 'size'=>'master'));
		echo $form->input('image', array('type'=>'file', 'label'=>'Image'));
		echo $this->Form->input('weight');
		echo $this->Form->input('approved');		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->point('Point.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Point.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Points', true), array('action' => 'index'));?></li>
	</ul>
</div>