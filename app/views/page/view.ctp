<?php $tree = array(array('url' => '/page/view/'.$cat['Cat']['id'], 'str' => $cat['Cat']['title']));
echo $this->element('front'.DS.'breadcrumb', array('tree' => $tree));?>
<?php if(!empty($nodes)){?>
	<ul class="tabs">
		<?php $i = 1;
		foreach ($nodes as $key => $node) {
			$class = '';
			if($i == 1){
				$class = 'current';
			}?>
			<li id="node<?php echo $node['Node']['id'];?>" class="tab-link  <?php echo $class;?>" data-tab="tab-<?php echo $i++;?>"><?php echo $node['Node']['title'];?></li>
		<?php }?>
	</ul>
	<?php $i = 1;
	foreach ($nodes as $key => $node) {
		$class = '';
		$divimgclass = '';
		$divopencode = '';
		$divclosecode = '';
		if($i == 1){
			$class = 'current';
		}
		if($node['Node']['id'] == 4){
			$divimgclass = 'bottom_page_image_client';
			$divopencode = '<div class="bottom_page_image_client_div">';
			$divclosecode = '</div>';
		}?>
		<div id="tab-<?php echo $i++;?>" class="tab-content <?php echo $class;?>">
			 <div class="tab-content_top">
			 	<div class="top_con">
			 		<?php /*<div class="top_con_2"><?php echo $cat['Cat']['title'];?></div>
			 		<div class="top_con_3"><?php echo $node['Node']['title'];?></div>*/?>
			 		<?php if($node['Node']['top_image'] == 1){?>
				 		<?php if(isset($node['Gal'][0])){?>
				 			<div class="img_about top_page_image">
					 			<img src="<?php echo $base_url.'/img/upload/'.$node['Gal'][0]['image'];?>"/>
				 			</div>
				 			<?php unset($node['Gal'][0]);?>
			 			<?php }?>
		 			<?php }?>
		 			<?php if(trim(strip_tags($node['Node']['body'])) != ''){?>
			 			<div class="top_con_4">
			 				<?php echo $node['Node']['body'];?>
		 				</div>
	 				<?php }?>
	 				<?php if(!empty($node['Gal'])){?>
				 		<?php foreach ($node['Gal'] as $key => $value) {
				 			echo $divopencode;?>
				 			<div class="bot_logo bottom_page_image <?php echo $divimgclass;?>">
					 			<img src="<?php echo $base_url.'/img/upload/'.$value['image'];?>"/>
				 			</div>
			 			<?php echo $divclosecode;
						}?>
		 			<?php }?>
		 			<?php if($node['Node']['id'] == 2){
		 				if(!empty($teamMembers2)){
			        		foreach ($teamMembers2 as $key => $teamMember) {
			        			//$image_team_member = $base_url.'/img/upload/thumb_'.$teamMember['TeamMember']['image'];
			        			$max_height = 'max-height:100%;';
							    $max_width  = 'max-width:100%;';
								$default_user_image = BASE_URL.$default_user_image;			
								$image = $default_user_image;
								$style = $max_width;
								if(trim($teamMember['TeamMember']['image']) != ''){
									$div_ratio = 300/300;
									$img = $teamMember['TeamMember']['image'];
							    	$image = BASE_URL.'/img/upload/'.$img;     					     
							        $image_path = WWW_ROOT.'img'.DS.'upload'.DS.$img;    									
							        $style = $max_width;
									if (file_exists($image_path)) { 
							            $image_size = getimagesize($image_path);          		                
							            if(!empty($image_size)){
							                $width = $image_size[0];
							                $height = $image_size[1];   
							                $image_ratio = $width/$height;
							                if($image_ratio > $div_ratio){                  
							                    $style = $max_height;
							                }
							            }
									}else{
										$image = $default_user_image;
									}
								}?>
			        			<div class="board_members_div" id="member<?php echo $teamMember['TeamMember']['id'];?>">
			        				<div class="board_members_left">
			        					<div class="img_cly_2 board_members_image">
		        							<img style="<?php echo $style;?>" src="<?php echo $image;?>" />
	        							</div>	        							
        							</div>
        							<div class="board_members_right">
        								<div class="board_members_title">
        									<?php echo $teamMember['TeamMember']['name'];?>
    									</div>
        								<div class="board_members_position">
        									<?php echo $teamMember['TeamMember']['position'];?>
    									</div>        							
	        							<div class="top_con_6 board_members_body">
	        								<?php echo $teamMember['TeamMember']['biography'];?>
	    								</div>
    								</div>
								</div>
							<?php }?>
						<?php }?>							
	 				<?php }?>
	 				<?php if($node['Node']['id'] == 3){
	 					$i = 0;
		 				if(!empty($teamMembers3)){?>
		        			<div class="img_about team_member_all_div_two">	
		        				<h2 class="coaches_instructors" style="margin-top: 0px;">LCE Coaches/Instructors</h2>	        				
        						<?php foreach ($teamMembers3 as $key => $teamMember) {
        							$i++;
									$class = '';
									if($i%5 == 0){
										$class = 'team_member_div_two_special';
									}
        							$image_team_member = $base_url.'/img/upload/thumb_'.$teamMember['TeamMember']['image'];?>
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
												$('.team_member_div_three').removeClass('team_member_current');
												$('#team_member_view<?php echo $teamMember['TeamMember']['id'];?>').addClass('team_member_current');
												$('html, body').animate({
											        scrollTop: $("#team_member_div_line").offset().top
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
						<?php }
						$i = 0;
		 				if(!empty($teamMembersCommunity)){?>
		        			<div class="img_about team_member_all_div_two">	
		        				<h2 class="coaches_instructors">DCC Network of Coaches</h2>	        				
        						<?php foreach ($teamMembersCommunity as $key => $teamMember) {
        							$i++;
									$class = '';
									if($i%5 == 0){
										$class = 'team_member_div_two_special';
									}
        							$image_team_member = $base_url.'/img/upload/thumb_'.$teamMember['TeamMember']['image'];?>
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
												$('.team_member_div_three').removeClass('team_member_current');
												$('#team_member_view<?php echo $teamMember['TeamMember']['id'];?>').addClass('team_member_current');
												$('html, body').animate({
											        scrollTop: $("#team_member_div_line").offset().top
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
						<div id="team_member_div_line"></div>
						<?php $i = 0;
		 				if(!empty($teamMembers3)){?>
		 					<?php foreach ($teamMembers3 as $key => $teamMember) {
    							$i++;
								$class = '';
								if($i == 1){
									$class = 'team_member_current';
								}
    							$image_team_member = $base_url.'/img/upload/thumb_'.$teamMember['TeamMember']['image'];
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
								<div class="team_member_div_three <?php echo $class;?>" id="team_member_view<?php echo $teamMember['TeamMember']['id'];?>">
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
														<img src="<?php echo $base_url.'/img/front/';?>icon_mail_red.png"/>
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
														<img src="<?php echo $base_url.'/img/front/';?>linkedin_team.png"/>
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
						<?php //$i = 0;
		 				if(!empty($teamMembersCommunity)){?>
		 					<?php foreach ($teamMembersCommunity as $key => $teamMember) {
    							$i++;
								$class = '';
								if($i == 1){
									$class = 'team_member_current';
								}
    							$image_team_member = $base_url.'/img/upload/thumb_'.$teamMember['TeamMember']['image'];
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
								<div class="team_member_div_three <?php echo $class;?>" id="team_member_view<?php echo $teamMember['TeamMember']['id'];?>">
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
														<img src="<?php echo $base_url.'/img/front/';?>icon_mail_red.png"/>
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
														<img src="<?php echo $base_url.'/img/front/';?>linkedin_team.png"/>
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
						<?php if(isset($_REQUEST['memberid'])){?>
							<script type="text/javascript">
								$(document).ready(function(){
									$('.teammember<?php echo $_REQUEST['memberid'];?>').click();
								});
							</script>
						<?php }?>
						<?php //include_once 'community.php';?>
        			<?php }?>
			        <?php if($node['Node']['id'] == 6){
			        	if(!empty($testimonials)){
			        		foreach ($testimonials as $key => $testimonial) {?>
			        			<div class="out_t" id="testimonial<?php echo $testimonial['Testimonial']['id'];?>">
			        				<div class="pic_t imagetestimonialinner">
			        					<a>
			        						<img src="<?php echo $base_url.'/img/upload/'.$testimonial['Testimonial']['image'];?>"/>
		        						</a>
			    					</div>
			    					<div class="wrie_go">
			    						<div class="top_wrie">
			    							<?php echo $testimonial['Testimonial']['name'];?>
										</div>
										<div class="t_right_2">
											<?php echo $testimonial['Testimonial']['position'];?>
										</div>
										<div class="top_con_5">
											<?php echo '"'.strip_tags($testimonial['Testimonial']['body']).'"';?>
										</div>
									</div>
								</div>
							<?php }?>
						<?php }?>
			    	<?php }?>        
 				</div>
			</div>
        </div>
    <?php }?>
<?php }?>
<?php if(isset($_REQUEST['nodeid'])){?>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#node<?php echo $_REQUEST['nodeid'];?>').click();
		});
	</script>
<?php }?>