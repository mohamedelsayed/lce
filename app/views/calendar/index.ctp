<?php echo $this->Html->css('calendarnew/calendar');?>
<?php echo $this->Javascript->link('calendarnew/jquery.mousewheel-3.0.2.pack',false);?>
<?php echo $this->Javascript->link('calendarnew/jquery.fancybox-1.3.1',false);?>
<?php 
$year = isset($this->params['named']['year'])?$this->params['named']['year']:date("Y");
$month = isset($this->params['named']['month'])?$this->params['named']['month']:date("m");
$month_letter = isset($this->params['named']['month'])?$this->params['named']['month']:date("M");
$day = isset($this->params['named']['day'])?$this->params['named']['day']:date("d");
$day_letter = isset($this->params['named']['day'])?$this->params['named']['day']:date("D");
$first_of_month = mktime(0, 0, 0, $month, 1, $year);
$num_days = cal_days_in_month(0, $month, $year);
$first_of_month_number = date('w', $first_of_month);
$week_days = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat','Sun','Mon','Tue','Wed','Thu','Fri','Sat');
$today = date("d");
$todaymonth = date("m");
$todaymonth_letter = date("M");
$todayyear = date("Y");
$today_letter = date("D");	
//set url 
$url = $this->params['url']['url'];
if(isset($this->params['named']['year']))
	$url = str_replace("/year:".$year, "", $url);
if(isset($this->params['named']['month']))
	$url = str_replace("/month:".$month, "", $url);
if(isset($this->params['named']['day']))
	$url = str_replace("/day:".$day, "", $url);				
if($url == $this->params['controller'] || $url == $this->params['controller'].'/')
	$url = $url.'/index';		
