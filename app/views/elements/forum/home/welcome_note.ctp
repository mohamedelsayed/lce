<?php if(isset($welcome_note)){
	$title = '';
	if($welcome_note['Content']['title'] != ''){
		$title = $welcome_note['Content']['title'];
	}
	$body = '';
	if($welcome_note['Content']['body'] != ''){
		$body = $welcome_note['Content']['body'];
	}
	$image = '';
	if($welcome_note['Gal'][0]['image'] != ''){
		$image = $base_url.'/img/upload/'.$welcome_note['Gal'][0]['image'];
	}?>
	<div class="home_bottom_left_top_items">
		<div class="testimonials_home top uppercase_text welcome_note_head"><?php echo $title;?></div>
		<div class="home_bottom_left_top_left_items">			
			<div><?php echo $body;?></div>
		</div>
		<?php if($image != ''){?>
			<div class="home_bottom_left_top_right_items">
				<img src="<?php echo $image;?>" alt="<?php echo $title;?>"/>
			</div>
		<?php }?>
	</div>
<?php }?>