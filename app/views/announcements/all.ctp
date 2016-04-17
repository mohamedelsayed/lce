<div class="t_p_con index">
	<?php if(!empty($announcements)){?>
		<?php foreach ($announcements as $key => $announcement) {
			$announcement_link = $this->Session->read('Setting.url').'/announcements/view/'.$announcement['Announcement']['id'];
			$title = '';
			if($announcement['Announcement']['title'] != ''){
				$title = $announcement['Announcement']['title'];
			}
			$body = '';
			if($announcement['Announcement']['body'] != ''){
				$body = $announcement['Announcement']['body'];
			}?>
			<div class="con_con">
				<a href="<?php echo $announcement_link;?>" title="<?php echo $title;?>">
					<div class="mm_top"><?php echo $title;?></div>
				</a>
		    </div>	
        <?php }?>
    <?php }else{?>
    	<div class="no-data-found">No data found.</div>
	<?php }?>
	<?php echo $this->element('front/paging_view');?>
</div>