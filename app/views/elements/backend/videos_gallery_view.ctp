<?php 
if (!empty($gallery)){
	if($this->action == 'edit')$delete = true; else $delete = false;
	echo $this->Javascript->link('rotator/stepcarousel', false);
	echo $this->Javascript->link('rotator/setup2', false);
	echo $this->Html->css('rotator/stepcarousel', null, array('inline'=>false));
	echo $this->Javascript->link('player/play_video', false);
	
	// Styel for some rotator elements to match thumb image width and height.
	$styelMarginTop = $this->Session->read('Setting.thumb_height')/2 - 12;
	$styelMarginLeft = $this->Session->read('Setting.thumb_width')/2 - 13;
	$styelHeight = $this->Session->read('Setting.thumb_height');
	if($this->action == 'edit')$styelHeight+=20; //hieght + 20 to let place to Delete and Crop links
?>		
	<div id="playerDiv">
	<?php
		$width = (isset($width))?$width:$this->Session->read('Setting.video_width');
		$height = (isset($height))?$height:$this->Session->read('Setting.video_height');
		//view first video or tube.
		$element = (!empty($gallery[0]['file']))?'backend/video_player_view':'backend/tube_view';
    	echo $this->element($element,  array('video'=>$gallery[0], 'controller'=>'videos', 'width'=>$width, 'height'=>$height));
    ?>
	</div>
	<div style="height: <?=$this->Session->read('Setting.thumb_height');?>px;">
        <div class="clear" align="left" style="width:6%; float:left; margin-top: <?=$styelMarginTop;?>px;">
            <a href="javascript:stepcarousel.stepBy('gallery2',%20-1)">
            	<?php 
				echo $this->Html->Image(
					'backend/rightarrow.png',
					array('border'=>'0')
				);
				?>
            </a>
        </div>
        <div id="gallery2" class="stepcarousel clear" style="width:89%; height:<?=$styelHeight;?>px; float:left; text-align:center;" >
            <div style="width: 1300px; left: 0px;" class="belt">
            <?php
            $i = 0; 
            foreach($gallery as $record){?>
                <div style="float: none; position: absolute; left: <?=$i;?>px;" class="panel">
                	<?php $imagePath = ($record['image']!='')?'upload/'.$record['image']:'backend/no_image.jpeg'; ?>
                	
                	<div 
                		class="playsmall"
                		style="margin-top: <?=$styelMarginTop;?>px; margin-left: <?=$styelMarginLeft;?>px;" 
                		<?php if($record['file']!=''){ ?>
                		onclick="playVideo('<?=$record['id'];?>', '<?=$record['title'];?>', '<?=$record['file'];?>', '<?=$record['image'];?>', <?=$width;?>, <?=$height;?>, '<?=$this->Session->read('Setting.url');?>', '<?=$delete;?>');"
                		<?php }elseif($record['url']!=''){?>
                		onclick="playTube('<?=$record['id'];?>', '<?=$record['title'];?>', '<?=$record['url'];?>', <?=$width;?>, <?=$height;?>, '<?=$this->Session->read('Setting.url');?>', '<?=$delete;?>');"
                		<?php }?>
                	>
                	</div>
                    <?php
						//echo '<div style="margin-bottom:0px">'.substr($record['title'],0,10).'</div>';
						$thumbPath = ($record['image']!='')?'upload/thumb_'.$record['image']:'backend/thumb_no_image.jpeg';
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
							echo $this->Html->link(__('Delete', true), array('controller' => 'videos/deleteVideo/'.$record['id']), null, __('Are you sure you want to delete this video?', true));
							echo '&nbsp;|&nbsp;';
							echo $this->Html->link(__('Crop', true), array('controller' => 'images', 'action'=>'view', $record['image'].'/thumb'));
							echo '</div>';
						}
					?>
                </div>	
            <?php $i+=260;}?>
            </div>
        </div>
        <div class="clear" align="right" style="width:5%; float:left;  margin-top: <?=$styelMarginTop;?>px;">
            <a href="javascript:stepcarousel.stepBy('gallery2',%201)">
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

