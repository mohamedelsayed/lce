<?php $tree = array(array('url' => '/all-events', 'str' => 'UPCOMING EVENTS'));
echo $this->element('front'.DS.'breadcrumb', array('tree' => $tree));
global $base_url;
$months_options = array();
for($m = 1;$m <= 12; $m++){
    $month_in =  date("F", mktime(0, 0, 0, $m, 1, date('Y')));
    $months_options[$m] = $month_in;	
}
$years_options = array();
for ($i = $minYearValue; $i <= $maxYearValue; $i++) {
    $years_options[$i] =$i;
}?>
<div class="title_event_page">
	<p>UPCOMING EVENTS</p>
	<div class="events_filter_div">
        <?php echo $this->Form->input('month', array('type' => 'select', 'options' => $months_options, 'div' => array('class' => 'months_select events_select'), 'label' => false, 'id' => 'month_select_id', 'default' => $month));
        echo $this->Form->input('year', array('type' => 'select', 'options' => $years_options, 'div' => array('class' => 'years_select events_select'), 'label' => false, 'id' => 'year_select_id', 'default' => $year));?>
    </div>
</div>
<?php if(isset($events) && !empty($events)){
	foreach ($events as $key => $event) {
		$model = 'Nevent';
		$model2 = 'Instructor';
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
						$icon = '<i class="icon_name"></i>';
					}else{
						$icon = '<i class="icon_name no_icon"></i>';
					}
					$i++;
					$instructors_title .= '<div class="instructor_bio_wrap">'.$icon.''.$instructor['name'].' <a class="instructor_bio_link" onclick="open_instructor('.$instructor['id'].');">bio</a></div> ';
				}
			}
		}
		$instructors_title = trim(trim($instructors_title), ',');
		$instructor_name = $instructors_title;		
		$image = '';
		$style = '';
    	if(trim($event[$model]['image']) != ''){
    		$div_ratio = 327/218;
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
		}?>
		<div class="post_event">
			<div class="post_event_left">
				<?php if($image != ''){?>
					<div class="post_event_image_in">
						<a>					
							<img style="<?php echo $style;?>" src="<?php echo $image;?>"/>
						</a>
					</div>
				<?php }?>				
				<div class="post_event_date" style="height: auto;margin: 4% 0 2%;margin-top: 20px;"><i class="icon_date"></i>
					<?php echo $this->element('front'.DS.'print_event_date', array('event' => $event, 'show_time' => 1));?>
				</div>				
				<div class="post_event_details" style="margin: 2% 0;"><i class="icon_details"></i><?php echo $location;?></div>
			</div>
			<div class="post_event_right">
				<h1><?php echo $title;?></h1>
				<div class="event_description" style="text-align: justify;min-height: 175px;"><?php echo $description;?></div>
				<div class="event_list_instructor_price_register" style="float: left;width: 100%;margin-top: 0px;">
					<div class="event_list_instructor_price" style="float: left;width: 50%;border-right: 2px solid #abadb3;">
						<div class="post_event_name open_instructor">
							<?php echo $instructor_name;?>
						</div>
						<div class="post_event_price"><i class="icon_price"></i><?php echo $ticket_price.' '.$currency;?></div>
					</div>
					<div class="event_list_register" style="float: left;width: 44%;padding:0 0 0 5%;">				
						<a class="contact_event" onclick="contact_event('<?php echo $event[$model]['id'];?>');" >
							<div class="input_event contact_event" style="width: 100%;margin: 10px 0px;">Inquire about event</div>
						</a>
						<a class="open_event" onclick="open_event('<?php echo $event[$model]['id'];?>');" >
							<div class="input_event open_event" style="width: 100%;margin: 10px 0px;">Register & Pay Now</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	<?php }?>
<?php }else{ ?>
	<div class="no-data-found">No data found.</div>
<?php }?>
<?php /*<div class="pagination_event">
	<ul>
		<li><a href="#"><</a></li>
		<li><a href="#">1</a></li>
		<li><a href="#">2</a></li>
		<li><a href="#">3</a></li>
		<li><a href="#">4</a></li>
		<li><a href="#">5</a></li>
		<li><a href="#">></a></li>
	</ul>
</div>*/?>
<style type="text/css">
	.icon_name{
		margin-left: -10px;
	}
	.icon_price{
		margin-left: -8px;
	}
</style>