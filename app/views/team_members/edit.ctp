<div class="teamMembers form">
<?php echo $this->Form->create('TeamMember', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Edit Member'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('position');
		echo $this->Form->input('TeamMember.biography', array('class'=>'ckeditor'));
		echo $this->element('backend/image_view', array('image'=>array('id'=>$this->data['TeamMember']['id'], 'image'=>$this->data['TeamMember']['image']), 'size'=>'master'));
		echo $form->input('image', array('type'=>'file', 'label'=>'Image'));
		echo $this->Form->input('mail');
		echo $this->Form->input('linkedin');
		$type_attributes = array('value' => $this->data['TeamMember']['type'], 'legend'=>'Type');
		echo $form->radio('type',$type_options, $type_attributes);
		echo $this->Form->input('approved');
		echo $this->Form->input('weight');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('TeamMember.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('TeamMember.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Members', true), array('action' => 'index'));?></li>
	</ul>
</div>