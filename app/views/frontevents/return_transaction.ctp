<div class="return_title" style="margin-top: 20px;">
	<?php echo $custom_message;?>
</div>
<?php if($custom_error_flag == 0){?>
	<div class="post_return">
		<?php echo $title;?>
	</div>
	<div class="return_group_left" >
		<div class="post_return_details"><i class="icon_details"></i><?php echo $location;?></div>
		<div class="post_return_name"><i class="icon_name"></i><?php echo $instructor_name;?></div>
		<div class="post_return_date"><i class="icon_date"></i><?php echo $all_date;?></div>
		<div class="post_return_price"><i class="icon_price"></i><?php echo $ticket_price.' '.$currency;?></div>
	</div>
	<div class="return_group_right" >
	<div class="post_return_right"><i class="icon_true"></i>Total paid amount:
		<samp><?php echo $amount.' '.$currency;?></samp></div>
	</div>
<?php }?>
<a href="<?php echo $base_url.'/all-events';?>">
	<div class="return_input_event">Back to upcoming events</div>
</a>