?>
<div class="events index">
	<div class="add_action_button"><?php echo $this->Html->link(__('Add Event', true), array('controller' => 'events', 'action' => 'add')); ?></div>
	<div id="calendar">
		<div>
			<table class="calendarnew">
				<thead>
					<tr>
			            <th colspan="2" class="cell-header">
			                <?php echo $html->link('<<', array('controller' => $url.'/month:'.($month-1).'/year:'.$year) ); ?> 
			                <div><?php echo date('F', $first_of_month); ?></div> 
			                <?php echo $html->link('>>', array('controller' => $url.'/month:'.($month+1).'/year:'.$year) ); ?>
			            </th>
			            <th colspan="3"><?php echo date('F Y', $first_of_month); ?></th>
			            <th colspan="2" class="cell-header">
			                <?php echo $html->link('<<', array('controller' => $url.'/year:'.($year-1).'/month:'.$month) ); ?> 
			                <div><?php echo date('Y', $first_of_month); ?></div>
			                <?php echo $html->link('>>', array('controller' => $url.'/year:'.($year+1).'/month:'.$month) ); ?>
			            </th>
			        </tr>
		        </thead>
	        </table>
		</div>
		<div class="event_grey">
			<div class="event_today">WHAT'S ON TODAY</div>
			<div class="event_date">
				<div class="event_date_day"><?php echo $today;?></div>
				<div class="event_date_month_year"><?php echo $todaymonth_letter;?></div>
				<div class="event_date_month_year"><?php echo $todayyear;?></div>
				<div class="event_date_day_small"><?php echo $today_letter;?></div>
			</div>
			<?php $events = $this->requestAction('calendar/getEvents/'.$todayyear.'/'.$todaymonth.'/'.$today);?>
			<?php if(!empty($events)){
				///$j = 0;?>
				<?php /*<script type="text/javascript">
				$(document).ready(function() {	
					$(".various<?php echo $j;?>").fancybox({
						'titlePosition'		: 'inside',
						'transitionIn'		: 'none',
						'transitionOut'		: 'none'
					});												
				});										
				</script>*/?>	
				<?php /*if(isset($events[0]['Gal'][0]['image'])) {?>								
					<div class="event_img">
						<a class="various<?php echo $j;?>" href="#inline<?php echo $j;?>">
							<img src="<?php echo $base_url.'/app/webroot/img/upload/thumb_'.$events[0]['Gal'][0]['image']?>" width="117"/>
						</a>																
					</div>
				<?php }?>
				<div class="event_title">
					<a class="various<?php echo $j;?>" href="#inline<?php echo $j;?>"><?php echo $events[0]['Event']['title'];?></a>
				</div>
				<div class="event_data">
					<?php echo $events[0]['Event']['title'];?>
				</div>
				<?php /*<div style="display: none;">
					<div id="inline<?php echo $j++;?>" style="width:500px;height:auto;overflow:auto;">
						<?php if(isset($events[0]['Gal'][0]['image'])) {?>
							<div class="fancybox_img">
								<img src="<?php echo $base_url.'/app/webroot/img/upload/thumb_'.$events[0]['Gal'][0]['image']?>" width="117"/>
							</div>
						<?php }?>
						<div class="fancybox_title_data">
							<div class="fancybox_title">
								<a><?php echo $events[0]['Event']['title'];?></a>
							</div>
							<div class="fancybox_data">
								<?php echo $events[0]['Event']['agenda'];?>
							</div>
						</div>
					</div>
				</div>*/?>
				<?php //array_shift($events);
				if(!empty($events)){?>
					<div class="other_events">
						<?php /*<div class="other_events_title">Other Events:</div>*/?>
						<?php foreach($events as $event){?>
							<?php /*<script type="text/javascript">
							$(document).ready(function() {	
								$(".various<?php echo $j;?>").fancybox({
									'titlePosition'		: 'inside',
									'transitionIn'		: 'none',
									'transitionOut'		: 'none'
								});												
							});										
							</script>*/?>
							<div class="event_title">
								<a href="<?php echo $base_url.'/events/view/'.$event['Event']['id'];?>"><?php echo $event['Event']['title'];?></a>
							</div>
							<?php /*<div style="display: none;">
								<div id="inline<?php echo $j++;?>" style="width:500px;height:auto;overflow:auto;">
									<?php if(isset($event['Gal'][0]['image'])) {?>														
										<div class="fancybox_img">
											<img src="<?php echo $base_url.'/app/webroot/img/upload/thumb_'.$event['Gal'][0]['image']?>" width="117"/>
										</div>
									<?php }?>
									<div class="fancybox_title_data">
										<div class="fancybox_title">
											<a><?php echo $event['Event']['title'];?></a>
										</div>
										<div class="fancybox_data">
											<?php echo $event['Event']['agenda'];?>
										</div>
									</div>
								</div>
							</div>*/?>
						<?php }?>	
					</div>									
				<?php }?>									
			<?php }else{?>
				<div class="event_data">
					Today has no Events									
				</div>
			<?php }?>
		</div>
		<?php for($i=1;$i<=$num_days;$i++){
			$events = $this->requestAction('calendar/getEvents/'.$year.'/'.$month.'/'.$i);																							
			if($i==4||$i==8||$i==13||$i==18||$i==23||$i==28){
				$style = 'border-right-width: 0px;width:150px;';
			}
			elseif($i==29||$i==30||$i==31){
				$style = 'border-bottom-width: 0px;';
			}
			else{
				$style = '';
			}
			if($i%7==1){
				$day_in_calendar = $first_of_month_number;
				$first_of_month_letter = $week_days[$day_in_calendar];
			}
			elseif($i%7==2){
				$day_in_calendar = $first_of_month_number+1;
				$first_of_month_letter = $week_days[$day_in_calendar];
			}
			elseif($i%7==3){
				$day_in_calendar = $first_of_month_number+2;
				$first_of_month_letter = $week_days[$day_in_calendar];
			}
			elseif($i%7==4){
				$day_in_calendar = $first_of_month_number+3;
				$first_of_month_letter = $week_days[$day_in_calendar];
			}
			elseif($i%7==5){
				$day_in_calendar = $first_of_month_number+4;
				$first_of_month_letter = $week_days[$day_in_calendar];
			}
			elseif($i%7==6){
				$day_in_calendar = $first_of_month_number+5;
				$first_of_month_letter = $week_days[$day_in_calendar];
			}
			elseif($i%7==0){
				$day_in_calendar = $first_of_month_number+6;
				$first_of_month_letter = $week_days[$day_in_calendar];
			}
			?>
			<div class="event" style="<?php echo $style;?>">
				<div class="event_today"><?php echo $i.' '.$first_of_month_letter;?></div>
				<?php if(!empty($events)){
					/*$j = 0;?>
					<script type="text/javascript">
					$(document).ready(function() {	
						$(".various<?php echo $i.$j;?>").fancybox({
							'titlePosition'		: 'inside',
							'transitionIn'		: 'none',
							'transitionOut'		: 'none'
						});												
					});										
					</script>
					<?php if(isset($events[0]['Gal'][0]['image'])) {?>
						<div class="event_img2">											
							<a class="various<?php echo $i.$j;?>" href="#inline<?php echo $i.$j;?>">
								<img src="<?php echo $base_url.'/app/webroot/img/upload/thumb_'.$events[0]['Gal'][0]['image']?>" width="117"/>
							</a>																											
						</div>
					<?php }?>
					<div class="event_title">
						<a href="<?php echo $base_url.'/events/view/'.$event['Event']['id'];?>"><?php echo $events[0]['Event']['title'];?></a>
					</div>
					<div style="display: none;">
						<div id="inline<?php echo $i.$j++;?>" style="width:500px;height:auto;overflow:auto;">
							<?php if(isset($events[0]['Gal'][0]['image'])) {?>
								<div class="fancybox_img">
									<img src="<?php echo $base_url.'/app/webroot/img/upload/thumb_'.$events[0]['Gal'][0]['image']?>" width="117"/>
								</div>
							<?php }?>
							<div class="fancybox_title_data">
								<div class="fancybox_title">
									<a><?php echo $events[0]['Event']['title'];?></a>
								</div>
								<div class="fancybox_data">
									<?php echo $events[0]['Event']['agenda'];?>
								</div>
							</div>
						</div>
					</div>
					<?php array_shift($events);*/
					if(!empty($events)){?>
						<?php  foreach($events as $event){?>
							<?php /*<script type="text/javascript">
							$(document).ready(function() {	
								$(".various<?php echo $i.$j;?>").fancybox({
									'titlePosition'		: 'inside',
									'transitionIn'		: 'none',
									'transitionOut'		: 'none'
								});												
							});										
							</script>*/?>
							<div class="event_title">
								<a href="<?php echo $base_url.'/events/view/'.$event['Event']['id'];?>"><?php echo $event['Event']['title'];?></a>
							</div>
							<?php /*<div style="display: none;">
								<div id="inline<?php echo $i.$j++;?>" style="width:500px;height:auto;overflow:auto;">
									<?php if(isset($event['Gal'][0]['image'])) {?>														
										<div class="fancybox_img">
											<img src="<?php echo $base_url.'/app/webroot/img/upload/thumb_'.$event['Gal'][0]['image']?>" width="117"/>
										</div>
									<?php }?>
									<div class="fancybox_title_data">
										<div class="fancybox_title">
											<a><?php echo $event['Event']['title'];?></a>
										</div>
										<div class="fancybox_data">
											<?php echo $event['Event']['agenda'];?>
										</div>
									</div>
								</div>
							</div>*/?>
						<?php }?>										
					<?php }?>
				<?php }?>
			</div>
		<?php }?>
	</div>
</div>