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
		$limit = isset($_POST['limit'])? $_POST['limit']:6;
		$page = isset($_POST['page'])? $_POST['page']:1;	
		$order_field = isset($_POST['order_field'])? $_POST['order_field']:'created';	
		$order_direction = isset($_POST['order_direction'])? $_POST['order_direction']:'DESC';	
		$start = ($page - 1) * $limit;
		$conditions = array();
		$conditions['Coach.approved'] = 1;
		if($name != ''){
			$conditions['Coach.name LIKE '] = '%'.$name.'%';			
		}
		$coaches_all = $this->Coach->find(
			'all', array(
				'conditions' => $conditions,
				//'order' => 'RAND()',
				'order' => array('Coach.'.$order_field => $order_direction, 'Coach.id' => 'DESC'),
				'page'	=> $page,
				//'limit' => $limit,
			)	  	 	
		);
		/*$count = $this->Coach->find('count', array(
	    		'conditions' => $conditions,
    		)
    	);*/
    	$count = count($coaches_all);
		$page_count = ceil($count / $limit);
		$coaches = array_slice($coaches_all, $start, $limit);
		$i = 0;
		foreach ($coaches as $key => $coach) {
			$default_image = BASE_URL.'/img/front/coache_default_image.png';
			$image = $default_image;
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
					$image = $default_image;
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
				<a href="#">
				<img style="'.$style.'" alt="'.$name.'" src="'.$image.'" />
				</a>
				</div>
				<div class="post_coach_right_in">
				<div class="post_coach_title">'.$name.'<samp>'.$specializations_title.'</samp></div>';
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
				<a href="#">View Profile</a>
				<samp><a href="#">Recommend this caoch</a></samp>
				</div>
				<div class="post_coach_sumit"><a href="#">Contact me</a></div>
			</div></div>'.$line_div;			
		}
		$data['html'] = $html;
		$data['page_count'] = $page_count;
		$data['nextpage'] = $page+1;
		echo json_encode($data);
        $this->autoRender = false;          
    }
}