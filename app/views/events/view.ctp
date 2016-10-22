<?php $model1 = 'Event';
$model2 = 'Nevent';  
$front = 0;         	
if(isset($event[$model1])){
	$model = $model1;					
}elseif(isset($event[$model2])){
	$model = $model2;			
	$front = 1;		
}
$type = 0;
if(isset($event[$model]['type'])){
	$type = $event[$model]['type'];
}
?>
<script src="<?php echo $base_url;?>/sliderengine/amazingslider.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>/sliderengine/amazingslider-1.css">
<script src="<?php echo $base_url;?>/sliderengine/initslider-1.js"></script>  
<div class="events view">
	<?php $member_id = 0;
	if(isset($userInfoFront['id'])){
		$member_id = $userInfoFront['id'];
	}	
	if($front == 0){
		if(($event[$model]['member_id'] == $member_id) || $isAdmin == 1){?>
			<div class="cancel_button">
				<?php echo $this->Html->link(__('Cancel Event', true), array('action' => 'delete', $event[$model]['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $event[$model]['id'])); ?>
			</div>
		<?php }?>
	<?php }?>
	<?php include_once 'event_item.php';?>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<?php if($type == 2){?>
			<?php if(trim($event[$model]['agenda_word_file']) != ''){?>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Agenda Word File'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $this->element('forum/embed_google_file_iframe', array('file' => $event[$model]['agenda_word_file']));?>
				</dd>
			<?php }?>
			<?php if(trim($event[$model]['minutes_of_meeting_file']) != ''){?>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Minutes Of Meeting File'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $this->element('forum/embed_google_file_iframe', array('file' => $event[$model]['minutes_of_meeting_file']));?>
				</dd>
			<?php }?>
			<?php if(trim($event[$model]['p_and_l_sheet']) != ''){?>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('P And L Sheet'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $this->element('forum/embed_google_file_iframe', array('file' => $event[$model]['p_and_l_sheet']));?>
				</dd>
			<?php }?>
		<?php }?>
		<?php if($front == 0){?>
		<dt class="willyoucome">Will you come?</dt>
		<dd>
			<?php if($attendEventFlag == -1){?>
				<a href="<?php echo $base_url.'/events/willcome/'.$event[$model]['id'].'/1';?>"><?php echo $willyoucome_options[1];?></a> | 
				<a href="<?php echo $base_url.'/events/willcome/'.$event[$model]['id'].'/2';?>"><?php echo $willyoucome_options[2];?></a> | 
				<a href="<?php echo $base_url.'/events/willcome/'.$event[$model]['id'].'/0';?>"><?php echo $willyoucome_options[0];?></a>	
			<?php }else{
				echo $willyoucome_options[$attendEventFlag];			
			}?>
		</dd>
		<?php }?>
	</dl>
	<?php if($front == 0){?>
	<?php 
	$attendEvents1 = '';
	$attendEvents2 = '';
	$attendEvents0 = '';
	$attendEvents1_count = 0;
	$attendEvents2_count = 0;
	$attendEvents0_count = 0;
	$i = 1;
	$guest = 'Guest';
	if(!empty($attendEvents)){
		foreach ($attendEvents as $key => $value) {			
			$member_id = $value['AttendEvent']['member_id'];
			$show_name = 0;
			if($member_id > 0){
				$show_name = 1;
			}
			if($value['AttendEvent']['attend_flag'] == 1){
				$attendEvents1_count++;
				if($show_name == 1){				
					$attendEvents1 .= $this->Html->link($value['Member']['fullname'], array('controller' => 'members', 'action' => 'view', $value['Member']['id'])).', ';				
				}else{
					$attendEvents1 .= $guest.$i++.', ';					
				}
			}
			if($value['AttendEvent']['attend_flag'] == 2){
				$attendEvents2_count++;
				if($show_name == 1){
					$attendEvents2 .= $this->Html->link($value['Member']['fullname'], array('controller' => 'members', 'action' => 'view', $value['Member']['id'])).', ';				
				}else{
					$attendEvents2 .= $guest.$i++.', ';					
				}
			}
			if($value['AttendEvent']['attend_flag'] == 0){
				$attendEvents0_count++;
				if($show_name == 1){
					$attendEvents0 .= $this->Html->link($value['Member']['fullname'], array('controller' => 'members', 'action' => 'view', $value['Member']['id'])).', ';				
				}else{
					$attendEvents0 .= $guest.$i++.', ';					
				}
			}			
		}
	}
	$attendEvents1 = trim($attendEvents1);
	$attendEvents1 = trim($attendEvents1, ',');
	$attendEvents2 = trim($attendEvents2);
	$attendEvents2 = trim($attendEvents2, ',');
	$attendEvents0 = trim($attendEvents0);
	$attendEvents0 = trim($attendEvents0, ',');
	?>	
	<div>
		<h3>Who is coming:</h3>
		<table>
			<tr>
				<td><?php echo $willyoucome_options[1].' ('.$attendEvents1_count.')';?></td>
				<td><?php echo $willyoucome_options[2].' ('.$attendEvents2_count.')';?></td>
				<td><?php echo $willyoucome_options[0].' ('.$attendEvents0_count.')';?></td>
			</tr>
			<tr>
				<td>
					<?php echo $attendEvents1;?>					
				</td>
				<td>
					<?php echo $attendEvents2;?>					
				</td>
				<td>
					<?php echo $attendEvents0;?>					
				</td>
			</tr>
		</table>
	</div>
	<?php }?>
	<?php if(!empty($event['Gal'])){?>
		<div class="home_slider_wapper">
			<ul class="bxslider">
                <?php foreach ($event['Gal'] as $key => $value) {
                    $image = $value['url'];?>
                    <li>
                    	<?php echo $this->element('forum/embed_google_image', array('file' => $image));?>
                    </li>
                <?php }?>
            </ul>
            <div id="bx-pager">
            	<?php $i = 0;
            	foreach ($event['Gal'] as $key => $value) {
                    $image = $value['url'];?>
                    <a data-slide-index="<?php echo $i++;?>" style="cursor: pointer;">
                    	<?php echo $this->element('forum/embed_google_image', array('file' => $image));?>
                	</a>
            	<?php }?>
			</div>
        </div>      
    <?php }?>      
</div>
<script type="text/javascript">
jQuery('.bxslider').bxSlider({
	adaptiveHeight: true,
  	mode: 'horizontal',
  	auto: true,
  	autoControls: true,
  	pagerCustom: '#bx-pager',
});
</script>
<style type="text/css">
	.bx-controls{
		display: none;
	}
</style>