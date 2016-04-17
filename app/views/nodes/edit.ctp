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
 		<legend><?php __('Edit Node'); ?></legend>
 		<div id="form">
	<?php
		echo $this->Form->input('id');
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
		//echo $this->Html->image("backend/loader.gif", array('id'=>'loader', 'style'=> 'display: none', 'border' => '0'));?>
		<?php if(isset($ourservices_cat_id)){?>
			<div class="input text">
				<label for="NodeLink">Our Services inner page links:</label>
				<input readonly="readonly" id="NodeLink" type="text" value="<?php echo $this->Session->read('Setting.url').'/page/show/'.$ourservices_cat_id.'?nodeid='.$this->data['Node']['id'];?>" name="link">
			</div>
		<?php }?>
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
            	echo $this->Form->input('Gal.0.caption', array('value'=>'')); 
            	echo $this->Form->input('Gal.0.image', array('type'=>'file'));
				echo '<h3>'.__('Related Images', true).'</h3>';
				echo $this->element('backend/images_gallery_view', array('gallery' => $this->data['Gal']));
				?>  
				<?php if(!empty($this->data['Gal']) && (count($this->data['Gal']) > 1)){?>
					<div class="actions">
						<ul>
							<li style="width:140px;">
								<?php echo $this->Html->link(__('Positioning of Images', true), array('controller'=> 'gals','action' => 'index',$this->data['Node']['id'],'Node'));?>   
							</li>
						</ul>
					</div>
				<?php }?>
            </div>
            <?php /*<!--Videos-->
            <div style="display: none;">
            	<?php 
				echo $this->Form->input('Video.0.title', array('value'=>''));
				//echo $this->Form->input('Video.0.image', array('type'=>'file', 'label'=>'Video Image'));
				//echo $this->Form->input('Video.0.file', array('type'=>'file', 'label'=>'FLV Video File'));
				echo $this->Form->input('Video.0.url', array('label'=>'Youtube URL','value'=>''));
				echo '<h3>'.__('Related Videos', true).'</h3>';
				echo $this->element('backend/videos_gallery_view_new', array('gallery' => $this->data['Video']));
				?>
            </div>
            <!--Attachments-->
            <div style="display: none;">
            	<?php 
				echo $this->Form->input('Attachment.0.title', array('value'=>''));
				echo $this->Form->input('Attachment.0.file', array('type'=>'file', 'label'=>'File (*.pdf)'));
				echo '<h3>'.__('Related Pdf Files', true).'</h3>';
				echo $this->element('backend/attachments_view', array("attachments" =>$this->data['Attachment']));
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
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Node.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Node.id'))); ?></li>
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