<div class="home_bottom_right_bottom_items">
	<div class="testimonials_home top uppercase_text calendar_head">calendar</div>
	<?php if(isset($event) && !empty($event)){
		$model = 'Event';
		$model2 = 'Instructor';
		$image = '';
		$style = '';
		$link = BASE_URL.'/events/view/'.$event[$model]['id'];
    	if(trim($event[$model]['image']) != ''){
    		$div_ratio = 183/122;
    		$img = $event[$model]['image'];
        	$image = BASE_URL.'/img/upload/'.$img;            
            $image_path = WWW_ROOT.'img'.DS.'upload'.DS.$img;    
			$max_height = 'max-height:100%;';
            $max_width  = 'max-width:100%;';
            $style = $max_width;
			if (file_exists($image_path)) { 
            $image_size = getimagesize($image_path);                      
		        if(!empty($image_size)){
		            $width = $image_size[0];
		            $height = $image_size[1];   
		            $image_ratio = $width/$height;
		            if($image_ratio > $div_ratio){                  
		                $style = $max_height;
		            }
		        }
			}
		}
		$title = $event[$model]['title'];
		$brief = $event[$model]['brief'];
		$location = $event[$model]['location'];
		$ticket_price = $event[$model]['ticket_price'];
		//$instructor_id = $event[$model]['instructor_id'];
		//$instructor_name = $event[$model2]['name'];
		$instructors_title = '';
		$instructors = $event['Instructor'];			
		$i = 0;
		if(!empty($instructors)){
			foreach ($instructors as $key => $instructor) {
				if(isset($instructor['name'])){
					$icon = '';					
					if($i == 0){
						$icon = '<i class="home_event_icon_name"></i>';
					}else{
						$icon = '<i class="home_event_icon_name no_icon"></i>';
					}
					$i++;
					$instructors_title .= '<div class="instructor_bio_wrap">'.$icon.'</i>'.$instructor['name'].' <a class="instructor_bio_link" onclick="open_instructor('.$instructor['id'].');">bio</a>'
					.'</div> ';
				}
			}
		}
		$instructors_title = trim(trim($instructors_title), ',');
		$instructor_name = $instructors_title;
		$duration = $event[$model]['duration'];?>
		<div class="articles_home_left">		
			<div class="top_right article_home event_home_wrap">
				<div class="top_img_article article_home_image article_home_image_new" style="padding: 0px;">
					<a href="<?php echo $link;?>">
						<div class="home_event_img_div">
							<img class="home_event_img" src="<?php echo $image;?>" 	style="<?php echo $style;?>" />
						</div>
					</a>
				</div>
				<div class="event_home_right">
					<div class="top_wrie_b article_home_title" style="padding: 0px;width: 100%;">
						<a href="<?php echo $link;?>"><?php echo $title;?></a>
					</div>
					<?php /*<div class="mm_tt article_home_creator"><?php echo $location;?></div>*/?>					
					<div class="mm_tt article_home_name open_instructor" style="margin: 0px 0;padding: 12px 0 0 0px;width: 100%">
						<?php echo $instructor_name;?>
					</div>
					<div class="mm_tt article_home_data"><i class="home_event_icon_date"></i>
						<?php echo $this->element('forum'.DS.'print_event_date', array('event' => $event, 'show_time' => 0));?>
					</div>
				</div>
				<?php /*<div class="article_home_image_creator_date">
					<?php echo $brief;?>
				</div>*/?>				
			</div>			
		</div>
	<?php }?>
</div>
<style type="text/css">	
/*.header_big {
	border-bottom: 0px solid #ebebeb !important;
}*/
.event_home_wrap{
	padding-top: 15px;
	margin-bottom: 0px;
}
.event_home_right{
	margin-left: 15px;
	float: left;	
}
.container{
	margin-top: 0px;
}
.instructor_bio_wrap{
	line-height: 22px;
	margin-bottom: 0px;
	font-size: 14px;
}
</style>