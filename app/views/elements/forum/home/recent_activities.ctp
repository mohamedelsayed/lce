<div class="home_bottom_left_bottom_items">
	<div class="testimonials_home top uppercase_text recent_activities_head">Recent Activities</div>
	<?php if(!empty($recent_activities)){?>
		<?php foreach ($recent_activities as $key => $recent_activity) {
			$type = $recent_activity[0]['type'];
			$id = $recent_activity[0]['id'];
			$title = $recent_activity[0]['title'];
			$created = $recent_activity[0]['created'];
			$item = array();
			$item_link = '';
			if($type == 'library'){
				if(isset($libraries[$id])){
					$item = $libraries[$id];
					$type1 = $item['Library']['type1'];
					$module = $item['Library']['module'];
					if($type1 == 0){
						$item_link = $base_url.'/libraries/module/id:'.$module;			
					}else{
						$item_link = $base_url.'/libraries/listing/type1:'.$type1;					
					}
				}
			}elseif($type == 'event'){
				$item = $recent_activity;
				$item_link = $base_url.'/events/view/'.$id;
			}elseif($type == 'comment'){
				if(isset($comments[$id])){
					$item = $comments[$id];
					$post_id = $item['ForumComment']['post_id'];
					$item_link = $base_url.'/posts/view/'.$post_id;
				}
			}
			$href = '';
			if($item_link != ''){
				$href = ' href="'.$item_link.'"';				
			}
			$date = date('F d, Y h:i A', strtotime($created)); ?>
			<div class="recent_activity">
				<div class="top_wrie testimonial_title_home">
					<a <?php echo $href;?>><?php echo $title;?></a>
				</div>
				<div class="recent_activity_date"><?php echo $date;?></div>
			</div>			
		<?php }?>	
	<?php }?>
</div>