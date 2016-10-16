<script src="<?php echo $base_url;?>/sliderengine/amazingslider.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>/sliderengine/amazingslider-1.css">
<script src="<?php echo $base_url;?>/sliderengine/initslider-1.js"></script>  
<div class="events view">
	<?php $member_id = 0;
	if(isset($userInfoFront['id'])){
		$member_id = $userInfoFront['id'];
	}	
	if(($event['Event']['member_id'] == $member_id) || $isAdmin == 1){?>
		<div class="cancel_button">
			<?php echo $this->Html->link(__('Cancel Event', true), array('action' => 'delete', $event['Event']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $event['Event']['id'])); ?>
		</div>
	<?php }?>
<?php /*<h2><?php  __('Event');?></h2>*/?>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<?php /*<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $event['Event']['id']; ?>
			&nbsp;
	</dd>*/?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $event['Event']['title']; ?>
			&nbsp;
		</dd>		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Brief'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $event['Event']['brief']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Image'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php $image = '';
			if(isset($event['Event']['image'])){
				$image = $event['Event']['image'];
			}
			echo $this->element('forum/image_view', array('image' => array('id' => $event['Event']['id'], 'image' => $image), 'size' => 'master'));?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Location'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $event['Event']['location']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('From Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $event['Event']['from_date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('To Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $event['Event']['to_date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('From Time'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $event['Event']['time_from']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('To Time'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $event['Event']['time_to'];?>
			&nbsp;
		</dd>
		<?php if($event['Event']['ticket_price'] > 0){?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ticket Price'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $event['Event']['ticket_price']; ?>
				&nbsp;
			</dd>
		<?php }?>
		<?php if(!empty($saved_instructors)){?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Instructors'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<div class="instructors">
					<?php $instructors_title = '';
					if(!empty($instructors)){
						$i = 0;
						foreach ($instructors as $key => $value) {
							if(in_array($key, $saved_instructors)){
								$icon = '';					
								if($i == 0){
									$icon = '<i class="icon_name"></i>';
								}else{
									$icon = '<i class="icon_name no_icon"></i>';
								}
								$i++;
								$instructors_title .= '<div class="instructor_bio_wrap">'.$icon.''.$value.' <a class="instructor_bio_link" onclick="open_instructor('.$key.');">bio</a></div> ';							
							}
						}
					}
					$instructors_title = trim(trim($instructors_title), ',');
					echo $instructors_title;?>				
				</div>
			</dd>		
		<?php }?>
		<?php if($event['Event']['type'] == 2){?>
			<?php if(trim($event['Event']['agenda_word_file']) != ''){?>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Agenda Word File'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $this->element('forum/embed_google_file_iframe', array('file' => $event['Event']['agenda_word_file']));?>
				</dd>
			<?php }?>
			<?php if(trim($event['Event']['minutes_of_meeting_file']) != ''){?>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Minutes Of Meeting File'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $this->element('forum/embed_google_file_iframe', array('file' => $event['Event']['minutes_of_meeting_file']));?>
				</dd>
			<?php }?>
			<?php if(trim($event['Event']['p_and_l_sheet']) != ''){?>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('P And L Sheet'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $this->element('forum/embed_google_file_iframe', array('file' => $event['Event']['p_and_l_sheet']));?>
				</dd>
			<?php }?>
		<?php }?>
		<dt class="willyoucome">Will you come?</dt>
		<dd>
			<?php if($attendEventFlag == -1){?>
				<a href="<?php echo $base_url.'/events/willcome/'.$event['Event']['id'].'/1';?>"><?php echo $willyoucome_options[1];?></a> | 
				<a href="<?php echo $base_url.'/events/willcome/'.$event['Event']['id'].'/2';?>"><?php echo $willyoucome_options[2];?></a> | 
				<a href="<?php echo $base_url.'/events/willcome/'.$event['Event']['id'].'/0';?>"><?php echo $willyoucome_options[0];?></a>	
			<?php }else{
				echo $willyoucome_options[$attendEventFlag];			
			}?>
		</dd>
	</dl>
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
	<?php if(!empty($event['Gal'])){?>
        <div class="slide_galary">
            <div id="amazingslider-wrapper-1" style="display:block;position:relative;max-width:1200px;margin:0px auto 150px;">
                <div id="amazingslider-1" style="display:block;position:relative;margin:0 auto;">
                    <ul class="amazingslider-slides" style="display:none;">
                        <?php foreach ($event['Gal'] as $key => $value) {
                            $image = $value['url'];?>
                            <li>
                            	<?php echo $this->element('forum/embed_google_image', array('file' => $image));?>
                            </li>
                        <?php }?>
                    </ul>
                    <ul class="amazingslider-thumbnails" style="display:none;">
                        <?php foreach ($event['Gal'] as $key => $value) {
                            $image = $value['url'];?>
                            <li>
                            	<?php echo $this->element('forum/embed_google_image', array('file' => $image));?>
                            </li>
                        <?php }?>
                    </ul>
                </div>
            </div>
        </div>      
    <?php }?>      
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
    hideamazingsliderdiv();
});
function hideamazingsliderdiv () {
    jQuery('a').each(function(){ 
    	var hrefcode = 'http://amazingslider.com';
        var hrefdata = this.href;
        if(this.href.indexOf(hrefcode) !== -1){
            jQuery(this).parent('div').hide();            
        }
    });
}
</script>