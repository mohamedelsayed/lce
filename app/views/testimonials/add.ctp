<div class="testimonials form">
<?php echo $this->Form->create('Testimonial', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Add Testimonial'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('position');
		echo $this->Form->input('Testimonial.body', array('class'=>'ckeditor'));
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

		<li><?php echo $this->Html->link(__('List Testimonials', true), array('action' => 'index'));?></li>
	</ul>
</div>