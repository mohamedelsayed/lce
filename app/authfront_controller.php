<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.lifecoachingegypt.com
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
class AuthfrontController extends AppController{
	public $components = array('Session', 'Cookie', 'Email', 'Upload');	
	public $you_are_not_authorized = 'You are not authorized to access this page.';
	public $willyoucome_options = array(1 => 'Yes', 2 => 'Maybe', 0 => 'No');
	public $agreements_items_types = array(0 => 'Post', 1 => 'Comment'); 	
	public $replyto = 'noreply@lifecoachingegypt.com';
	public $inactiveagreedisagreebutton = 'inactiveagreedisagreebutton';
	public $email_notification_actions = array(0 => 'Add Post', 1 => 'Add Event', 2 => 'Add Comment', 3 => 'Cancel Event', 4 => 'Add Announcement'); 	
	public $pagingLimit = 10;
	protected function isAuthenticFront(){
		if($this->Cookie->read('userInfoFront')){
			if($this->inDataBaseFront()){
				return true;
			}else{
				$this->Cookie->delete('userInfoFront');
				return false;
			}
		}else
			return false;
	}		
	protected function inDataBaseFront(){
		$model = 'Member';
		$this->loadModel($model);
		$this->$model->recursive = -1;
		$conditions = array();
		$conditions1['password'] = $conditions2['password'] = $this->Cookie->read('userInfoFront.password');
		$conditions1['approved'] = $conditions2['approved'] = 1;
		$conditions1['username'] = $this->Cookie->read('userInfoFront.username');	
		$conditions2['email'] = $this->Cookie->read('userInfoFront.email');
		$record1 = $this->$model->find('count', array('conditions' => $conditions1));
		$record2 = $this->$model->find('count', array('conditions' => $conditions2));
		if($record1 >= 1 || $record2 >= 1){
			return 1;
		}else{
			return 0;
		}
	}			 
	function beforeFilter(){
		if(!$this->Session->check('Setting')){
			$this->setSettings();
		}
		if(!$this->isAuthenticFront() && ($this->action != 'login') && ($this->action != 'forget')){
			$this->Session->setFlash(__('Sorry! Please login first.', true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'login'));
		}
		$this->loadModel('Setting');
		$settings = $this->Setting->read(null, 1);
		$this->set("minYearValue",$settings['Setting']['minimum_year']);
		$this->set("maxYearValue",$settings['Setting']['maximum_year']);
		$this->set('settings', $settings['Setting']);
		$this->set('userInfoFront', $this->Cookie->read('userInfoFront'));
		$this->set('agreements_items_types', $this->agreements_items_types);
		$this->set('inactiveagreedisagreebutton', $this->inactiveagreedisagreebutton);
		$isAdmin = 0;
		if($this->isSuperAdmin() || $this->isAdmin()){
			$isAdmin = 1;
		}
		$this->set('isAdmin', $isAdmin);	
	}
	function beforeRender(){
		$this->setHeaderQuotes();
		if($this->layout != 'ajax'){
			$this->layout = 'forum/main';
		}
		$this->set('base_url', BASE_URL);
	}
	function isSuperAdmin(){
		$flag = 0;
		if($this->Cookie->read('userInfoFront')){
			$conditions['id'] = $this->Cookie->read('userInfoFront.id');
			$model = 'Member';
			$record = $this->$model->find('first', array('conditions' => $conditions));
			$role = $record['Member']['role'];
			if($role == 0){
				$flag = 1;
			}
		}
		return $flag;	
	}
	function isAdmin(){
		$flag = 0;
		if($this->Cookie->read('userInfoFront')){
			$conditions['id'] = $this->Cookie->read('userInfoFront.id');
			$model = 'Member';
			$record = $this->$model->find('first', array('conditions' => $conditions));
			$role = $record['Member']['role'];
			if($role == 1){
				$flag = 1;
			}
		}
		return $flag;	
	}
	function isUser(){
		$flag = 0;
		if($this->Cookie->read('userInfoFront')){
			$conditions['id'] = $this->Cookie->read('userInfoFront.id');
			$model = 'Member';
			$record = $this->$model->find('first', array('conditions' => $conditions));
			$role = $record['Member']['role'];			
			if($role == 2){
				$flag = 1;
			}
		}
		return $flag;	
	}
	function send_email_notification($item_id = 0, $action_type = 0, $item_title = '', $parent_id = 0){
		$this->loadModel('Setting');
		$settings = $this->Setting->read(null, 1);
		$block_notification_flag = 'block_posts_notification';
		$body = '';
		$url = '';
		$member_id = $this->Cookie->read('userInfoFront.id');
		$item_member = $this->Member->read(null, $member_id);
		$item_member_name = $item_member['Member']['fullname'];
		if($action_type == 0){
			//$post = $this->Post->read(null, $item_id);
			$url = BASE_URL.'/posts/view/'.$item_id;
			//$item_title = $post['Post']['title'];
			$block_notification_flag = 'block_posts_notification';
			$body = 'Hello {{member_name}},<br/>
					{{item_member_name}} added new post <a href="{{url}}">“{{item_title}}”</a>.<br/>
					Regards,<br/>
					LCE Team';
		}elseif($action_type == 1){
			//$event = $this->Event->read(null, $item_id);
			$url = BASE_URL.'/events/view/'.$item_id;
			//$item_title = $event['Event']['title'];
			$block_notification_flag = 'block_events_notification';
			$body = 'Hello {{member_name}},<br/>
					{{item_member_name}} added new event <a href="{{url}}">“{{item_title}}”</a>.<br/>
					Regards,<br/>
					LCE Team';
		}elseif($action_type == 2){
			$post = $this->Post->read(null, $parent_id);
			$url = BASE_URL.'/posts/view/'.$parent_id;
			$item_title = $post['Post']['title'];
			$block_notification_flag = 'block_comments_notification';
			$body = 'Hello {{member_name}},<br/>
					{{item_member_name}} added new comment on <a href="{{url}}">“{{item_title}}”</a>.<br/>
					Regards,<br/>
					LCE Team';
		}elseif($action_type == 3){
			$block_notification_flag = 'block_events_notification';
			$body = 'Hello {{member_name}},<br/>
					{{item_member_name}} has canceled “{{item_title}}” event.<br/>
					Regards,<br/>
					LCE Team';
		}/*elseif($action_type == 4){
			$block_notification_flag = 'block_announcements_notification';
		}*/
		if($action_type == 0 || $action_type == 1 || $action_type == 2 || $action_type == 3){
			$this->Member->recursive = 1;
			$members = $this->Member->find(
					'all', 
					array(
						'conditions' => array('Member.approved' => 1),
			  	 		'order'      => array('Member.fullname' => 'ASC','Member.id'=>'DESC'),
			  	 	)
		  	 	);			
			foreach ($members as $key => $member) {				
				if($member['Member']['id'] != $member_id){
					$new_body = $body;
					$member_name = $member['Member']['fullname'];
					$new_body = str_replace(array('{{member_name}}', '{{item_member_name}}', '{{url}}', '{{item_title}}'), 
										array($member_name, $item_member_name, $url, $item_title), $new_body);
					$this->send_email_notification_member($member, $new_body, $block_notification_flag, $member_id, $settings);	
				}
			}					
		}		
	}
	function send_email_notification_member($member, $body, $block_notification_flag, $member_id, $settings){
		if($member['Member'][$block_notification_flag] == 0){
			$blocked_flag = FALSE;
			if(!empty($member['BlockedMembers'])){
				foreach ($member['BlockedMembers'] as $key => $blockedMembers) {
					if($blockedMembers['blocked_member_id'] == $member_id){
						$blocked_flag = TRUE;
					}						
				}			
			}
			if($blocked_flag == FALSE){
				$this->Email->reset();		
				$this->Email->to = $member['Member']['email'];
				$this->Email->subject = $settings['Setting']['title'];
				$this->Email->replyTo = $this->replyto;							
				$this->Email->from = $settings['Setting']['title'].'<'.$this->replyto.'>';
				$this->Email->sendAs = 'html';
				$this->Email->template = 'email_notification';
				$this->set('body', $body);			     		
				if ($this->Email->send()){
				}		
			}
		}
	}
}