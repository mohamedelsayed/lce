<div class="slideshows form">
<?php echo $this->Form->create('Slideshow', array('type'=>'file', 'url' => $base_url.'/forum_slideshows/add'));?>
	<fieldset>
 		<legend><?php __('Add Slideshow'); ?></legend>
	<?php
		echo $form->input('image', array('type'=>'file', 'label'=>'Image <span style="color: red">(width must be at least 1200px)</span>'));
		echo $this->Form->input('link');
		$target_attributes = array('value' => 0, 'legend'=>'Target');
		echo $form->radio('target', $target_options, $target_attributes);
		echo $this->Form->input('approved');
		echo $this->Form->input('weight', array('value'=> 0));
		echo $this->Form->input('forum_flag', array('value'=> 1, 'type' => 'hidden'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Slideshows', true), array('action' => 'index'));?></li>
	</ul>
</div>