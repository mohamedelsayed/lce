<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
class FrontcoachesController  extends AppController {
	var $name = 'Frontcoaches';
	var $uses = 'Coach';
	var $components = array('Email');	
	function coaches(){
		$this->set('title_for_layout' , 'All Coaches');		
		$this->set('selected','frontcoaches');
		$specializations = $this->Coach->Specialization->find('list');
		$geographys = $this->Coach->Geography->find('list');		
		$this->set(compact('specializations', 'geographys'));	
	}
	function coach($id = 0){
		$this->set('title_for_layout' , 'Coach');		
		$this->set('selected', 'frontcoaches');	
		$coach = $this->Coach->read(null, $id);
		$this->set('coach', $coach);	
		if(!empty($coach)){
			$this->set('title_for_layout' , $coach['Coach']['name']);		
		}
		if(isset($coach['Coach']['image'])){
			$image_path = WWW_ROOT.'img'.DS.'upload'.DS.'thumb_'.$coach['Coach']['image'];    
			if (file_exists($image_path)) {
				$this->set('shareImage', 'thumb_'.$coach['Coach']['image']);
			}
		}
		$this->set('metaDescription', $coach['Coach']['statement']);		
	}
	function ajax_list_coaches(){
		$settings = $this->settings;
		$data = array();
        $html = '';
		$name = '';
		if(isset($_POST['name'])){
			$name = trim($_POST['name']);
		}
		$type = 0;
		if(isset($_POST['type'])){
			$type = trim($_POST['type']);
		}
		$coach_specialization = 0;
		if(isset($_POST['coach_specialization'])){
			$coach_specialization = trim($_POST['coach_specialization']);
		}
		$coach_geography = 0;
		if(isset($_POST['coach_geography'])){
			$coach_geography = trim($_POST['coach_geography']);
		}				
		$limit = isset($_POST['limit'])? $_POST['limit']:6;
		$page = isset($_POST['page'])? $_POST['page']:1;	
		$order_field = isset($_POST['order_field'])? $_POST['order_field']:'created';	
		$order_direction = isset($_POST['order_direction'])? $_POST['order_direction']:'DESC';
		$order_field_in = isset($_POST['order_field_in'])? $_POST['order_field_in']:'name';	
		$order_direction_in = isset($_POST['order_direction_in'])? $_POST['order_direction_in']:'DESC';	
		if($type == 1){
			$page = 1;			
		}
		$start = ($page - 1) * $limit;
		$conditions = array();
		$conditions['Coach.approved'] = 1;
		if($name != ''){
			$conditions['Coach.name LIKE '] = '%'.$name.'%';			
		}
		$coach_ids = array();
		$coach_specialization_ids = array();
		if($coach_specialization != 0){
			$this->loadModel('CoachSpecialization');
			$specializations = $this->CoachSpecialization->find('all', 
				array('conditions' => array('CoachSpecialization.specialization_id' => $coach_specialization)));
			if(!empty($specializations)){
				foreach ($specializations as $key => $value) {
					$coach_specialization_ids[] = $value['CoachSpecialization']['coach_id'];				
				}
			}
			$coach_ids = $coach_specialization_ids;
		}
		$coach_geography_ids = array();
		if($coach_geography != 0){
			$this->loadModel('CoachGeography');
			$geographys = $this->CoachGeography->find('all', 
				array('conditions' => array('CoachGeography.geography_id' => $coach_geography)));
			if(!empty($geographys)){
				foreach ($geographys as $key => $value) {
					$coach_geography_ids[] = $value['CoachGeography']['coach_id'];				
				}
			}
			$coach_ids = $coach_geography_ids;
		}		
		if($coach_specialization != 0 && $coach_geography != 0){
			$coach_ids = array_intersect($coach_specialization_ids, $coach_geography_ids);			
		}
		if($coach_specialization != 0 || $coach_geography != 0){
			if(!empty($coach_ids)){
				$coach_ids_text = implode(',', $coach_ids);			
				$conditions['Coach.id'] = $coach_ids;
			}else{
				$conditions['Coach.id < '] = '0';				
			}
		}
		$options['conditions'] = $conditions;
		$options['order'] = array('Coach.'.$order_field => $order_direction, 'Coach.'.$order_field_in => $order_direction_in, 'Coach.id' => 'DESC');
		$options['page'] = $page;
		$coaches_all = $this->Coach->find('all', $options);
    	$count = count($coaches_all);
		$page_count = ceil($count / $limit);
		$coaches = array_slice($coaches_all, $start, $limit);
		shuffle($coaches);
		$i = 0;
		foreach ($coaches as $key => $coach) {
			$coach_url = BASE_URL.'/coach/'.$coach['Coach']['id'];
			$email = $coach['Coach']['email'];
			$max_height = 'max-height:100%;';
		    $max_width  = 'max-width:100%;';
			$default_user_image = BASE_URL.$this->default_user_image;			
			$image = $default_user_image;
			$style = $max_width;
			$image_path = WWW_ROOT.'img'.DS.'upload'.DS.'thumb_'.$coach['Coach']['image'];    
			if (file_exists($image_path)) {
				$image = BASE_URL.''.DS.'img'.DS.'upload'.DS.'thumb_'.$coach['Coach']['image'];
			}
        	/*if(trim($coach['Coach']['image']) != ''){
        		$div_ratio = 118/118;
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
			}*/			
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
			}else{
				$geographys_title = $coach['Coach']['certification'];				
			}
			$class = 'post_coach_right';
			$line_div = '<div class="post_coach_conter"><'.DS.'div>';
			if($i % 2 == 0){
				$class = 'post_coach_left';
				$line_div = '';				
			}
			$remote_coaching = $coach['Coach']['remote_coaching'];
			$statement = $coach['Coach']['statement'];
			$i++;
			$html .= '<div class="'.$class.'">
				<div class="post_coach_left_in">
				<a href="'.$coach_url.'">
				<div class="post_coach_image post_coach_image1">
				<img style="'.$style.'" alt="'.$name.'" src="'.$image.'" />
				</div>
				</a>
				</div>
				<div class="post_coach_right_in">
				<a href="'.$coach_url.'">
					<div class="post_coach_title">'.$name.'</div>'.
				'</a>'.
				'<div class="coach_specializations_in">'.$specializations_title.'</div>';
			if($geographys_title != ''){
				$html .= '<div class="post_coach_phone">'.$geographys_title.'</div>';
			}			
			if($remote_coaching == 1){
				$html .= '<div class="post_coach_phone remote_coaching_div"><samp>Remote Coaching</samp></div>';
			}
			if($statement != ''){
				$html .= '<div class="post_coach_prograf">“'.$statement.'”</div>';
			}
			$html .= '<div class="coach_bottom_wrap">';
			$html .= '<div class="post_coach_profile">
				<a href="'.$coach_url.'">View Profile</a>
				<samp><a data-url="'.$coach_url.'" class="shareBtn">Recommend this coach</a></samp>
				</div>';
			if(trim($email) != ''){
				$html .= '<div class="post_coach_sumit">
					<a class="contact_me_button" onclick="contact_me('.$coach['Coach']['id'].')">Contact me</a>
				</div>';
			}
			$html .= '</div>';
			$html .= '</div></div>'.$line_div;			
		}
		if(count($coaches) == 0){
			if($page == 1){
				$html = '<div class="no-data-found">No data found.</div>';
			}
		}
		$data['html'] = $html;
		$data['page_count'] = $page_count;
		$data['nextpage'] = $page+1;
		echo json_encode($data);
        $this->autoRender = false;          
    }
    function send_coach_mail(){
    	$settings = $this->settings;
    	$data = array();
    	$html = '';
		$error_html = '<h4 style="">'.strtoupper('Error').
						'<div id="closecoachpopoup" class="closecoachpopoup closepopoup">X</div>
						</h4>
						<div class="no-data-found">Error</div>';
    	if(!empty($_POST)){
    		$coach_id = 0;
    		if(isset($_POST['coach_id'])){
    			$coach_id = $_POST['coach_id'];    			
    		}
			if($coach_id != 0){
				$email = '';
	    		if(isset($_POST['email'])){
	    			$email = $_POST['email'];    			
	    		}
				$first_name = '';
	    		if(isset($_POST['first_name'])){
	    			$first_name = $_POST['first_name'];    			
	    		}
				$last_name = '';
	    		if(isset($_POST['last_name'])){
	    			$last_name = $_POST['last_name'];    			
	    		}
				$mobile_number = '';
	    		if(isset($_POST['mobile_number'])){
	    			$mobile_number = $_POST['mobile_number'];    			
	    		}
				$message = '';
	    		if(isset($_POST['message'])){
	    			$message = $_POST['message'];    			
	    		}          
				$coach = $this->Coach->read(null, $coach_id);
				$subject = $settings['title'].' - Contact Me Form';
				/*if(SEND_STMP){
					$this->Email->smtpOptions = array(
						'port' => STMP_PORT,
						'timeout' => STMP_TIMEOUT,
						'host' => STMP_SERVER,
						'username' => STMP_USERNAME,
						'password' => STMP_PASSWORD,
					);
					$this->Email->delivery = 'smtp';
				}*/
				//$this->Email->delivery = 'debug';
	            $this->Email->to = $coach['Coach']['email'];
				$this->Email->subject = $subject;           
				$this->Email->replyTo = $email;
				$this->Email->from = $first_name.' '.$last_name.'<'.$email.'>';                
            	$this->Email->sendAs = 'html'; 	     
	            $this->Email->template = 'sendmailcoach';
				$this->set('subject', $subject);
				$this->set('first_name', $first_name);
				$this->set('last_name', $last_name);
				$this->set('email', $email);
				$this->set('mobile_number', $mobile_number);
				$this->set('message', $message);
				$this->set('coach_admin', 0);
				$this->set('normal_coach', 1);
				$this->set('normal_user', 0);
				//$this->layout = 'ajax';
				//$message_content = $this->render('/elements/email/html/'.$this->Email->template);
				$viewClass = $this->view;
				if ($this->view != 'View') {
					list($plugin, $viewClass) = pluginSplit($viewClass);
					$viewClass = $viewClass . 'View';
					App::import('View', $this->view);
				}
				$View =& new $viewClass($this);				
				$viewFileName = $View->_getViewFileName('/elements/email/html/'.$this->Email->template);
				$message_content = $View->_render($viewFileName, $View->viewVars);		
				$to_emails = array($coach['Coach']['email']);
				$from_email = $email;
				$from_name = $first_name.' '.$last_name;
				$sent = $this->elsayed_send_custom_mail($to_emails, $subject, $message_content, $from_email, $from_name);
        	    /*if ($this->Email->send()){
        	    	$sent = 1;
            	}else{
            		$sent = 0;
					$html = $error_html;
            	}*/
				$name = '';
				if(!empty($coach)){
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
					}else{
						$geographys_title = $coach['Coach']['certification'];				
					}
					$remote_coaching = $coach['Coach']['remote_coaching'];
					$statement = $coach['Coach']['statement'];
					$email2 = $coach['Coach']['email'];
					$facebook = $coach['Coach']['facebook'];
					$linkedin = $coach['Coach']['linkedin'];
					$mobile = $coach['Coach']['mobile'];
				}
				$additional_admin_info = '"'.$name.'"'. 'has recieved this info from contact me form:<br />';
				$this->set('name', $name);
				$this->set('email2', $email2);
				$this->set('facebook', $facebook);
				$this->set('linkedin', $linkedin);
				$this->set('mobile', $mobile);
				$this->set('additional_admin_info', $additional_admin_info);
				$this->set('coach_admin', 1);
				$this->set('normal_coach', 0);
				$this->set('normal_user', 0);
				$emails = explode(',', $settings['coaches_email']);				
				//$this->layout = 'ajax';
				//$message_content = $this->render('/elements/email/html/'.$this->Email->template);
				$viewClass = $this->view;
				if ($this->view != 'View') {
					list($plugin, $viewClass) = pluginSplit($viewClass);
					$viewClass = $viewClass . 'View';
					App::import('View', $this->view);
				}
				$View =& new $viewClass($this);				
				$viewFileName = $View->_getViewFileName('/elements/email/html/'.$this->Email->template);
				$message_content = $View->_render($viewFileName, $View->viewVars);		
				$to_emails = $emails;
				$from_email = $email;
				$from_name = $first_name.' '.$last_name;
				$sent = $this->elsayed_send_custom_mail($to_emails, $subject, $message_content, $from_email, $from_name);
				/*if(!empty($emails)){
					foreach ($emails as $key => $email3) {
						$email3 = trim($email3);
						$this->Email->to = $email3;
						if ($this->Email->send()){
		        	    	//$sent = 1;
		            	}else{
		            		//$sent = 0;
							//$html = $error_html;
		            	}
					}
				}*/				
				$this->set('subject', $subject);				
				$this->set('coach_admin', 0);
				$this->set('normal_coach', 0);
				$this->set('normal_user', 1);
				$this->set('user_full_name', $first_name.' '.$last_name);
				$this->Email->to = $email;
				//$this->layout = 'ajax';
				//$message_content = $this->render('/elements/email/html/'.$this->Email->template);
				$viewClass = $this->view;
				if ($this->view != 'View') {
					list($plugin, $viewClass) = pluginSplit($viewClass);
					$viewClass = $viewClass . 'View';
					App::import('View', $this->view);
				}
				$View =& new $viewClass($this);				
				$viewFileName = $View->_getViewFileName('/elements/email/html/'.$this->Email->template);
				$message_content = $View->_render($viewFileName, $View->viewVars);		
				$to_emails = array($email);
				$from_email = $settings['email'];
				$from_name = $settings['title'];
				$sent = $this->elsayed_send_custom_mail($to_emails, $subject, $message_content, $from_email, $from_name);				
				/*if ($this->Email->send()){
        	    	//$sent = 1;
            	}else{
            		//$sent = 0;
					//$html = $error_html;
            	}*/
				if(true){
					if(!empty($coach)){
						$html = '';
        	    		$coach_url = BASE_URL.'/coach/'.$coach['Coach']['id'];
						$max_height = 'max-height:100%;';
					    $max_width  = 'max-width:100%;';
						$default_user_image = BASE_URL.$this->default_user_image;			
						$image = $default_user_image;
						$style = $max_width;
						$image_path = WWW_ROOT.'img'.DS.'upload'.DS.'thumb_'.$coach['Coach']['image'];    
						if (file_exists($image_path)) {
							$image = BASE_URL.''.DS.'img'.DS.'upload'.DS.'thumb_'.$coach['Coach']['image'];
						}
		            	/*if(trim($coach['Coach']['image']) != ''){
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
						}*/
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
						}else{
							$geographys_title = $coach['Coach']['certification'];				
						}
						$remote_coaching = $coach['Coach']['remote_coaching'];
						$statement = $coach['Coach']['statement'];
						$email = $coach['Coach']['email'];
						$facebook = $coach['Coach']['facebook'];
						$linkedin = $coach['Coach']['linkedin'];
						$mobile = $coach['Coach']['mobile'];
		                $html .= '<h4 style="">'.strtoupper('Contact ME').
		                	     '<div id="closecoachpopoup" class="closecoachpopoup closepopoup">X</div></h4>';
						$html .= '<div class="coachpopoupbody">';
						if($image != ''){
		                    $html .= '<div class="coachpopouphead coachpopoupheadimg coachpopoupleft">
		                    	<div class="post_coach_image post_coach_image3">
		                    		<img style="'.$style.'" src="'.$image.'"/>
		                    	</div>
		                    </div>';
		                }
						$html .= '<div class="coachpopoupright">';				
						$html .= '<div class="coachpopoupname">'.$name.'</div>';
						$html .= '<div class="coachpopoupspecializations">'.$specializations_title.'</div>';
						$html .= '<div class="coachpopoupgeographysout">'; 
						$html .= '<div class="coachpopoupgeographys">'.$geographys_title.'</div>';
						if($remote_coaching == 1){
							$html .= '<div class="coachpopoupremote_coaching">Remote Coaching</div>';
						}
						$html .= '</div>'; 						
						if($statement != ''){
							$html .= '<div class="coachpopoupstatement">“'.'“'. substr($statement, 0, 100).'”'.'”</div>';
						}
						if(trim($mobile) != ''){
							$html .= '<div class="coachpopoupmobile">						
								<div class="coachpopoucenter"><a><i class="icon-mobile"></i>'.$mobile.'</a></div>
							</div>';
						}
						if(trim($email) != ''){
							$html .= '<div class="coachpopoupemail">						
								<div class="coachpopoucenter"><a href="mailto:'.$email.'"><i class="icon-mail"></i>'.$email.'</a></div>
							</div>';
						}
						if(trim($facebook) != ''){
							$html .= '<div class="coachpopoupfacebook">						
								<div class="coachpopoucenter"><a target="_blank" href="'.$facebook.'"><i class="icon-facebook"></i>'.$this->remove_facebook_linkedin_string($facebook).'</a></div>
							</div>';
						}
						if(trim($linkedin) != ''){
							$html .= '<div class="coachpopouplinkedin">						
								<div class="coachpopoucenter"><a target="_blank" href="'.$linkedin.'"><i class="icon-linkedin"></i>'.$this->remove_facebook_linkedin_string($linkedin).'</a></div>
							</div>';
						} 
						$html .= '<div class="post_coach_profile coachpopoupviewprofile">
							<a href="'.$coach_url.'">View Profile</a>
							<samp><a data-url="'.$coach_url.'" class="shareBtn">Recommend this coach</a></samp>
							</div>';										
		                $html .= '</div>';
						$html .= '</div>';
						$html .= '<div class="post_coach_ok">
							<a class="contact_me_button_ok" onclick="close_coach_popup();">OK</a>
						</div>';								
		            }
	            }
			}else{
				$html = $error_html;
			}
    	}else{
    		$html = $error_html;
    	}   
    	$data['html'] = $html;
		echo json_encode($data);exit;
        $this->autoRender = false;           
    }
}