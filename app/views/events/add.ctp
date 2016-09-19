<div class="events form events_form">
<?php echo $this->Form->create('Event', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Add Event'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('Event.brief', array('class'=>'ckeditor'));
		echo $form->input('image', array('type'=>'file', 'label'=>'Flyer'));
		echo $this->Form->input('location');
		echo $this->Form->input('start_date');
		echo $this->Form->input('duration');
		echo $this->Form->input('time_from');
		echo $this->Form->input('time_to');
		echo $this->Form->input('ticket_price');
		//echo $this->Form->input('number_of_participants');
		include_once 'instructors.php';
		echo $this->Form->input('approved');
		echo $this->Form->input('weight', array('value'=> 0));
		//echo $this->Form->input('fully_booked');
		echo $this->Form->input('type', array('value'=> $type, 'type' => 'hidden'));?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>