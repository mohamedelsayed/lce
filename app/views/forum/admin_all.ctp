<div class="index">
	<div class="backend_item_boxes_all">
		<div class="backend_item_box">
			<a href="<?php echo $base_url.'/forum_slideshows';?>">Slideshows</a>
		</div>	
		<?php $contents = $this->requestAction('main/getForumContents');
		if(!empty($contents)){?>    		
    		<?php foreach ($contents as $content){?>
    			<div class="backend_item_box">
    				<a href="<?php echo $base_url.'/forum_contents/edit/'.$content['Content']['id'];?>">
    					<?php echo $content['Content']['title'];?>
					</a>
				</div>
			<?php }?>
		<?php }?>
	</div>
</div>