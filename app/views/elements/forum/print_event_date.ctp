<?php $all_date = '';
if(!empty($event)){
	if(!isset($model)){
		$model = 'Event';
	}
	//$duration = $event[$model]['duration'];	
	$from_date = strtotime($event[$model]['from_date']);
	$to_date = strtotime($event[$model]['to_date']);
	$your_date = strtotime("2010-01-01");
	$datediff = $to_date - $from_date;
	$duration = floor($datediff / (60 * 60 * 24));
	$duration = $duration + 1;
	$from_date_month = date('M', $from_date);
	$from_date_day = date('j', $from_date);
	$from_date_year = date('Y', $from_date);
	$all_date = $from_date_month.' '.$from_date_day.', '.$from_date_year;
	if($duration > 1){
		$duration_in = $duration - 1;
		$to_date = strtotime("+".$duration_in." day", strtotime($event[$model]['from_date']));
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
	if($show_time == 1){
		$time_from = date('g:i a', strtotime($event[$model]['time_from']));
		$time_to = date('g:i a', strtotime($event[$model]['time_to']));
		$all_date .= ' <br />'.$time_from.' to '.$time_to;
	}
}		
echo $all_date;