<div class="events form events_form">
<?php echo $this->Form->create('Event', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Edit Event'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('Event.brief', array('class'=>'ckeditor'));
		echo $this->element('forum/image_view', array('image'=>array('id'=>$this->data['Event']['id'], 'image'=>$this->data['Event']['image']), 'size'=>'master'));
		echo $form->input('image', array('type'=>'file', 'label'=>'Flyer'));
		echo $this->Form->input('location');
		echo $this->Form->input('start_date');
		echo $this->Form->input('duration');
		echo $this->Form->input('time_from');
		echo $this->Form->input('time_to');
		echo $this->Form->input('ticket_price');
		//echo $this->Form->input('number_of_participants');
		//echo $this->Form->input('instructor_id');
		include_once 'instructors.php';
		echo $this->Form->input('approved');
		echo $this->Form->input('weight');
		//echo $this->Form->input('fully_booked');
		echo $this->Form->input('type', array('type' => 'hidden'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>