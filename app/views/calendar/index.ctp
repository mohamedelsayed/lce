<?php $months_options = array();
for($m = 1;$m <= 12; $m++){
	$month =  date("F", mktime(0, 0, 0, $m, 1, date('Y')));
    $months_options[$m] = $month;
}
$years_options = array();
for ($i = $minYearValue; $i <= $maxYearValue; $i++) {
    $years_options[$i] =$i;
}
$categories_options = array();
$categories_options[0] = 'All';
if(isset($categories) && !empty($categories)){
    foreach ($categories as $key => $category) {
        $categories_options[$category['Category']['id']] = $category['Category']['title'];
    }
}
$year = isset($this->params['named']['year'])?$this->params['named']['year']:date("Y");
$month = isset($this->params['named']['month'])?$this->params['named']['month']:date("m");
$category = isset($this->params['named']['category'])?$this->params['named']['category']:0;
$month_letter = date("F", mktime(0, 0, 0, $month));?>
<div id="tab-2" class="tab-content current" style="width: 100%;">
    <div class="" style="width: 100%;">
        <div class="top_con">
            <div class="top_con_2">Calendar</div>  
            <div class="calendar_filter_div">
                <?php echo $this->Form->input('month', array('type' => 'select', 'options' => $months_options, 'div' => array('class' => 'months_select calendar_select'), 'label' => false, 'id' => 'month_select_id', 'default' => $month));
                echo $this->Form->input('year', array('type' => 'select', 'options' => $years_options, 'div' => array('class' => 'years_select calendar_select'), 'label' => false, 'id' => 'year_select_id', 'default' => $year));
                //echo $this->Form->input('category', array('type' => 'select', 'options' => $categories_options, 'div' => array('class' => 'categories_select calendar_select'), 'label' => false, 'id' => 'category_select_id', 'default' => $category));?>
                </div>
            <?php if(isset($categories) && !empty($categories)){?>                
                <div class="calendar_list_categories">
                    <?php foreach ($categories as $key => $category) {?>
                        <div class="category_div">
                            <div class="category_color_div" style="background-color: <?php echo $category['Category']['color'];?>;"></div>                            
                            <div class="category_title_div"><?php echo $category['Category']['title'];?></div>
                        </div>                        
                    <?php }?>
                </div>
            <?php }?>
            <div class="calendar_div">
                <?php echo draw_calendar($month, $year, $events_by_days);?>
            </div>            
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('#month_select_id').on('change', function(){
        reload_page_with_new_data();      
    });
    $('#year_select_id').on('change', function(){
        reload_page_with_new_data();      
    });
    $('#category_select_id').on('change', function(){
        reload_page_with_new_data();      
    });
});    
function reload_page_with_new_data(){
    var base_url = '<?php echo $base_url;?>';
    var month_val = $('#month_select_id').val();      
    var year_val = $('#year_select_id').val(); 
    var category_val = $('#category_select_id').val();   
    var new_url = base_url+'/calendar/index/year:'+year_val+'/month:'+month_val+'/category:'+category_val;
    window.location.href = new_url;
}
</script>
<?php  /* draws a calendar */
function draw_calendar($month, $year, $events_by_days){
    /* draw table */
    $calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';
    /* table headings */
    $headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
    $calendar.= '<tr class="calendar-row">';
    //implode('</td><td class="calendar-day-head">',$headings).
    $i = 1;
    foreach ($headings as $key => $value) {
        $class = 'calendar_odd_head';
        if ($i++ % 2 == 0) {
            $class = 'calendar_even_head';
        }
        $calendar.= '<td class="calendar-day-head '.$class.'">';
        $calendar.= $value;
        $calendar.= '</td>';        
    }
    $calendar.= '</tr>';
    /* days and weeks vars now ... */
    $running_day = date('w',mktime(0,0,0,$month,1,$year));
    $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
    $days_in_this_week = 1;
    $day_counter = 0;
    $dates_array = array();
    /* row for week one */
    $calendar.= '<tr class="calendar-row">';
    /* print "blank" days until the first of the current week */
    for($x = 0; $x < $running_day; $x++):
        $calendar.= '<td class="calendar-day-np"> </td>';
        $days_in_this_week++;
    endfor;
    /* keep going with days.... */
    for($list_day = 1; $list_day <= $days_in_month; $list_day++):
        $calendar.= '<td class="calendar-day">';
        /* add in the day number */
        $calendar .= '<div class="day-number">'.sprintf("%02d",$list_day).'</div>';          
        $calendar .= "<div class='event_calendar_wraper_div'>";                        
        if(isset($events_by_days[$list_day])){
            foreach ($events_by_days[$list_day] as $key => $event) {                
                $color = 'color:#000000;';
                if(isset($event['Category']['color']) && $event['Category']['color'] != ''){
                    $color = 'color:'.$event['Category']['color'].';';
                }
                $calendar .= '<div onclick="open_event('.$event['Event']['id'].');" class="event_calendar_div" style="'.$color.'">'.$event['Event']['title'].'</div>';                    
            }                
        }
        $calendar .= "</div>";
        $calendar.= '</td>';
        if($running_day == 6):
            $calendar.= '</tr>';
            if(($day_counter+1) != $days_in_month):
                $calendar.= '<tr class="calendar-row">';
            endif;
            $running_day = -1;
            $days_in_this_week = 0;
        endif;
        $days_in_this_week++; $running_day++; $day_counter++;
    endfor;
    /* finish the rest of the days in the week */
    if($days_in_this_week < 8):
        for($x = 1; $x <= (8 - $days_in_this_week); $x++):
            $calendar.= '<td class="calendar-day-np"> </td>';
        endfor;
    endif;
    /* final row */
    $calendar.= '</tr>';
    /* end the table */
    $calendar.= '</table>';
    /* all done, return result */
    return $calendar;
}?>