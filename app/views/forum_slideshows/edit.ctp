<div class="slideshows form">
<?php echo $this->Form->create('Slideshow', array('type'=>'file', 'url' => $base_url.'/forum_slideshows/edit/'.$this->data['Slideshow']['id']));?>
	<fieldset>
 		<legend><?php __('Edit Slideshow'); ?></legend>
	<?php
		echo $this->Form->input('id');
		if(isset($this->data['Slideshow']['image'])){
			echo $this->element('forum/image_view', array('image'=>array('id'=>$this->data['Slideshow']['id'], 'image'=>$this->data['Slideshow']['image']), 'size'=>'master'));
		}
		echo $form->input('image', array('type'=>'file', 'label'=>'Image <span style="color: red">(width must be at least 1200px)</span>'));
		echo $this->Form->input('link');
		$target_attributes = array('value' => $this->data['Slideshow']['target'], 'legend'=>'Target');
		echo $form->radio('target',$target_options, $target_attributes);
		echo $this->Form->input('approved');
		echo $this->Form->input('weight');
		echo $this->Form->input('forum_flag', array('type' => 'hidden'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Slideshow.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Slideshow.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Slideshows', true), array('action' => 'index'));?></li>
	</ul>
</div>