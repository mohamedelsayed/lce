<div class="index">
	<div class="backend_item_boxes_all">
		<?php foreach ($forum_events_types as $key => $value) {?>
			<div class="backend_item_box">
				<a href="<?php echo $base_url.'/events/index/type:'.$key;?>"><?php echo $value;?></a>
			</div>		
		<?php }?>
		<div class="backend_item_box">
			<a href="<?php echo $base_url.'/forum_instructors';?>">Instructors</a>
		</div>
	</div>
</div>