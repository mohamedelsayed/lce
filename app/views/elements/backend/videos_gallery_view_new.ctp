<?php if (!empty($gallery)){
	if($this->action == 'edit')$delete = true; else $delete = false;
	echo $this->Javascript->link('rotator/stepcarousel', false);
	echo $this->Javascript->link('rotator/setup2', false);
	echo $this->Html->css('rotator/stepcarousel', null, array('inline'=>false));
	echo $this->Javascript->link('backend/jquery.youtubeplaylist', false); 
	echo $this->Javascript->link('player/play_video_new', false);
	
	// Styel for some rotator elements to match thumb image width and height.
	
	$thumbWidth = 120;
	$thumbHeight = 90;
	$styelHeight = $thumbHeight;
	if($this->action == 'edit')$styelHeight+=20; //hieght + 20 to let place to Delete and Crop links
	if($this->action == 'edit')$thumbHeight+=20; //hieght + 20 to let place to Delete and Crop links
	$styelMarginTop = $thumbHeight/2 - 12;
	$styelMarginLeft = $thumbWidth/2 - 13;

	$width = (isset($width))?$width:$this->Session->read('Setting.video_width');
	$height = (isset($height))?$height:$this->Session->read('Setting.video_height');
	?>	
    <script type="text/javascript">
	$(function(){
		$("ul.demo1").ytplaylist({deepLinks: true});
		$("ul.demo2").ytplaylist({
			addThumbs:true,
			autoPlay: false,
			onChange: function() {
				console.log('changed');
			},
			holderId: 'ytvideo2',
			playerHeight:<?php echo $height;?>,
			playerWidth:<?php echo $width;?>,
			thumbSize: 'small'});
	});
	</script>	
	<div class="yt_holder">
		<div id="ytvideo2" align="center"></div>
	</div>  
	<div style="margin-top:15px; height: <?php echo $styelHeight;?>px;">
        <div class="clear" align="left" style="width:6%; float:left; margin-top: <?php echo $styelMarginTop;?>px;">
            <a href="javascript:stepcarousel.stepBy('gallery2',%20-1)">
            	<?php 
				echo $this->Html->Image(
					'backend/rightarrow.png',
					array('border'=>'0')
				);
				?>
            </a>
        </div>
        <div id="gallery2" class="stepcarousel clear" style="width:89%; height:<?php echo $styelHeight;?>px; float:left; text-align:center;" >
            <div style="width: 1300px; left: 0px;" class="belt">
            	<ul class="demo2">
            <?php
            $i = 0; 
            foreach($gallery as $record){?>			
                <div style="float: none; position: absolute; left: <?php echo $i;?>px;width:<?php echo $thumbWidth;?>px;" class="panel">
                	<li>
						<a onclick="updateVideoHits('<?php echo $record['id'];?>','<?php echo $this->Session->read('Setting.url');?>')", href="<?php echo $record['url'];?>"></a>
					</li>
                	<?php /*$imagePath = ($record['image']!='')?'upload/'.$record['image']:'backend/no_image.jpeg'; ?>
                	
                	<div 
                		class="playsmall"
                		style="margin-top: <?php echo $styelMarginTop;?>px; margin-left: <?php echo $styelMarginLeft;?>px;" 
                		<?php if($record['file']!=''){ ?>
                		onclick="playVideo('<?php echo $record['id'];?>', '<?php echo $record['title'];?>', '<?php echo $record['file'];?>', '<?php echo $record['image'];?>', <?php echo $width;?>, <?php echo $height;?>, '<?php echo $this->Session->read('Setting.url');?>', '<?php echo $delete;?>');"
                		<?php }elseif($record['url']!=''){?>
                		onclick="playTube('<?php echo $record['id'];?>', '<?php echo $record['title'];?>', '<?php echo $record['url'];?>', <?php echo $width;?>, <?php echo $height;?>, '<?php echo $this->Session->read('Setting.url');?>', '<?php echo $delete;?>');"
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
						);*/ 
                    	if($delete){
							echo '<div class = "delete">';
							echo $this->Html->link(__('Delete', true), array('controller' => 'videos/deleteVideo/'.$record['id']), null, __('Are you sure you want to delete this video?', true));
							//echo '&nbsp;|&nbsp;';
							//echo $this->Html->link(__('Crop', true), array('controller' => 'images', 'action'=>'view', $record['image'].'/thumb'));
							echo '</div>';
						}
					?>
                </div>	
            <?php $i = $i+130;?>
            <?php }?>
            </ul>
            </div>
        </div>
        <div class="clear" align="right" style="width:5%; float:left;  margin-top: <?php echo $styelMarginTop;?>px;">
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