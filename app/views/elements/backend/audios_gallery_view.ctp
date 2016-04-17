<?php 
if (!empty($gallery)){
	if($this->action == 'edit')$delete = true; else $delete = false;
	echo $this->Javascript->link('rotator/stepcarousel', false);
	echo $this->Javascript->link('rotator/setup3', false);
	echo $this->Html->css('rotator/stepcarousel', null, array('inline'=>false));
	echo $this->Javascript->link('player/play_audio', false);
	
	// Styel for some rotator elements to match thumb image width and height.
	$styelMarginTop = $this->Session->read('Setting.thumb_height')/2 - 12;
	$styelMarginLeft = $this->Session->read('Setting.thumb_width')/2 - 13;
	$styelHeight = $this->Session->read('Setting.thumb_height');
	if($this->action == 'edit')$styelHeight+=20; //hieght + 20 to let place to Delete and Crop links
?>		
	<div id="playerDivaudio">
	<?php
		$width = (isset($width))?$width:$this->Session->read('Setting.audio_width');
		$height = (isset($height))?$height:$this->Session->read('Setting.audio_height');
		//view first audio.
		$element = 'backend/audio_player_view';
    	echo $this->element($element,  array('audio'=>$gallery[0], 'controller'=>'audios', 'width'=>$width, 'height'=>$height));
    ?>
	</div>
	<div style="height: <?php echo $this->Session->read('Setting.thumb_height');?>px;">
        <div class="clear" align="left" style="width:6%; float:left; margin-top: <?php echo $styelMarginTop;?>px;">
            <a href="javascript:stepcarousel.stepBy('gallery3',%20-1)">
            	<?php 
				echo $this->Html->Image(
					'backend/rightarrow.png',
					array('border'=>'0')
				);
				?>
            </a>
        </div>
        <div id="gallery3" class="stepcarousel clear" style="width:89%; height:<?php echo $styelHeight;?>px; float:left; text-align:center;" >
            <div style="width: 1300px; left: 0px;" class="belt">
            <?php
            $i = 0; 
            foreach($gallery as $record){?>
                <div style="float: none; position: absolute; left: <?php echo $i;?>px;" class="panel">
                	<?php $imagePath = 'backend/audio-image.png'; ?>
                	
                	<div 
                		class="playsmall"
                		style="margin-top: <?php echo $styelMarginTop;?>px; margin-left: <?php echo $styelMarginLeft;?>px;"                 		
                		onclick="playAudio('<?php echo $record['id'];?>', '<?php echo $record['title'];?>', '<?php echo $record['file'];?>', <?php echo $width;?>, <?php echo $height;?>, '<?php echo $this->Session->read('Setting.url');?>', '<?php echo $delete;?>');">
                	</div>
                    <?php
						//echo '<div style="margin-bottom:0px">'.substr($record['title'],0,10).'</div>';
						$thumbPath = 'backend/audio-image.png';
						echo $this->Html->image(
							$thumbPath, 
							array(
								'title'  => __('Click to play', true), 
								'width'  => $this->Session->read('Setting.thumb_width'),
								'height' => $this->Session->read('Setting.thumb_height'),
								'border' => '0'
							)
						); 
                    	if($delete){
							echo '<div class = "delete">';
							echo $this->Html->link(__('Delete', true), array('controller' => 'audios/deleteAudio/'.$record['id']), null, __('Are you sure you want to delete this audio?', true));
							//echo '&nbsp;|&nbsp;';
							//echo $this->Html->link(__('Crop', true), array('controller' => 'images', 'action'=>'view', $record['image'].'/thumb'));
							echo '</div>';
						}
					?>
                </div>	
            <?php $i+=260;}?>
            </div>
        </div>
        <div class="clear" align="right" style="width:5%; float:left;  margin-top: <?php echo $styelMarginTop;?>px;">
            <a href="javascript:stepcarousel.stepBy('gallery3',%201)">
            	<?php 
				echo $this->Html->Image(
					'backend/leftarrow.png',
					array('border'=>'0')
				);
				?>
            </a>
        </div>
	</div>    	    	
<?php } else echo __('No Gallery Found.');?>