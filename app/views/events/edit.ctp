<div class="events form events_form">
<?php echo $this->Form->create('Event', array('type'=>'file'));?>
<fieldset>
 		<legend><?php __('Edit Event'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('Event.brief', array('class'=>'ckeditor'));
		$image = '';
		if(isset($this->data['Event']['image'])){
			$image = $this->data['Event']['image'];
		}
		echo $this->element('forum/image_view', array('image' => array('id' => $this->data['Event']['id'], 'image' => $image), 'size' => 'master'));
		echo $form->input('image', array('type'=>'file', 'label'=>'Flyer'));
		echo $this->Form->input('location');
		echo $this->Form->input('from_date');
		echo $this->Form->input('to_date');
		echo $this->Form->input('duration');
		echo $this->Form->input('time_from');
		echo $this->Form->input('time_to');
		echo $this->Form->input('ticket_price');
		//echo $this->Form->input('number_of_participants');
		//echo $this->Form->input('instructor_id');
		include_once 'instructors.php';
		if($this->data['Event']['type'] == 2){
			echo $this->Form->input('agenda_word_file', array('type' => 'text'));
			echo $this->Form->input('minutes_of_meeting_file', array('type' => 'text'));
			echo $this->Form->input('p_and_l_sheet', array('type' => 'text'));
		}
		echo $this->Form->input('approved');
		echo $this->Form->input('weight');
		//echo $this->Form->input('fully_booked');
		echo $this->Form->input('type', array('type' => 'hidden'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>