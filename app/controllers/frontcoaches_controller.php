<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
class FrontcoachesController  extends AppController {
	var $name = 'Frontcoaches';
	var $uses = 'Coach';	
	function coaches(){
		$this->set('title_for_layout' , 'All Coaches');		
		$this->set('selected','frontcoaches');
		$specializations = $this->Coach->Specialization->find('list');
		$geographys = $this->Coach->Geography->find('list');		
		$this->set(compact('specializations', 'geographys'));	
	}
	function coach($id = 0){
		$this->set('title_for_layout' , 'Coach');		
		$this->set('selected','frontcoaches');	
	}
	function ajax_list_coaches(){
		$base_url = BASE_URL;
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
		$options['order'] = array('Coach.'.$order_field => $order_direction, 'Coach.id' => 'DESC');
		$options['page'] = $page;
		$coaches_all = $this->Coach->find('all', $options);
    	$count = count($coaches_all);
		$page_count = ceil($count / $limit);
		$coaches = array_slice($coaches_all, $start, $limit);
		$i = 0;
		foreach ($coaches as $key => $coach) {
			$coach_url = BASE_URL.'/coach/'.$coach['Coach']['id'];
			$email = $coach['Coach']['email'];
			$default_user_image = BASE_URL.$this->default_user_image;			
			$image = $default_user_image;
			$style = '';
        	if(trim($coach['Coach']['image']) != ''){
        		$div_ratio = 118/118;
        		$img = $coach['Coach']['image'];
            	$image = BASE_URL.'/img/upload/'.$img;     					     
                $image_path = WWW_ROOT.'img'.DS.'upload'.DS.$img;    
				$max_height = 'max-height:100%;';
                $max_width  = 'max-width:100%;';
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
			$geographys = $coach['Geography'];			
			if(!empty($geographys)){
				foreach ($geographys as $key => $geography) {
					if(isset($geography['title'])){
						$geographys_title .= $geography['title'].', ';
					}
				}
			}
			$geographys_title = trim(trim($geographys_title), ',');
			$class = 'post_coach_right';
			$line_div = '<div class="post_coach_conter"></div>';
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
				<img style="'.$style.'" alt="'.$name.'" src="'.$image.'" />
				</a>
				</div>
				<div class="post_coach_right_in">
				<a href="'.$coach_url.'">
				<div class="post_coach_title">'.$name.
				'</a>'.
				'<samp>'.$specializations_title.'</samp></div>';
			if($geographys_title != ''){
				$html .= '<div class="post_coach_phone">'.$geographys_title.'</div>';
			}			
			if($remote_coaching == 1){
				$html .= '<div class="post_coach_phone remote_coaching_div"><samp>Remote Coaching</samp></div>';
			}
			if($statement != ''){
				$html .= '<div class="post_coach_prograf">“'.$statement.'”</div>';
			}
			$html .= '<div class="post_coach_profile">
				<a href="'.$coach_url.'">View Profile</a>
				<samp><a data-url="'.$coach_url.'" class="shareBtn">Recommend this caoch</a></samp>
				</div>';
			if(trim($email) != ''){
				$html .= '<div class="post_coach_sumit">
					<a class="contact_me_button" onclick="contact_me('.$coach['Coach']['id'].')">Contact me</a>
				</div>';
			}
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
    	$html = '';
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
				$message = '';
	    		if(isset($_POST['message'])){
	    			$message = $_POST['message'];    			
	    		}
			}else{
				$html = 'Error';    						
			}
    	}else{
    		$html = 'Error';    		
    	}   
    	$data['html'] = $html;
		echo json_encode($data);
        $this->autoRender = false;           
    }
}