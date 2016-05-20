<?php if(!empty($node)){?>
	<?php $node_link = 'javascript:void(0)';
	$noderevealid = $node['Node']['id'];
	$target = '_self';
	if($node['Cat']['cat_type'] != 0){
		if(isset($node['Attachment'][0])){
			$node_link = $base_url.'/files/upload/'.$node['Attachment'][0]['file'];	
			$noderevealid = '#';			
			$target = '_blank';
		}
	}?>
	<a <?php if($noderevealid != '#') echo 'data-reveal-id="'.$noderevealid.'"';?> href="<?php echo $node_link;?>" <?php if($noderevealid == '#') echo 'target="'.$target.'"';?>>
		<div class="work-item-in">
			<div class="work-item-pic-in">
				<img src="<?php echo $base_url.'/img/upload/'.$node['Gal'][0]['image'];?>" />
			</div>
			<div class="work-item-tit-in">
				<?php echo $node['Node']['title'];?>
			</div>
		</div>
	</a>
	<div id="<?php echo $node['Node']['id']?>" class="reveal-modal">
		<div style="float:left; width:100%; text-align:center;">
			<?php if($node['Cat']['cat_type'] == 0){?>
	    		<img src="<?php echo $base_url.'/img/upload/'.$node['Gal'][0]['image'];?>" style="max-height:540px;max-width:600px;" border="0" />
			<?php }else{?>
				<div class="pdf_div">
	    			<?php if(isset($node['Attachment'][0])){?>
	    				<a target="_blank" href="<?php echo $base_url.'/files/upload/'.$node['Attachment'][0]['file'];?>">Download</a>
					<?php }?>
				</div>
				<div class="video_div">					
	    			<?php if(isset($node['Video'][0])){?>
	    				 <?php echo $this->element('front/video_view',array('record' => $node['Video'][0]));?>
					<?php }?>
				</div>
				<div class="body_div">
	    			<?php if($node['Node']['body'] != ''){
	    				echo $node['Node']['body'];
					}?>
				</div>
				<div class="image_div">
	    			<?php if(isset($node['Gal'][0]) && !isset($node['Attachment'][0]) && !isset($node['Video'][0]) && $node['Node']['body'] == ''){?>
	    				<img src="<?php echo $base_url.'/img/upload/'.$node['Gal'][0]['image'];?>" style="max-height:540px;max-width:600px;" border="0" />
					<?php }?>
				</div>
			<?php }?>
			<div class="work-item-tit-in-light">
				<?php echo $node['Node']['title'];?>
			</div>
		</div>									
	    <a class="close-reveal-modal">&#215;</a>     
	    <?php $prevId = '';$nextId = '';
        if($j != 0)
        $prevId = $nodes[$j-1]['Node']['id'];
        if($j != count($nodes)-1)
		$nextId = $nodes[$j+1]['Node']['id'];		
        echo $this->element('front/navigation_buttons', array('nodeId'=>$node['Node']['id'],'countNode'=>count($nodes) ,'k'=>$j ,'nextId'=>$nextId, 'prevId'=>$prevId,));?>                                    
	</div>
<?php }?>