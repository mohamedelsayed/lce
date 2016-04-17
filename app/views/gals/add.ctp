<div class="gals form">
<?php echo $this->Form->create('Gal');?>
	<fieldset>
 		<legend><?php __('Add Gal'); ?></legend>
	<?php
		echo $this->Form->input('caption', array('class'=>'ckeditor'));
		echo $this->Form->input('image');
		echo $this->Form->input('article_id');
		echo $this->Form->input('event_id');
		echo $this->Form->input('album_id');
		echo $this->Form->input('doc_id');
		echo $this->Form->input('header');
		echo $this->Form->input('star_id');
		echo $this->Form->input('poll_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Gals', true), array('action' => 'index'));?></li>
	</ul>
</div>