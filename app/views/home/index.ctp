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
					//$image = $base_url.'/img/upload/thumb_'.$testimonial['Testimonial']['image'];
					$image = $base_url.'/img/upload/'.$testimonial['Testimonial']['image'];
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
				<div class="top_pic">				
					<div class="top_img testimonial_image_home">
						<a href="<?php echo $testimonial_link;?>">
							<img src="<?php echo $image;?>"/>
						</a>
					</div>
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
			<a href="<?php echo $all_testimonial_link;?>">
				<div class="top_see">More Tesimonials ></div>
			</a>
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
				It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.
			</div>
		</div>
		<a href="<?php echo $all_coaches_link;?>">
			<div class="top_see_now">Submit coaching form</div>
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
		$instructor_id = $event[$model]['instructor_id'];
		$instructor_name = $event[$model2]['name'];
		$date = date('F d, Y', strtotime($event[$model]['start_date']));
		$time_from = date('g:i a', strtotime($event[$model]['time_from']));
		$time_to = date('g:i a', strtotime($event[$model]['time_to']));
		$duration = $event[$model]['duration'];		
		$all_date = $date;
		if($duration > 1){
			$all_date .= ' '.$duration.' Days';
		}
		//$all_date .= ' <br />'.$time_from.' to '.$time_to;?>
		<div class="articles_home_left">		
			<div class="top_right article_home">
				<div class="top_img_article article_home_image article_home_image_new">
					<a>
						<img class="home_event_img" src="<?php echo $image;?>" />
					</a>
				</div>
				<div class="top_wrie_b article_home_title"><?php echo $title;?></div>
				<div class="mm_tt article_home_creator"><?php echo $location;?></div>
				<div class="mm_tt article_home_data"><?php echo $all_date;?></div>
				<div class="mm_tt article_home_name open_instructor" onclick="open_instructor('<?php echo $instructor_id;?>');"><?php echo $instructor_name;?></div>
				<div class="article_home_image_creator_date">
					<?php echo $description;?>
				</div>
			</div>
			<a class="open_event" onclick="open_event('<?php echo $event[$model]['id'];?>');" >
				<div class="top_see_now">Register Now</div>
			</a>
		</div>
	<?php }?>
</div>
<style type="text/css">	
.header_big {
	border-bottom: 0px solid #ebebeb !important;
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