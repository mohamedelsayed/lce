<div class="index">
	<div class="backend_item_boxes_all">		
		<div class="backend_item_box">
			<a href="<?php echo $base_url.'/categories/index/type:'.$type;?>">Categories</a>
		</div>
		<?php 
		if($type == 0){
			$data = $forum_posts_types;			
		}elseif($type == 1){
			$data = $forum_posts_types_discussion_board;				
		}
		foreach ($data as $key => $value) {?>
			<div class="backend_item_box">
				<a href="<?php echo $base_url.'/posts/index/type:'.$key;?>">
					<?php echo ucwords($value);?>
				</a>
			</div>		
		<?php }?>	
	</div>
</div>