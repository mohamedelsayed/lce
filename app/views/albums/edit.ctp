<div class="Albums form">
<?php echo $this->Form->create('Album', array('url'=>'edit' ,'type'=>'file'));?>
<fieldset>
    <legend><?php __('Edit Album'); ?></legend>
    <div id="form">
		<?php 
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('meta_keywords');
		echo $this->Form->input('meta_description');		
        ?>
    </div>
    <div id="tapss">
        <ul class="tabs">
            <li><a class="current" href="#">Contents</a></li>
            <!--<li><a class="" href="#">Images Gallery</a></li>-->
            <li><a class="" href="#">Audios</a></li>
            <li><a class="" href="#">Videos</a></li>
        </ul>
        <div class="panes">
        	<!--Contents-->
            <div style="display: block;">           
                <?php 
                echo $this->Form->input('header');
                ?>
            </div>
            <?php /*<!--Images Gallery-->
            <div>
                <?php
                echo $this->Form->input('Gal.0.caption', array('value'=>'')); 
				echo $this->Form->input('Gal.0.image', array('type'=>'file'));
				echo '<h3>'.__('Related Images', true).'</h3>';
				echo $this->element('backend/images_gallery_view', array('gallery' => $this->data['Gal']));
				?>            
            </div>*/?>   
            <!--Audio-->
            <div>
            	<?php 
				echo $this->Form->input('Audio.0.title', array('value'=>''));
				echo $this->Form->input('Audio.0.header', array('value'=>''));
				echo $this->Form->input('Audio.0.file', array('type'=>'file', 'label'=>'MP3 Audio File'));
				echo '<h3>'.__('Related Audios', true).'</h3>';
				echo $this->element('backend/audios_gallery_view', array('gallery' => $this->data['Audio']));
				?>
            </div>         
            <!--Videos-->
            <div>                      
 				<?php 
            	echo $this->Form->input('Video.0.title', array('value'=>''));
				echo $this->Form->input('Video.0.header', array('value'=>''));
            	echo $this->Form->input('Video.0.image', array('type'=>'file', 'label'=>'Video Image'));
				echo $this->Form->input('Video.0.file', array('type'=>'file', 'label'=>'FLV Video File'));
				echo $this->Form->input('Video.0.url', array('value'=>'' ,'label'=>'If you did not upload a video, add tube URL like(http://www.anytube.com/?id=any)'));
				echo '<h3>'.__('Related Videos', true).'</h3>';
				echo $this->element('backend/videos_gallery_view', array('gallery' => $this->data['Video']));
				?>
				<?php /*if(!empty($this->data['Video'])){ ?>
	                 <div class="actions">
	                 	<ul>
	                 		<li style="width:140px;">
	                 			<?php echo $this->Html->link(__('Positioning of Videos', true), array('controller'=> 'videos','action' => 'index',$this->data['Album']['id'])); ?>   
	                 		</li>
	                 	</ul>
	                 </div>
                <?php }*/?>
            </div>
        </div>
    </div>
</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Album.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Album.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Albums', true), array('action' => 'index'));?></li>
	</ul>
</div>