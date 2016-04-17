<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.lifecoachingegypt.com
 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */
require_once '../authfront_controller.php';
class AgreementsController extends AuthfrontController {
	var $name = 'Agreements';
	var $uses = array('Agreement');
	function index(){
		$this->redirect(array('controller' => 'forum', 'action' => 'index'));
	}
	function agree_disagree(){
		$_return['html'] = '';
		$_return['status'] = '';
		if(!empty($_POST)){
			$_data = $_POST;
			$item_id = $_data['item_id'];
			$item_type = $_data['item_type'];
			$agree_flag = $_data['agree_flag'];
			$member_id = $_data['member_id'];
			$_return['flag'] = $agree_flag;
			$this->data['Agreement'] = $_data;
			$agreement = $this->Agreement->find(
					'first', array(
						'conditions' => array('Agreement.item_id' => $item_id, 'Agreement.item_type' => $item_type, 'Agreement.member_id' => $member_id),
					)	  	 	
				);
			if(empty($agreement)){
				$this->Agreement->create();
				if ($this->Agreement->save($this->data)) {
					$_return['html'] = '';
					$_return['status'] = 'success';					
				}else{
					$_return['html'] = 'Error!';
					$_return['status'] = 'error';									
				}
			}elseif(!empty($agreement)){
				if($agreement['Agreement']['agree_flag'] != $agree_flag){
					$this->Agreement->id = $agreement['Agreement']['id'];
					if ($this->Agreement->save($this->data)) {
						$_return['html'] = '';
						$_return['status'] = 'success';					
					}else{
						$_return['html'] = 'Error!';
						$_return['status'] = 'error';									
					}
				}else{
					$_return['html'] = 'Error!';
					$_return['status'] = 'error';
				}				
			}
			$count_agree = $this->Agreement->find(
					'count', array(
						'conditions' => array('Agreement.item_id' => $item_id, 'Agreement.item_type' => $item_type, 'Agreement.agree_flag' => 1),
					)	  	 	
				);
			$count_disagree = $this->Agreement->find(
						'count', array(
							'conditions' => array('Agreement.item_id' => $item_id, 'Agreement.item_type' => $item_type, 'Agreement.agree_flag' => 0),
						)	  	 	
					);
			$_return['count_agree'] = $count_agree;
			$_return['count_disagree'] = $count_disagree;	
		}else{
			$_return['html'] = 'Error!';
			$_return['status'] = 'error';
		}
		echo json_encode($_return);
		$this->autoRender = false;
	}
	function get_agree_disagree_members(){
		$limit = $this->pagingLimit;
		$_return['html'] = '';
		$_return['status'] = '';
		if(!empty($_POST)){
			$_data = $_POST;
			$item_id = $_data['item_id'];
			$item_type = $_data['item_type'];
			$agree_flag = $_data['agree_flag'];
			$agreements = $this->Agreement->find(
					'all', array(
						'conditions' => array('Agreement.item_id' => $item_id, 'Agreement.item_type' => $item_type, 'Agreement.agree_flag' => $agree_flag),
						'order'      => array('Agreement.created'=>'DESC','Agreement.id'=>'DESC'),
				    	'limit'      => $limit,		    	
					)	  	 	
				);
			if(!empty($agreements)){
				//$_return['html'] .= '<ul>';
				foreach ($agreements as $key => $agreement) {
					//$_return['html'] .= '<li>';
					$_return['html'] .= $agreement['Member']['fullname'].', ';
					//$_return['html'] .= '</li>';					
				}
				$_return['html'] = trim($_return['html']);
				$_return['html'] = trim($_return['html'], ',');				
				//$_return['html'] .= '</ul>';
				$_return['status'] = 'success';					
			}else{
				$_return['html'] .= '';
				$_return['status'] = 'success';				
			}
		}else{
			$_return['html'] = 'Error!';
			$_return['status'] = 'error';
		}
		echo json_encode($_return);
		$this->autoRender = false;		
	}
	function is_agree_disagree($item_id = 0, $item_type = 0, $member_id = 0){
		$this->loadModel('Agreement');		
	    $this->Agreement->recursive = 1;
		$agreement = $this->Agreement->find(
					'first', array(
						'conditions' => array('Agreement.item_id' => $item_id, 'Agreement.item_type' => $item_type, 'Agreement.member_id' => $member_id),
					)	  	 	
				);
		if(!empty($agreement)){
			return $agreement['Agreement']['agree_flag'];			
		}else{
			return -1;
		}		
	}
	function count_agree_disagree($item_id = 0, $item_type = 0)	{
		$this->loadModel('Agreement');		
	    $this->Agreement->recursive = 1;
		$count_agree = $this->Agreement->find(
					'count', array(
						'conditions' => array('Agreement.item_id' => $item_id, 'Agreement.item_type' => $item_type, 'Agreement.agree_flag' => 1),
					)	  	 	
				);
		$count_disagree = $this->Agreement->find(
					'count', array(
						'conditions' => array('Agreement.item_id' => $item_id, 'Agreement.item_type' => $item_type, 'Agreement.agree_flag' => 0),
					)	  	 	
				);
		$_return['count_agree'] = $count_agree;
		$_return['count_disagree'] = $count_disagree;	
		return $_return;
	}
}