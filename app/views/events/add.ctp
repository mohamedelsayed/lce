<div class="events form events_form">
<?php echo $this->Form->create('Event', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Add Event'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('Event.brief', array('class'=>'ckeditor'));
		echo $form->input('image', array('type'=>'file', 'label'=>'Flyer'));
		echo $this->Form->input('location');
		echo $this->Form->input('from_date');
		echo $this->Form->input('to_date');
		//echo $this->Form->input('duration', array('value'=> 1));
		echo $this->Form->input('time_from');
		echo $this->Form->input('time_to');
		echo $this->Form->input('ticket_price', array('value'=> 0));
		//echo $this->Form->input('number_of_participants');
		include_once 'instructors.php';
		if($type == 2){
			echo $this->Form->input('agenda_word_file', array('type' => 'text'));
			echo $this->Form->input('minutes_of_meeting_file', array('type' => 'text'));
			echo $this->Form->input('p_and_l_sheet', array('type' => 'text'));
			include_once 'images.php';
		}
		echo $this->Form->input('approved');
		echo $this->Form->input('weight', array('value'=> 0));
		//echo $this->Form->input('fully_booked');
		echo $this->Form->input('type', array('value'=> $type, 'type' => 'hidden'));?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>