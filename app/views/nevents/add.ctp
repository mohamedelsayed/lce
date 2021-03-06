<div class="nevents form">
<?php echo $this->Form->create('Nevent', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Add Event'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('Nevent.description', array('class'=>'ckeditor'));
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
		echo $this->Form->input('weight', array('value'=> 0));
		echo $this->Form->input('fully_booked');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Events', true), array('action' => 'index'));?></li>
	</ul>
</div>