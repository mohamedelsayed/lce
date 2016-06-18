<?php if(!empty($coach)){
	$tree = array(array('url' => '/all-coaches', 'str' => 'FIND A COACH'),
					array('url' => '/coach/'.$coach['Coach']['id'], 'str' => $coach['Coach']['name']));
	echo $this->element('front'.DS.'breadcrumb', array('tree' => $tree));
	$coach_url = BASE_URL.'/coach/'.$coach['Coach']['id'];
	$max_height = 'max-height:100%;';
    $max_width  = 'max-width:100%;';
	$default_user_image = BASE_URL.$default_user_image;			
	$image = $default_user_image;
	$style = $max_width;
	if(trim($coach['Coach']['image']) != ''){
		$div_ratio = 200/200;
		$img = $coach['Coach']['image'];
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
	}
	$name = $coach['Coach']['name'];
	$specializations_title = '';
	$specializations = $coach['Specialization'];			
	if(!empty($specializations)){
		foreach ($specializations as $key => $specialization) {
			if(isset($specialization['title'])){
				$specializations_title .= $specialization['title'].', ';
			}
		}
	}
	$specializations_title = trim(trim($specializations_title), ',');
	$geographys_title = '';
	if($settings['hide_geography'] == 0){
		$geographys = $coach['Geography'];			
		if(!empty($geographys)){
			foreach ($geographys as $key => $geography) {
				if(isset($geography['title'])){
					$geographys_title .= $geography['title'].', ';
				}
			}
		}
		$geographys_title = trim(trim($geographys_title), ',');
	}
	$remote_coaching = $coach['Coach']['remote_coaching'];
	$statement = $coach['Coach']['statement'];
	$email = $coach['Coach']['email'];
	$facebook = $coach['Coach']['facebook'];
	$linkedin = $coach['Coach']['linkedin'];
	$mobile = $coach['Coach']['mobile'];
	$biography = $coach['Coach']['biography'];?>
	<div class="profile_posts_group">
		<div class="post_profile_left">
			<a>
				<div class="post_coach_image post_coach_image2">
					<img style="<?php echo $style;?>" src="<?php echo $image;?>"/>
				</div>
			</a>
			<div class="post_profile_title"><?php echo $name;?><samp><?php echo $specializations_title;?></samp></div>
			<div class="post_profile_phone"><?php echo $geographys_title;?>
				<?php if($remote_coaching == 1){?>
					<samp>Remote Coaching</samp>
				<?php }?>
			</div>
			<div class="post_profile_prograf">
				<?php if($statement != ''){
					echo '“'. substr($statement, 0, 100).'”';
				}?>
			</div>
			<div class="post_profile">
				<a href="<?php echo $coach_url;?>">View Profile</a>
				<samp><a class="shareBtn">Recommend this caoch</a></samp></div>
			<div class="post_profile_sumit"><a data-url="<?php echo $coach_url;?>" onclick="contact_me(<?php echo $coach['Coach']['id'];?>)">Contact me</a></div>
		</div>
		<div class="text_border"></div>
		<div class="post_profile_text">
			<?php if($statement != ''){
				echo $statement;
			}?>
		</div>
	</div>
	<div class="post_profile_text_about"><samp>About Me</samp>
		<?php echo $biography;?>
		<a onclick="contact_me(<?php echo $coach['Coach']['id'];?>)">Contact me</a>
	</div>	
	<?php if(isset($coach['Coach']['video_file'])){
		if($coach['Coach']['video_file'] != ''){?>
			<div class="post_profile_text_video"><samp>Video</samp>				
			<?php echo $this->element('backend/video_player_view', array('video' => array('file' => $coach['Coach']['video_file'], 'image' => '', 'title' => ''), 'width' => 580, 'height' => 320));?>
			</div>
		<?php }
	}?>	
<?php }else{?>
	<div class="no-data-found">No data found.</div>
<?php }?>
<?php include_once 'facebook_share.php'; ?>