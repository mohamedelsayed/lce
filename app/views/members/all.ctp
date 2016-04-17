<div class="t_p_con index">
	<?php if(!empty($members)){?>
		<?php foreach ($members as $key => $member) {
			$member_link = $this->Session->read('Setting.url').'/members/view/'.$member['Member']['id'];
			$image = '';
			if($member['Member']['image'] != ''){
				$image = $this->Session->read('Setting.url').'/img/upload/'.$member['Member']['image'];
			}
			$fullname = '';
			if($member['Member']['fullname'] != ''){
				$fullname = $member['Member']['fullname'];
			}
			$email = '';
			if($member['Member']['email'] != ''){
				$email = $member['Member']['email'];
			}
			$mobile = '';
			if($member['Member']['mobile'] != ''){
				$mobile = $member['Member']['mobile'];
			}
			$job_title = '';
			if($member['Member']['job_title'] != ''){
				$job_title = $member['Member']['job_title'];
			}
			$img_src = $this->Session->read('Setting.url').DS.'img'.DS.'forum'.DS.'default_user_thumbnail.png';
			if($member['Member']['image'] != ''){
				$img_src = $this->Session->read('Setting.url').DS.'img'.DS.'upload'.DS.$member['Member']['image'];
			}?>
			<div class="userdata">				
				<div class="contacts_member_image">
					<a href="<?php echo $member_link;?>" title="<?php echo $fullname;?>">
						<img src="<?php echo $img_src;?>" alt="<?php echo $fullname;?>"/>
					</a>
				</div>
				<div class="contacts_userdataother">
					<a href="<?php echo $member_link;?>" title="<?php echo $fullname;?>">
						<div class="userdataname">
							<?php echo $fullname;?>
						</div>
					</a>
					<?php if($email != ''){?>		    	
						<div class="useremail">
							<?php echo 'Email: '.$email;?>
						</div>
					<?php }?>		
					<?php if($mobile != ''){?>			
						<div class="usermobile">
							<?php echo 'Mobile: '.$mobile;?>
						</div>
					<?php }?>
					<?php if($job_title != ''){?>			
						<div class="usermobile">
							<?php echo 'Job Title: '.$job_title;?>
						</div>
					<?php }?>
				</div>
			</div>
        <?php }?>
    <?php }else{?>
    	<div class="no-data-found">No data found.</div>
	<?php }?>
	<?php echo $this->element('front/paging_view');?>
</div>