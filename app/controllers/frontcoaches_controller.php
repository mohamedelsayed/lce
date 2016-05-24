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
		$start = ($page - 1) * $limit;
		$conditions = array();
		$conditions['Coach.approved'] = 1;
		if($name != ''){
			$conditions['Coach.name LIKE '] = '%'.$name.'%';			
		}
		$coaches_all = $this->Coach->find(
			'all', array(
				'conditions' => $conditions,
				'order' => 'RAND()',
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
			$name = $coach['Coach']['name'];
			$class = 'post_coach_right';
			$line_div = '<div class="post_coach_conter"></div>';
			if($i % 2 == 0){
				$class = 'post_coach_left';
				$line_div = '';				
			}
			$i++;
			$html .= '<div class="'.$class.'">
				<a href="#">
				<img alt="" src="'.$base_url.'/img/front/pic_coach.png" />
				</a>
				<div class="post_coach_title">'.$name.'<samp>BS Psychology </samp></div>
				<div class="post_coach_phone">Zamalek, Heliopolis and Maadi<samp>Remote Coaching</samp></div>
				<div class="post_coach_prograf">“Lorem Ipsum is simply dummy text of the printing and typesetting industry.” </div>
				<div class="post_coach_profile"><a href="#">View Profile</a><samp><a href="#">Recommend this caoch</a></samp></div>
				<div class="post_coach_sumit"><a href="#">Contact me</a></div>
			</div>'.$line_div;			
		}
		$data['html'] = $html;
		$data['page_count'] = $page_count;
		$data['nextpage'] = $page+1;
		echo json_encode($data);
        $this->autoRender = false;          
    }
}