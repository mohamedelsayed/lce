<div class="t_p_con index">
	<?php if(isset($group)){
		$group_title = $group['Group']['title'];?>
		<div class="group_title">
			<h2><?php echo $group_title;?></h2>
		</div>				
	<?php }?>
	<?php $key = '';
	if(isset($_GET['key'])){
		$key = $_GET['key'];
	}?>
	<div class="filter_form">
		<?php echo $this->Form->create('Member', array('url' => $actual_link, 'type' => 'get'));
		echo $this->Form->input('Member'.'.'.'key', array('label' => '', 'value' => $key));
		echo $this->Form->end(__('Search', true));?>
	</div>
	<?php if(!empty($members)){?>
		<?php foreach ($members as $key => $member) {
			$member_link = $base_url.'/members/view/'.$member['Member']['id'];
			$image = '';
			if($member['Member']['image'] != ''){
				$image = $base_url.'/img/upload/'.$member['Member']['image'];
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
			$img_src = $base_url.'/'.'img'.'/'.'forum'.'/'.'default_user_thumbnail.png';
			if($member['Member']['image'] != ''){
				$img_src = $base_url.'/'.'img'.'/'.'upload'.'/'.$member['Member']['image'];
			}
			$group_title = '';
			$group_url = '#';
			if(isset($member['Group']['title'])){
				if($member['Group']['title'] != ''){
					$group_title = $member['Group']['title'];
					$group_url = $base_url.'/members/group/'.$member['Group']['id'];
				}
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
					<?php if($group_title != ''){?>			
						<div class="usermobile user_group_title">
							<?php echo 'Group: <a href="'.$group_url.'">'.$group_title.'</a>';?>
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
<style type="text/css">
.filter_form .input{
	width: 30%;
	margin-left: 0px;
}
.filter_form .submit{
	float: left;
}
</style>