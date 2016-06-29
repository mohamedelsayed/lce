<?php $all_testimonial_link = $base_url.'/page/view/3?nodeid=6';
$all_coaches_link = $base_url.'/all-coaches';
$all_events_link = $base_url.'/all-events';?>
<?php /*if(!empty($slideshows)){?>
	<?php echo $this->Html->css(array('front/nivo', 'front/nivoDefaultTheme'));
	echo $this->Javascript->link(array('front/jquery.nivo.slider'));?>
	<script type="text/javascript">
	$(window).load(function(){
		$('#slider').nivoSlider({
			effect: 'fade',
			directionNav: false,
			controlNav: true  
		});
	});
	</script>
	<div class="slider">
		<div id="wrapper">
			<div class="slider-wrapper theme-default">
				<div id="slider" class="nivoSlider">
					<?php foreach ($slideshows as $key => $slideshow) {
						$href = '';
						if($slideshow['Slideshow']['link'] != ''){
							$href = 'href="'.$slideshow['Slideshow']['link'].'"';
						}
						if($slideshow['Slideshow']['target'] == 1){
							$href .= ' target="_blank"';
						}?>
						<a <?php echo $href;?>>
							<img src="<?php echo $base_url.'/img/upload/'.$slideshow['Slideshow']['image'];?>" data-thumb="<?php echo $base_url.'/img/upload/'.$slideshow['Slideshow']['image'];?>" alt="" title="" />					
						</a>
					<?php }?>				
				</div>
			</div>
		</div>
	</div>
<?php }*/?>
<?php if(!empty($testimonials)){
	$testimonial_cut_string = $this->Session->read('Setting.testimonial_cut_string'); ?>
	<div class="bottom_grop_top">
		<a href="<?php echo $all_testimonial_link;?>">
			<div class="testimonials_home top uppercase_text">Testimonials</div>
		</a>
		<div class="testimonials_home_left">
			<?php foreach ($testimonials as $key => $testimonial) {
				$image = '';
				if($testimonial['Testimonial']['image'] != ''){
					$model = 'Testimonial';
					//$image = $base_url.'/img/upload/thumb_'.$testimonial['Testimonial']['image'];
					$image = $base_url.'/img/upload/'.$testimonial['Testimonial']['image'];
		    		$div_ratio = 80/80;
		    		$img = $testimonial[$model]['image'];
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
				$name = '';
				if($testimonial['Testimonial']['name'] != ''){
					$name = $testimonial['Testimonial']['name'];
				}
				$position = '';
				if($testimonial['Testimonial']['position'] != ''){
					$position = $testimonial['Testimonial']['position'];
				}
				$body = '';
				if($testimonial['Testimonial']['body'] != ''){
					$body = strip_tags($testimonial['Testimonial']['body']);
				}
				$testimonial_link = $all_testimonial_link.'#testimonial'.$testimonial['Testimonial']['id'];?>
				<div class="top_pic" style="margin-bottom: 10px;">	
					<a href="<?php echo $testimonial_link;?>">			
						<div class="top_img testimonial_image_home">						
							<img src="<?php echo $image;?>" style="<?php echo $style;?>" />					
						</div>
					</a>
					<div class="top_wrie testimonial_title_home">
						<a href="<?php echo $testimonial_link;?>">
							<?php echo $name;?>
						</a>
						<?php /*<i style="font-family: OpenSans-Light;">, <?php echo $position;?></i>*/?>
					</div>
					<?php /*<div class="t_right_2 testimonial_position_home">
						<?php echo $position;?>
					</div>*/?>
					<div class="top_wrie_2">
						"<?php echo $this->element('front'.DS.'string_format_view',array('str'=> $body,'type'=> 'wordsCut', 'val' => $testimonial_cut_string));?>
					</div>
				</div>
			<?php }?>
			<?php /*<a href="<?php echo $all_testimonial_link;?>">
				<div class="top_see">More Tesimonials ></div>
			</a>*/?>
		</div>
	</div>
<?php }?>
<div class="bottom_grop_2">
	<a href="<?php echo $all_coaches_link;?>">
		<div class="title_top_find">FIND A COACH</div>
	</a>
	<div class="articles_home_left">
		<div class="top_right article_home">
			<div class="article_home_image_creator_date">
				You can hire a personal coach from our community of accreditted coaches that have completed the Dialogical Coaching Certification (DCC).
			</div>
		</div>
		<a href="<?php echo $all_coaches_link;?>">
			<div class="top_see_now">Search the DCC Community</div>
		</a>
	</div>
</div>
<div class="bottom_grop_2">
	<a href="<?php echo $all_events_link;?>">
		<div class="title_top_events">UPCOMING EVENTS</div>
	</a>
	<?php if(isset($event) && !empty($event)){
		$model = 'Nevent';
		$model2 = 'Instructor';
		$image = '';
		$style = '';
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
		$description = $event[$model]['description'];
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
		$duration = $event[$model]['duration'];		
		$from_date = strtotime($event[$model]['start_date']);
		$from_date_month = date('M', $from_date);
		$from_date_day = date('j', $from_date);
		$from_date_year = date('Y', $from_date);
		$all_date = $from_date_month.' '.$from_date_day.', '.$from_date_year;
		if($duration > 1){
			$duration_in = $duration - 1;
			$to_date = strtotime("+".$duration_in." day", strtotime($event[$model]['start_date']));
			$to_date_month = date('M', $to_date);
			$to_date_day = date('j', $to_date);
			$to_date_year = date('Y', $to_date);			
			if($to_date_year == $from_date_year && $to_date_month == $from_date_month){
				$all_date = $from_date_month.' '.$from_date_day.'-'.$to_date_day.', '.$from_date_year;
			}elseif($to_date_year == $from_date_year){
				$all_date = $from_date_month.' '.$from_date_day.' - '.$to_date_month.' '.$to_date_day.', '.$from_date_year;
			}else{
				$all_date = $from_date_month.' '.$from_date_day.', '.$from_date_year.'-'.$to_date_month.' '.$to_date_day.', '.$from_date_year;
			}
		}
		/*$time_from = date('g:i a', strtotime($event[$model]['time_from']));
		$time_to = date('g:i a', strtotime($event[$model]['time_to']));
		$all_date .= ' <br />'.$time_from.' to '.$time_to;*/?>
		<div class="articles_home_left">		
			<div class="top_right article_home event_home_wrap">
				<div class="top_img_article article_home_image article_home_image_new" style="padding: 0px;">
					<a>
						<div class="home_event_img_div">
							<img class="home_event_img" src="<?php echo $image;?>" 	style="<?php echo $style;?>" />
						</div>
					</a>
				</div>
				<div class="event_home_right">
					<div class="top_wrie_b article_home_title" style="padding: 0px;width: 100%;"><?php echo $title;?></div>
					<?php /*<div class="mm_tt article_home_creator"><?php echo $location;?></div>*/?>					
					<div class="mm_tt article_home_name open_instructor" style="margin: 0px 0;padding: 12px 0 0 0px;width: 100%">
						<?php echo $instructor_name;?>
					</div>
					<div class="mm_tt article_home_data"><i class="home_event_icon_date"></i><?php echo $all_date;?></div>
				</div>
				<?php /*<div class="article_home_image_creator_date">
					<?php echo $description;?>
				</div>*/?>				
			</div>
			<a class="open_event" href="<?php echo $all_events_link;?>">
				<div class="top_see_now">More Details</div>
			</a>
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
<?php /* }?>
<div class="bottom_grop_2">
		<div class="title_top_find">FIND A COACH</div>
            <div class="articles_home_left">
<?php if(!empty($articles)){
	$articles_link_all = $base_url.'/article/all';
	$article_cut_string = $this->Session->read('Setting.article_cut_string');?>
			<?php foreach ($articles as $key => $article) {
				$image = '';
				if(isset($article['Gal'])){
					//$image = $base_url.'/img/upload/thumb_'.$article['Gal'][0]['image'];
					$image = $base_url.'/img/upload/'.$article['Gal'][0]['image'];
				}
				$title = '';
				if($article['Article']['title'] != ''){
					$title = $article['Article']['title'];
				}
				$header = '';
				if($article['Article']['header'] != ''){
					$header = $article['Article']['header'];
				}
				$body = '';
				if($article['Article']['body'] != ''){
					$body = $article['Article']['body'];
				}
				$article_link = $base_url.'/article/item/'.$article['Article']['id'];?>
				<div class="top_right article_home">
				<?php /*	<div class="top_wrie_b article_home_title">
						<a href="<?php echo $article_link;?>">
							<?php  echo $title;?>
						</a>
					</div>?>
					<div class="article_home_image_creator_date">
						<?php /*<div class="top_img_article article_home_image">
							<a href="<?php echo $article_link;?>">
								<img src="<?php echo $image;?>"/>
							</a>
						</div>	
						<div class="top_img_article article_home_image article_home_image_new">
							<a href="<?php echo $article_link;?>">
								<img src="<?php echo $image;?>" />
							</a>
						</div>	
						<div class="mm_tt article_home_creator">
							<?php echo $article['Article']['creator'];?>
						</div>
						<div class="mm_tt article_home_date">
							<?php echo $this->element('front/english_date_view', array('date' => $article['Article']['date']));?>				
						</div>?>
					</div>
					<div class="article_header">
						<?php echo $this->element('front'.DS.'string_format_view',array('str'=> $body,'type'=> 'wordsCut', 'val' => $article_cut_string));?>
						<?php //echo $this->element('front'.DS.'string_format_view',array('str'=> $header,'type'=> 'wordsCut', 'val' => $article_cut_string));?>
						<?php //echo $header;?>
					</div>
				</div>
			<?php }?>
			<a href="<?php echo $articles_link_all;?>">
				<div class="top_see_now">Submit coaching form</div>
			</a>
		</div>
	</div>
<?php }?>	
<?php /*if(!empty($partners)){?>
	<?php if(isset($partners['Gal'][0])){?>
		<div class="bot_logo" style="margin-bottom: 35px;">
			<a href="<?php echo $base_url.'/page/view/3?nodeid='.$partners['Node']['id'];?>">
				<img src="<?php echo $base_url.'/img/upload/'.$partners['Gal'][0]['image'];?>"/>
			</a>
		</div>
	<?php }?>
<?php }*/?>