<div class="coaches form">
<?php echo $this->Form->create('Coach', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Add Coach'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('statement', array('maxLength' => $statement_limit));?>
		<div id="statement_remain" class="characters_remain"></div>
		<?php echo $this->Form->input('biography', array('maxLength' => $biography_limit));?>
		<div id="biography_remain" class="characters_remain"></div>
		<?php echo $form->input('image', array('type'=>'file', 'label'=>'Image'));
		$options = $gender_options;
		$attributes = array('value' => 0, 'legend'=>'Gender');
		echo $form->radio('gender', $options, $attributes);
		echo $this->Form->input('email');
		echo $this->Form->input('facebook');
		echo $this->Form->input('linkedin');
		echo $form->input('video_file', array('type'=>'file', 'label'=>'Video File'));
		echo $this->Form->input('mobile');				
		include_once 'specializations.php';
		include_once 'geographys.php';					
		echo $this->Form->input('remote_coaching');
		echo $this->Form->input('approved');
		echo $this->Form->input('weight', array('value'=> 0));?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Coaches', true), array('action' => 'index'));?></li>
	</ul>
</div>