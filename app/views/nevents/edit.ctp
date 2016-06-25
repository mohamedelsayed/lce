<div class="nevents form">
<?php echo $this->Form->create('Nevent', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Edit Event'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('Nevent.description', array('class'=>'ckeditor'));
		echo $this->element('backend/image_view', array('image'=>array('id'=>$this->data['Nevent']['id'], 'image'=>$this->data['Nevent']['image']), 'size'=>'master'));
		echo $form->input('image', array('type'=>'file', 'label'=>'Image'));
		echo $this->Form->input('location');
		echo $this->Form->input('start_date');
		echo $this->Form->input('duration');
		echo $this->Form->input('time_from');
		echo $this->Form->input('time_to');
		echo $this->Form->input('ticket_price');
		echo $this->Form->input('number_of_participants');
		//echo $this->Form->input('instructor_id');
		include_once 'instructors.php';
		echo $this->Form->input('approved');
		echo $this->Form->input('weight');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Nevent.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Nevent.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Events', true), array('action' => 'index'));?></li>
	</ul>
</div>