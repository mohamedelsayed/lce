<div class="geographys form">
<?php echo $this->Form->create('Geography', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Edit Geography'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title', array("label" => $titleLabel));
		//echo $this->Form->input('date', array('minYear' => $minYearValue,'maxYear' => $maxYearValue));
		//echo $this->Form->input('Geography.body', array('class'=>'ckeditor'));		
		//echo $this->element('backend/image_view', array('image'=>array('id'=>$this->data['Geography']['id'], 'image'=>$this->data['Geography']['image']), 'size'=>'master'));
		//echo $form->input('image', array('type'=>'file', 'label'=>'Image'));
		//echo $this->Form->input('meta_keywords');
		//echo $this->Form->input('meta_description');
		//echo $this->Form->input('artist_id');		
		//echo $this->Form->input('parent_id',array('empty'=>''));
		//echo $this->Html->image("backend/loader.gif", array('id'=>'loader', 'style'=> 'display: none', 'border' => '0'));
		echo $this->Form->input('weight');
		echo $this->Form->input('approved');
		//$options=array('0'=>'Art Work','1'=>'Other');
		//$attributes=array('value'=>$this->data['Geography']['geography_type'], 'legend'=>'Type');
		//echo $form->radio('geography_type',$options,$attributes);
		//echo $this->Form->input('geography_type');		
		//echo $this->Form->input('under_construction');		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Geography.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Geography.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Geographys', true), array('action' => 'index'));?></li>
		<?php /*<li><?php //echo $this->Html->link(__('List Artists', true), array('controller' => 'artists', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Artist', true), array('controller' => 'artists', 'action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Geographys', true), array('controller' => 'geographys', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Parent Geography', true), array('controller' => 'geographys', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Nodes', true), array('controller' => 'nodes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Node', true), array('controller' => 'nodes', 'action' => 'add')); ?> </li>*/?>
	</ul>
</div>