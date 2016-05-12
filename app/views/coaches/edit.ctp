<div class="coaches form">
<?php echo $this->Form->create('Coach', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Edit Coach'); ?></legend>
	<?php echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('statement', array('maxLength' => $statement_limit));?>
		<div id="statement_remain" class="characters_remain"></div>
		<?php echo $this->Form->input('biography', array('maxLength' => $biography_limit));?>
		<div id="biography_remain" class="characters_remain"></div>
		<?php if(isset($this->data['Coach']['image'])){
			if($this->data['Coach']['image'] != ''){				
				echo $this->element('backend/image_view', array('image'=>array('id' => $this->data['Coach']['id'], 'image' => $this->data['Coach']['image']), 'size' => 'master'));
			}
		}
		echo $form->input('image', array('type'=>'file', 'label'=>'Image'));
		$options = $gender_options;
		$attributes = array('value' => $this->data['Coach']['gender'], 'legend'=>'Gender');
		echo $form->radio('gender', $options, $attributes);
		echo $this->Form->input('email');
		echo $this->Form->input('facebook');
		echo $this->Form->input('linkedin');
		if(isset($this->data['Coach']['video_file'])){
			if($this->data['Coach']['video_file'] != ''){				
				echo $this->element('backend/video_player_view', array('video' => array('file' => $this->data['Coach']['video_file'], 'image' => '', 'title' => ''), 'width' => 300, 'height' => 250));
			}
		}
		echo $form->input('video_file', array('type'=>'file', 'label'=>'Video File'));
		echo $this->Form->input('mobile');
		echo $this->Form->input('remote_coaching');
		echo $this->Form->input('approved');
		echo $this->Form->input('weight');?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Coach.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Coach.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Coaches', true), array('action' => 'index'));?></li>
	</ul>
</div>