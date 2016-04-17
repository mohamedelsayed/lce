<div class="testimonials form">
<?php echo $this->Form->create('Testimonial', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Edit Testimonial'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('position');
		echo $this->Form->input('Testimonial.body', array('class'=>'ckeditor'));
		echo $this->element('backend/image_view', array('image'=>array('id'=>$this->data['Testimonial']['id'], 'image'=>$this->data['Testimonial']['image']), 'size'=>'master'));
		echo $form->input('image', array('type'=>'file', 'label'=>'Image'));
		echo $this->Form->input('approved');
		echo $this->Form->input('featured');
		echo $this->Form->input('weight');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Testimonial.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Testimonial.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Testimonials', true), array('action' => 'index'));?></li>
	</ul>
</div>