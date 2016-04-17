<div class="Albums form">
<?php echo $this->Form->create('Album', array('url'=>'add' ,'type'=>'file'));?>
<fieldset>
    <legend><?php __('Add Album'); ?></legend>
    <div id="form">
		<?php 
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
        	<!--Content-->
            <div style="display: block;">
                <?php 
                echo $this->Form->input('header');
                ?>
            </div>
            <?php /*<!--Image Gallery-->
            <div>
            	<?php
            	echo $this->Form->input('Gal.0.caption'); 
            	echo $this->Form->input('Gal.0.image', array('type'=>'file'));
            	?>
            </div>*/?>
            <!--Audio-->
            <div>
            	<?php 
				echo $this->Form->input('Audio.0.title');
				echo $this->Form->input('Audio.0.header');
				echo $this->Form->input('Audio.0.file', array('type'=>'file', 'label'=>'MP3 Audio File'));
				?>
            </div>
            <!--Video-->
            <div>
            	<?php 
				echo $this->Form->input('Video.0.title');
				echo $this->Form->input('Video.0.header');
				echo $this->Form->input('Video.0.image', array('type'=>'file', 'label'=>'Video Image'));
				echo $this->Form->input('Video.0.file', array('type'=>'file', 'label'=>'FLV Video File'));
				echo $this->Form->input('Video.0.url', array('label'=>'If you did not upload a video, add tube URL like(http://www.anytube.com/?id=any)'));
				?>
            </div>
        </div>
    </div>
</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Albums', true), array('action' => 'index'));?></li>
	</ul>
</div>