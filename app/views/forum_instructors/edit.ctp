<div class="instructors form">
<?php echo $this->Form->create('Instructor', array('type'=>'file', 'url' => $base_url.'/forum_instructors/edit/'.$this->data['Instructor']['id']));?>
	<fieldset>
 		<legend><?php __('Edit Instructor'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('position');
		echo $this->Form->input('Instructor.biography', array('class'=>'ckeditor'));
		echo $this->element('backend/image_view', array('image'=>array('id'=>$this->data['Instructor']['id'], 'image'=>$this->data['Instructor']['image']), 'size'=>'master'));
		echo $form->input('image', array('type'=>'file', 'label'=>'Image'));
		echo $this->Form->input('mail');
		echo $this->Form->input('facebook');
		echo $this->Form->input('linkedin');
		echo $this->Form->input('approved');
		echo $this->Form->input('weight');
		echo $this->Form->input('forum_flag', array('type' => 'hidden'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Instructor.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Instructor.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Instructors', true), array('action' => 'index'));?></li>
	</ul>
</div>