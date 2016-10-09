<div class="index">
	<?php if(isset($page_title)){?>
		<div class="category_title" style="text-align: center;width: 100%;">
			<h2><?php echo $page_title;?></h2>
		</div>				
	<?php }?>
	<div class="front_item_boxes_all">
		<?php foreach ($forum_modules_types as $key => $value) {?>
			<div class="front_item_box">
				<a href="<?php echo $base_url.'/libraries/module/id:'.$key;?>">
					<?php echo $value;?>
				</a>
			</div>		
		<?php }?>		
	</div>
</div>