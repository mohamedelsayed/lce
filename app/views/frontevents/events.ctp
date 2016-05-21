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
<div class="post_event">
	<div class="post_event_left">
		<a href="#"><img src="<?php echo $base_url.'/img/front/';?>img_event.png"/></a>
		<div class="post_event_details">Location Details</div>
		<div class="post_event_date">Date</div>
		<div class="post_event_name">Instructor Name</div>
		<div class="post_event_price">Ticket Price</div>
	</div>
	<div class="post_event_right">
		<h1>ICF accredited Coach training</h1>
		<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.
		<br/>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.<br/>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
		<a href="#">
			<div class="input_event">Register Now</div>
		</a>
	</div>
</div>
		<div class="post_event">
		<div class="post_event_left">
		<a href="#"><img src="<?php echo $base_url.'/img/front/';?>img_event.png"/></a>
		<div class="post_event_details">Location Details</div>
		<div class="post_event_date">Date</div>
		<div class="post_event_name">Instructor Name</div>
		<div class="post_event_price">Ticket Price</div>
		</div>
		<div class="post_event_right">
		<h1>ICF accredited Coach training</h1>
		<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.
		<br/>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.<br/>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
		<a href="#">
				<div class="input_event">Register Now</div>
			</a>
		</div>
		</div>
		<div class="post_event">
		<div class="post_event_left">
		<a href="#"><img src="<?php echo $base_url.'/img/front/';?>img_event.png"/></a>
		<div class="post_event_details">Location Details</div>
		<div class="post_event_date">Date</div>
		<div class="post_event_name">Instructor Name</div>
		<div class="post_event_price">Ticket Price</div>
		</div>
		<div class="post_event_right">
		<h1>ICF accredited Coach training</h1>
		<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.
		<br/>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.<br/>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
		<a href="#">
				<div class="input_event">Register Now</div>
			</a>
		</div>
	</div>
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