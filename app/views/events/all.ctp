<div class="t_p_con index">
	<div class="add_action_button"><?php echo $this->Html->link(__('Add Event', true), array('action' => 'add')); ?></div>
	<?php if(!empty($events)){?>
		<?php foreach ($events as $key => $event) {
			$event_link = $base_url.'/events/view/'.$event['Event']['id'];
			$title = '';
			if($event['Event']['title'] != ''){
				$title = $event['Event']['title'];
			}
			?>
			<div class="con_con">
				<a href="<?php echo $event_link;?>" title="<?php echo $title;?>">
					<div class="mm_top"><?php echo $title;?></div>
				</a>
		    </div>	
        <?php }?>
    <?php }else{?>
    	<div class="no-data-found">No data found.</div>
	<?php }?>
	<?php echo $this->element('front/paging_view');?>
</div>