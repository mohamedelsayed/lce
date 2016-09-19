<div class="index">
	<div class="events_boxes_all">
		<?php foreach ($forum_events_types as $key => $value) {?>
			<div class="event_box">
				<a href="<?php echo $base_url.'/events?type='.$key;?>"><?php echo $value;?></a>
			</div>		
		<?php }?>
		<div class="event_box">
			<a href="<?php echo $base_url.'/forum_instructors';?>">Instructors</a>
		</div>
	</div>
</div>