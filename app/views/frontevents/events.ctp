<?php $tree = array(array('url' => '/all-events', 'str' => 'UPCOMING EVENTS'));
echo $this->element('front'.DS.'breadcrumb', array('tree' => $tree));
$months_options = array();
for($m = 1;$m <= 12; $m++){
    $month =  date("F", mktime(0, 0, 0, $m));
    $months_options[$m] = $month;
}
$years_options = array();
for ($i = $minYearValue; $i <= $maxYearValue; $i++) {
    $years_options[$i] =$i;
}
$year = isset($_GET['year'])?$_GET['year']:date("Y");
$month = isset($_GET['month'])?$_GET['month']:date("m");?>
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
		$instructor_id = $event[$model]['instructor_id'];
		$instructor_name = $event[$model2]['name'];
		$date = date('F d, Y', strtotime($event[$model]['start_date']));
		$time_from = date('g:i a', strtotime($event['Instructor']['time_from']));
		$time_to = date('g:i a', strtotime($event['Instructor']['time_to']));
		$duration = $event[$model]['duration'];		
		$all_date = $date;
		if($duration > 1){
			$all_date .= ' '.$duration.' Days';
		}
		$all_date .= ' <br />'.$time_from.' to '.$time_to;
		$image = '';
		$style = '';
    	if(trim($event[$model]['image']) != ''){
    		$div_ratio = 327/218;
    		$img = $event[$model]['image'];
        	$image = BASE_URL.'/img/upload/'.$img;            
            $image_path = WWW_ROOT.'img'.DS.'upload'.DS.$img;    
            $image_size = getimagesize($image_path);          
            $max_height = 'max-height:100%;';
            $max_width  = 'max-width:100%;';
            $style = $max_width;
            if(!empty($image_size)){
                $width = $image_size[0];
                $height = $image_size[1];   
                $image_ratio = $width/$height;
                if($image_ratio > $div_ratio){                  
                    $style = $max_height;
                }
            }
		}?>
		<div class="post_event">
			<div class="post_event_left">
				<?php if($image != ''){?>
					<a>					
						<img style="<?php echo $style;?>" src="<?php echo $image;?>"/>
					</a>
				<?php }?>
				<div class="post_event_details"><?php echo $location;?></div>
				<div class="post_event_date" style="height: auto;"><i class="icon-date"></i><?php echo $all_date;?></div>
				<div class="post_event_name"  onclick="open_instructor('<?php echo $instructor_id;?>');">
					<?php echo $instructor_name;?>
				</div>
				<div class="post_event_price"><?php echo $ticket_price.' '.$currency;?></div>
			</div>
			<div class="post_event_right">
				<h1><?php echo $title;?></h1>
				<div class="event_description"><?php echo $description;?></div>
				<a>
					<div class="input_event">Register Now</div>
				</a>
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