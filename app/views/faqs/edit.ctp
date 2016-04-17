<div class="	s form">
<?php echo $this->Form->create('Faq');?>
	<fieldset>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('question');
		//echo $this->Form->input('answer');
		echo $this->Form->input('Faq.answer', array('class'=>'ckeditor'));
		echo $this->Form->input('approved');
		echo $this->Form->input('weight');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Faqs', true), array('action' => 'index'));?></li>
	</ul>
</div>