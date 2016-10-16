<div class="index">
	<div class="front_item_boxes_all">
		<?php foreach ($forum_posts_types as $key => $value) {?>
			<div class="front_item_box">
				<a href="<?php echo $base_url.'/posts/all/type:'.$key;?>">
					<?php echo ucwords($value);?>
				</a>
			</div>		
		<?php }?>		
	</div>
</div>