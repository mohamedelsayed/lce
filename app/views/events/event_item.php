<?php 
$model = 'Event';
$model2 = 'Instructor';
$title = $event[$model]['title'];
$brief = $event[$model]['brief'];
$brief_for_js = $brief;
$brief_for_js = preg_replace( "/\r|\n/", "", $brief_for_js );
$brief_for_js = strip_tags(str_replace('</p>', '\n', $brief_for_js));
$location = $event[$model]['location'];
$time_from = date('G:i:s', strtotime($event[$model]['time_from']));
$time_to = date('G:i:s', strtotime($event[$model]['time_to']));
$zone = "+02:00";
$start_date = date('M d, Y' ,strtotime($event[$model]['from_date'])).' '.$time_from;
$end_date = date('M d, Y' ,strtotime($event[$model]['to_date'])).' '.$time_to;
$event_url = $base_url.'/events/view/'.$event[$model]['id'];
$ticket_price = $event[$model]['ticket_price'];
$instructors_title = '';
$instructors = $event['Instructor'];			
$i = 0;
if(!empty($instructors)){
	foreach ($instructors as $key => $instructor) {
		if(isset($instructor['name'])){
			if($instructor['approved']){
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
			<?php echo $this->element('forum'.DS.'print_event_date', array('event' => $event, 'show_time' => 1, 'model' => $model));?>
		</div>				
		<div class="post_event_details" style="margin: 8px 0;"><i class="icon_details"></i><?php echo $location;?></div>
	</div>
	<div class="post_event_right">
		<h1><?php echo $title;?></h1>
		<div class="event_description" style="text-align: justify;min-height: 175px;"><?php echo $brief;?></div>
		<div class="event_list_instructor_price_register" style="float: left;width: 100%;margin-top: 0px;">
			<div class="event_list_instructor_price" style="float: left;width: 50%;border-right: 2px solid #abadb3;">
				<div class="post_event_name open_instructor">
					<?php echo $instructor_name;?>
				</div>
				<div class="post_event_price"><i class="icon_price"></i><?php echo $ticket_price.' '.$currency;?></div>
			</div>			
			<div class="event_list_register" style="float: left;width: 44%;padding:0 0 0 5%;">				
				<a class="contact_event">
					<div class="input_event contact_event" style="width: 100%;margin: 10px 0px;">
						<a class="ace_btn dis">ADD TO CALENDAR</a>  
					</div>
				</a>
			</div>
		</div>
	</div>
</div>
<style type="text/css">
.icon_name{
	margin-left: -10px;
}
.icon_price{
	margin-left: -8px;
}
.instructor_bio_wrap{
	margin-bottom: -3px;
}
.post_event_details{
	line-height: 36px;
}
.ace_dd{
	min-width: 200px !important;
	width: 200px !important;
}
</style>
<script type="text/javascript">
jQuery(".ace_btn").addcalevent({
	'data': {"title":"<?php echo $title;?>", "desc":"<?php echo trim($brief_for_js);?>", "location":"<?php echo $location;?>", "url": "<?php //echo $event_url;?>", "time":{"start":"<?php echo $start_date;?>", "end":"<?php echo $end_date;?>", "zone":"<?php echo $zone;?>"}},
	'ics': "<?php echo BASE_URL.'/ics';?>",
	/*linkText: [ // Array containing the applications available to the user.
	  'Outlook Calendar',
	  'Google Calendar',
	  'Yahoo Calendar',
	  'Hotmail Calendar',
	  'iCal Calendar'
	]*/
});
</script>