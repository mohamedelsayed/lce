<div class="index">
	<?php if(isset($page_title)){?>
		<div class="category_title" style="text-align: center;width: 100%;">
			<h2><?php echo $page_title;?></h2>
		</div>				
	<?php }?>
	<div class="front_item_boxes_all">
		<?php foreach ($libraries as $key => $value) {
			$model = 'Library';
			$title = $value[$model]['title'];
			$id = $value[$model]['id'];
			?>
			<div class="front_item_box">
				<a href="<?php echo $base_url.'/libraries/album/id:'.$id;?>">
					<?php echo $title;?>
				</a>
			</div>		
		<?php }?>		
	</div>
</div>