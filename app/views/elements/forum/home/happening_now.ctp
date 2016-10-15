<?php if(isset($happening_now)){
	$title = '';
	if($happening_now['Content']['title'] != ''){
		$title = $happening_now['Content']['title'];
	}
	$body = '';
	if($happening_now['Content']['body'] != ''){
		$body = $happening_now['Content']['body'];
	}
	$image = '';
	if($happening_now['Gal'][0]['image'] != ''){
		$image = $base_url.'/img/upload/'.$happening_now['Gal'][0]['image'];
	}?>
	<div class="home_bottom_right_top_items">
		<div class="testimonials_home top uppercase_text happening_now_head"><?php echo $title;?></div>
		<?php if($image != ''){?>
			<div class="home_bottom_right_top_top_items">
				<img src="<?php echo $image;?>" alt="<?php echo $title;?>"/>
			</div>
		<?php }?>
		<div class="home_bottom_right_top_bottom_items">			
			<div><?php echo $body;?></div>
		</div>
		
	</div>
<?php }?>