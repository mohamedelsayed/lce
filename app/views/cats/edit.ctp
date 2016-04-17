<?php echo $this->Javascript->link('backend/ajax/get_cats', false); ?>
<script type="text/javascript">
$(document).ready(function(){	
	//Get cats of an Artist by Mohamed Elsayed.	
	$("#CatArtistId").change(function(){	
		getCats($(this), 'Cat', 'parent_id', '');
	});
});
</script>
<div class="cats form">
<?php echo $this->Form->create('Cat', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Edit Cat'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title', array("label" => $titleLabel));
		//echo $this->Form->input('date', array('minYear' => $minYearValue,'maxYear' => $maxYearValue));
		echo $this->Form->input('Cat.body', array('class'=>'ckeditor'));		
		echo $this->element('backend/image_view', array('image'=>array('id'=>$this->data['Cat']['id'], 'image'=>$this->data['Cat']['image']), 'size'=>'master'));
		echo $form->input('image', array('type'=>'file', 'label'=>'Image'));
		echo $this->Form->input('meta_keywords');
		echo $this->Form->input('meta_description');
		//echo $this->Form->input('artist_id');		
		echo $this->Form->input('parent_id',array('empty'=>''));
		echo $this->Html->image("backend/loader.gif", array('id'=>'loader', 'style'=> 'display: none', 'border' => '0'));
		echo $this->Form->input('weight');
		echo $this->Form->input('approved');
		//$options=array('0'=>'Art Work','1'=>'Other');
		//$attributes=array('value'=>$this->data['Cat']['cat_type'], 'legend'=>'Type');
		//echo $form->radio('cat_type',$options,$attributes);
		//echo $this->Form->input('cat_type');		
		//echo $this->Form->input('under_construction');		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Cat.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Cat.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Cats', true), array('action' => 'index'));?></li>
		<li><?php //echo $this->Html->link(__('List Artists', true), array('controller' => 'artists', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Artist', true), array('controller' => 'artists', 'action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Cats', true), array('controller' => 'cats', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Parent Cat', true), array('controller' => 'cats', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Nodes', true), array('controller' => 'nodes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Node', true), array('controller' => 'nodes', 'action' => 'add')); ?> </li>
	</ul>
</div>