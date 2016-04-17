<div class="gals form">
<?php echo $this->Form->create('Gal', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Edit Gal'); ?></legend>
	<?php
		echo $this->Form->input('id');
		//echo $this->Form->input('photo_credit');
		echo $this->Form->input('caption', array('class'=>'ckeditor'));
		//echo $this->Form->input('image');
		echo $this->element('backend/image_view', array('image'=>array('id'=>$this->data['Gal']['id'], 'image'=>$this->data['Gal']['image']), 'size'=>'master'));
		echo $this->Form->input('image', array('type'=>'file', 'label'=>'Image'));
		
		//echo $this->Form->input('article_id');
		//echo $this->Form->input('first_image');
		//echo $this->Form->input('event_id');
		//echo $this->Form->input('album_id');
		//echo $this->Form->input('doc_id');
		//echo $this->Form->input('header');
		//echo $this->Form->input('star_id');
		//echo $this->Form->input('poll_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Gal.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Gal.id'))); ?></li>
		<li><?php //echo $this->Html->link(__('List Gals', true), array('action' => 'index'));?></li>
	</ul>
</div>