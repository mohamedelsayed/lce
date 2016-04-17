<?php 
if (!empty($gallery)){	
	echo $this->Javascript->link('rotator/stepcarousel', false);
	echo $this->Javascript->link('rotator/setup1', false);
	echo $this->Html->css('rotator/stepcarousel', null, array('inline'=>false));
	
	// Styel for left and right arrows to be matched with session thumb width and height.
	$styelMarginTop = $this->Session->read('Setting.thumb_height')/2 - 12;
	$styelHeight = $this->Session->read('Setting.thumb_height');
	if($this->action == 'edit')$styelHeight+=20; //hieght + 20 to let place to Delete and Crop links
?>
	<div style="height: <?php echo $this->Session->read('Setting.thumb_height');?>px;">
        <div class="clear" align="left" style="width:5%; float:left; margin-top: <?php echo $styelMarginTop;?>px;">
            <a href="javascript:stepcarousel.stepBy('gallery1',%20-1)">
                <?php 
				echo $this->Html->Image(
					'backend/rightarrow.png',
					array('border'=>'0')
				);
				?>
            </a>
        </div>
        <div id="gallery1" class="stepcarousel clear" style="width:90%; height:<?php echo $styelHeight;?>px; float:left; text-align:center;" >
            <div style="width: 1300px; left: 0px;" class="belt">
            <?php
            $left = 0; 
			$totalWidth = 0;
            foreach($gallery as $record){?>
                <div style="float: none; position: absolute; left: <?php echo $left;?>px;width:<?php echo $this->Session->read('Setting.thumb_width');?>;height:<?php echo $this->Session->read('Setting.thumb_height');?>;" class="panel" id="panel<?php echo $record['id'];?>">
                    <?php
                    	//echo '<div style="margin-bottom:0px">'.substr($record['caption'],0,30).'</div>'; 
                    	echo $this->element('backend/image_view', array( 'controller'=>'gals', 'image'=>$record, 'size'=>"master"));	
                    ?>
                </div>	
             <script type="text/javascript">
            	$(window).load(function(){
            		$("#panel<?php echo $record['id'];?>").css('left',<?php echo $left;?>);            		
            	});
            </script>
            <?php $left = $left + $this->Session->read('Setting.thumb_width')+10;
			$totalWidth = $totalWidth+$left;
             }?>
            </div>
        </div>
        <div class="clear" align="right" style="width:5%; float:left; margin-top: <?php echo $styelMarginTop;?>px;">
            <a href="javascript:stepcarousel.stepBy('gallery1',%201)">
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
<script type="text/javascript">
	$(document).ready(function(){
		$(".panel a img").css("max-width",<?php echo $this->Session->read('Setting.thumb_width');?>);
		$(".panel a img").css("max-height",<?php echo $this->Session->read('Setting.thumb_height');?>);
	});
	$(window).load(function(){
		$("#gallery1 belt").css('width',<?php echo $totalWidth;?>);
	});
</script>