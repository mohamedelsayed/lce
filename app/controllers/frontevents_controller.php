<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
class FronteventsController  extends AppController {
	var $name = 'Frontevents';
	var $uses = 'Nevent';
	function events(){
		$this->set('title_for_layout' , 'All Events');	
		$this->set('selected', 'frontevents');
		$year = isset($_GET['year'])?$_GET['year']:date("Y");
		$month = isset($_GET['month'])?$_GET['month']:date("m");
		$events = $this->Nevent->find('all', array(
            'conditions' => array(
                'AND' => array(
                    'OR' => array(
                        array('AND' => array(
                                'YEAR(Nevent.start_date) = '.$year,
                                'MONTH(Nevent.start_date) = '.$month
                            )
                        ),                          
                    )
                ),                             
            ),
            'order' => array('Nevent.start_date'=>'ASC','Nevent.id'=>'DESC'),
        ));	
        $this->set('events' , $events);
	}
	function get_instructor($id = 0){
        $data = '';
        if($id != 0){
        	$this->loadModel('Instructor');
            $instructor = $this->Instructor->find(
                'first', array(
                    'conditions' => array('Instructor.approved' => 1, 'Instructor.id' => $id),
                )           
            );
            if(!empty($instructor)){
            	$image = '';
				$style = '';
            	if(trim($instructor['Instructor']['image']) != ''){
            		$div_ratio = 200/200;
            		$img = $instructor['Instructor']['image'];
	            	$image = BASE_URL.'/img/upload/'.$img;            
	                $image_path = WWW_ROOT.'img'.DS.'upload'.DS.$img;    
	                $image_size = getimagesize($image_path);          
	                $max_height = 'max-height:100%;';
	                $max_width  = 'max-width:100%;';
	                $style = $max_width;
	                if(!empty($image_size)){
	                    $width = $image_size[0];
	                    $height = $image_size[1];   
	                    $image_ratio = $width/$height;
	                    if($image_ratio > $div_ratio){                  
	                        $style = $max_height;
	                    }
	                }
				}
                $data .= '<h4 style="">'.$instructor['Instructor']['name'].
                	     '<div id="closeinstructorpopoup" class="closeinstructorpopoup">X</div></h4>';
				$data .= '<div class="instructorpopoupbody">';
				if($image != ''){
                    $data .= '<div class="instructorpopouphead instructorpopoupheadimg">
                    	<img style="'.$style.'" src="'.$image.'"/>
                    </div>';
                }				
				$data .= '<div class="instructorpopouphead instructorpopoupposition">Position: </div><div class="instructorpopoupcontent">'.$instructor['Instructor']['position'].'</div>';
				$data .= '<div class="instructorpopouphead instructorpopoupmail"><i class="icon-mail"></i></div><div class="instructorpopoupcontent">'.$instructor['Instructor']['mail'].'</div>';
				$data .= '<div class="instructorpopouphead instructorpopoupposition"><i class="icon-facebook"></i></div><div class="instructorpopoupcontent">'.$instructor['Instructor']['facebook'].'</div>';
				$data .= '<div class="instructorpopouphead instructorpopoupposition"><i class="icon-linkedin"></i></div><div class="instructorpopoupcontent">'.$instructor['Instructor']['linkedin'].'</div>';
				$data .= '<div class="instructorpopouphead instructorpopoupbiography">Biography: </div><div class="instructorpopoupcontent">'.$instructor['Instructor']['biography'].'</div>';                
                $data .= '</div>';
            }
        }
        echo $data;     
        $this->autoRender = false;          
    }
	function return_transaction(){
		$this->set('title_for_layout' , 'Successful Transaction');	
		$this->set('selected', 'frontevents');		
	}
}