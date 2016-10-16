<div class="index">
	<div class="backend_item_boxes_all">		
		<div class="backend_item_box">
			<a href="<?php echo $base_url.'/categories/';?>">Categories</a>
		</div>
		<?php foreach ($forum_posts_types as $key => $value) {?>
			<div class="backend_item_box">
				<a href="<?php echo $base_url.'/posts/index/type:'.$key;?>">
					<?php echo ucwords($value);?>
				</a>
			</div>		
		<?php }?>	
	</div>
</div>