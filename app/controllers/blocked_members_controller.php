<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.lifecoachingegypt.com
 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */
require_once '../authfront_controller.php';
class BlockedMembersController extends AuthfrontController {
	var $name = 'BlockedMembers';
	var $uses = array('BlockedMember');
	function index(){
		$this->redirect(array('controller' => 'forum', 'action' => 'index'));
	}
	function get_block_unblock_member_button($other_member_id = 0, $current_member_id = 0, $other_member_fullname = ''){
		$_return = '';
		if($other_member_id != 0){
			if($current_member_id == 0){
				$current_member_id = $this->Cookie->read('userInfoFront.id');
			}
			$member_blocked = $this->check_member_blocked($other_member_id, $current_member_id);
			if($other_member_id != $current_member_id){
				if($member_blocked == 1){
					$_return = '<a class="blockunblockbutton unblockbutton" blockflag="0" othermemberid="'.$other_member_id.'" othermemberfullname="'.$other_member_fullname.'" >Unblock</a>';				
				}elseif($member_blocked == 0){
					$_return = '<a class="blockunblockbutton blockbutton" blockflag="1" othermemberid="'.$other_member_id.'" othermemberfullname="'.$other_member_fullname.'" >Block</a>';				
				}
			}
		}
		return $_return;		
	}
	function check_member_blocked($other_member_id = 0, $current_member_id = 0){
		$_return = -1;
		if($other_member_id != 0){
			if($current_member_id == 0){
				$current_member_id = $this->Cookie->read('userInfoFront.id');
			}
			$blockedMember = $this->BlockedMember->find(
				'first', array(
					'conditions' => array('BlockedMember.member_id' => $current_member_id, 'BlockedMember.blocked_member_id' => $other_member_id),
				)	  	 	
			);
			if(!empty($blockedMember)){
				$_return = 1;
			}else{
				$_return = 0;
			}
		}
		return $_return;		
	}
	function block_unblock(){
		$_return['html'] = '';
		$_return['status'] = '';
		if(!empty($_POST)){
			$_data = $_POST;
			$current_member_id = $this->Cookie->read('userInfoFront.id');
			$other_member_id = $_data['other_member_id'];
			$block_flag = $_data['block_flag'];
			$other_member_fullname = $_data['other_member_fullname'];
			//$member_blocked = $this->check_member_blocked($other_member_id, $current_member_id);
			$blockedMember = $this->BlockedMember->find(
				'first', array(
					'conditions' => array('BlockedMember.member_id' => $current_member_id, 'BlockedMember.blocked_member_id' => $other_member_id),
				)	  	 	
			);
			if(!empty($blockedMember)){
				if($block_flag == 0){
					if ($this->BlockedMember->delete($blockedMember['BlockedMember']['id'])){
						$_return['html'] = $this->get_block_unblock_member_button($other_member_id, $current_member_id, $other_member_fullname);
						$_return['status'] = 'success';								
					}else{
						$_return['html'] = 'Error!';
						$_return['status'] = 'error';							
					}					
				}else{
					$_return['html'] = 'Error!';
					$_return['status'] = 'error';							
				}
			}else{
				if($block_flag == 1){
					$this->data['BlockedMember']['member_id'] = $current_member_id;
					$this->data['BlockedMember']['blocked_member_id'] = $other_member_id;
					$this->BlockedMember->create();
					if ($this->BlockedMember->save($this->data)){
						$_return['html'] = $this->get_block_unblock_member_button($other_member_id, $current_member_id, $other_member_fullname);
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
		}	
		echo json_encode($_return);
		$this->autoRender = false;	
	}	
}