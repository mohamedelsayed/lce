<?php $i = 0;
if(!empty($teamMembersCommunity)){?>
	<div class="img_about team_member_all_div_two" style="border-top: 2px solid #404041;padding-top: 20px;margin-top: 20px;">		        				
		<?php foreach ($teamMembersCommunity as $key => $teamMember) {
			$i++;
			$class = '';
			if($i%5 == 0){
				$class = 'team_member_div_two_special';
			}
			$image_team_member = $this->Session->read('Setting.url').'/img/upload/thumb_'.$teamMember['TeamMember']['image'];?>
			<div class="team_member_div_two <?php echo $class;?>" id="teammemberdiv<?php echo $teamMember['TeamMember']['id'];?>">
				<div class="img_about_2 team_member_image_div_two">
					<a class="teamMemberanchor teammember<?php echo $teamMember['TeamMember']['id'];?>">
						<img id="teammemberimage<?php echo $teamMember['TeamMember']['id'];?>" class="img_cly team_member_image_two" src="<?php echo $image_team_member;?>"/>
					</a>
				</div>
				<div class="a_con team_member_title_postion_div_two">
					<div id="teammembername<?php echo $teamMember['TeamMember']['id'];?>" class="top_a_con_2 team_member_title_div_two teammember<?php echo $teamMember['TeamMember']['id'];?>"><?php echo $teamMember['TeamMember']['name'];?></div>
					<div class="top_a_con_3 team_member_postion_div_two teammember<?php echo $teamMember['TeamMember']['id'];?>"><?php echo $teamMember['TeamMember']['position'];?></div>
				</div>
			</div>
			<script type="text/javascript">
				$(document).ready(function(){
					$('.teammember<?php echo $teamMember['TeamMember']['id'];?>').click(function(){
						$('.team_member_div_three2').removeClass('team_member_current');
						$('#team_member_view<?php echo $teamMember['TeamMember']['id'];?>').addClass('team_member_current');
						$('html, body').animate({
					        scrollTop: $("#team_member_div_line2").offset().top
					    }, 1000);
				    });
				    $("#teammemberdiv<?php echo $teamMember['TeamMember']['id'];?>").hover(function(){
				    	$('.team_member_title_div_two').removeClass('team_member_name_hover');
				    	$('.team_member_image_two').removeClass('team_member_image_hover');
				    	$("#teammembername<?php echo $teamMember['TeamMember']['id'];?>").addClass('team_member_name_hover');
				    	$("#teammemberimage<?php echo $teamMember['TeamMember']['id'];?>").addClass('team_member_image_hover');
			    	},function(){
			    		$('.team_member_title_div_two').removeClass('team_member_name_hover');	
			    		$('.team_member_image_two').removeClass('team_member_image_hover');								    		
			    	});
				});
			</script>
		<?php }?>
	</div>
<?php }?>
<div id="team_member_div_line2"></div>
<?php $i = 0;
if(!empty($teamMembersCommunity)){?>
	<?php foreach ($teamMembersCommunity as $key => $teamMember) {
		$i++;
		$class = '';
		if($i == 1){
			$class = 'team_member_current';
		}
		$image_team_member = $this->Session->read('Setting.url').'/img/upload/thumb_'.$teamMember['TeamMember']['image'];
		$linkedin = '';
		if($teamMember['TeamMember']['linkedin'] != ''){
			$linkedin = $teamMember['TeamMember']['linkedin']; 
			$replace = '';$search1 = 'https://www.linkedin.com';
			$search2 = 'http://www.linkedin.com';
			$search3 = 'https://linkedin.com';
			$search4 = 'http://linkedin.com';
			$linkedin = str_replace($search1, $replace, $linkedin);
			$linkedin = str_replace($search2, $replace, $linkedin);
			$linkedin = str_replace($search3, $replace, $linkedin);
			$linkedin = str_replace($search4, $replace, $linkedin);   								
		}
		$mail = '';
		if($teamMember['TeamMember']['mail'] != ''){
			$mail = $teamMember['TeamMember']['mail'];    								
		}?>
		<div class="team_member_div_three2 <?php echo $class;?>" id="team_member_view<?php echo $teamMember['TeamMember']['id'];?>">
			<div class="team_member_left_div_three">
				<div class="img_mm_2 team_member_image_div_three">
					<a>
						<img src="<?php echo $image_team_member;?>"/>
					</a>
				</div>										
			</div>
			<div class="team_member_right_div_three">
				<div class="bot_mm team_member_postion_div_three"><?php echo $teamMember['TeamMember']['name'];?> | <?php echo $teamMember['TeamMember']['position'];?></div>
				<?php if($mail != ''){?>
					<div class="img_about team_member_mail_div_three">
						<div class="tertr team_member_mail_image_div_three">
							<a href="mailto:<?php echo $mail;?>">
								<img src="<?php echo $this->Session->read('Setting.url').'/img/front/';?>icon_mail_red.png"/>
							</a>
						</div>
						<div class="top_co8 team_member_mail_inner_div_three">
							<a href="mailto:<?php echo $mail;?>"><?php echo $mail;?></a>
						</div>
					</div>
				<?php }?>
				<?php if($linkedin != ''){?>
					<div class="img_about team_member_twitter_div_three">
						<div class="tertr team_member_twitter_image_div_three">
							<a target="_blank" href="<?php echo $teamMember['TeamMember']['linkedin'];?>" >
								<img src="<?php echo $this->Session->read('Setting.url').'/img/front/';?>linkedin_team.png"/>
							</a>
						</div>
						<div class="top_co8 team_member_twitter_inner_div_three">
							<a target="_blank" href="<?php echo $teamMember['TeamMember']['linkedin'];?>" ><?php echo $linkedin;?></a>
						</div>
					</div>
				<?php }?>
				<div class="top_con5 team_member_body_div_three"><?php echo $teamMember['TeamMember']['biography'];?></div>
			</div>
		</div>
	<?php }?>
<?php }?>