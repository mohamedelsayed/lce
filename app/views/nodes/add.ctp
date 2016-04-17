<?php echo $this->Javascript->link('backend/ajax/get_cats', false); ?>
<script type="text/javascript">
$(document).ready(function(){	
	//Get cats of an Artist by Mohamed Elsayed.	
	$("#NodeArtistId").change(function(){	
		getCats($(this), 'Node', 'cat_id', false);
	});
});
</script>
<div class="nodes form">
<?php echo $this->Form->create('Node', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Add Node'); ?></legend>
 		<div id="form">
	<?php
		echo $this->Form->input('title', array("label" => $titleLabel));
		//echo $this->Form->input('date', array('minYear' => $minYearValue,'maxYear' => $maxYearValue));
		//echo $this->Form->input('node_type');
		//echo $this->Form->input('viewed');
		echo $this->Form->input('approved');
		echo $this->Form->input('weight');
		echo $this->Form->input('top_image');
		//echo $this->Form->input('artist_id');
		echo $this->Form->input('cat_id');
		echo $this->Form->input('duration');
		echo $this->Form->input('participants');
		//echo $this->Html->image("backend/loader.gif", array('id'=>'loader', 'style'=> 'display: none', 'border' => '0'));		
		?>		
		</div>
		<div id="tapss">
        <ul class="tabs">
            <li data-tab='tab1' class="current"><a>Contents</a></li>
            <li data-tab='tab2' class=""><a >Images</a></li>
            <?php /*<li><a class="" href="#">Videos</a></li>
            <li><a class="" href="#">Pdf Files</a></li>*/?>
        </ul>
        <div class="panes">
        	<!--Content-->
            <div class="tabdiv" id="tab1" style="display: block;">
                <?php 
                //echo $this->Form->input('teaser');
				echo $this->Form->input('Node.body', array('class'=>'ckeditor'));
				echo $this->Form->input('meta_keywords');
				echo $this->Form->input('meta_description');?>
            </div>
            <!--Images Gallery-->
            <div class="tabdiv" id="tab2">            	
            	<?php
            	echo $this->Form->input('Gal.0.caption'); 
            	echo $this->Form->input('Gal.0.image', array('type'=>'file'));
            	?>
            </div>
            <?php /*<!--Videos-->
            <div style="display: none;">
            	<?php 
				echo $this->Form->input('Video.0.title');
				//echo $this->Form->input('Video.0.image', array('type'=>'file', 'label'=>'Video Image'));
				//echo $this->Form->input('Video.0.file', array('type'=>'file', 'label'=>'FLV Video File'));
				echo $this->Form->input('Video.0.url', array('label'=>'Youtube URL'));
				?>
            </div>
            <!--Attachments-->
            <div style="display: none;">
            	<?php 
				echo $this->Form->input('Attachment.0.title');
				echo $this->Form->input('Attachment.0.file', array('type'=>'file', 'label'=>'File (*.pdf)'));
				?>
            </div>*/?>
        </div>
    </div>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Nodes', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Cats', true), array('controller' => 'cats', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cat', true), array('controller' => 'cats', 'action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Artists', true), array('controller' => 'artists', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Artist', true), array('controller' => 'artists', 'action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Gals', true), array('controller' => 'gals', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Gal', true), array('controller' => 'gals', 'action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Videos', true), array('controller' => 'videos', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Video', true), array('controller' => 'videos', 'action' => 'add')); ?> </li>
	</ul>
</div>