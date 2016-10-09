<div class="index">
	<div class="front_item_boxes_all">
		<?php foreach ($forum_libraries_types1 as $key => $value) {?>
			<div class="front_item_box">
				<a href="<?php echo $base_url.'/libraries/listing/type1:'.$key;?>">
					<?php echo $value;?>
				</a>
			</div>		
		<?php }?>		
	</div>
</div>