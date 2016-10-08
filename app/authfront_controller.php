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
	public $forum_events_types = array(0 => 'Public Events', 1 => 'DCC Events', 2 => 'Community Meetings');
	public $forum_libraries_types1 = array(0 => 'DCC materials', 1 => 'Coaching tools and Tips', 2 => 'Video Center', 3 => 'Photo Gallery');
	public $forum_libraries_types2 = array(0 => 'Word', 1 => 'PowerPoint', 2 => 'Excel', 3 => 'PDF', 4 => 'Photo', 5 => 'Video', 6 => 'mp3'); 	
	public $forum_modules_types = array(0 => 'Module 1', 1 => 'Module 2', 2 => 'Module 3', 3 => 'Module 4', 4 => 'Module 5'); 	
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
		$this->check_allowed_controllers_actions();	
		$this->loadModel('Setting');
		$settings = $this->Setting->read(null, 1);
		$this->set("minYearValue",$settings['Setting']['minimum_year']);
		$this->set("maxYearValue",$settings['Setting']['maximum_year']);
		$this->set('settings', $settings['Setting']);
		$userInfoFront = $this->Cookie->read('userInfoFront');
		$this->set('userInfoFront', $userInfoFront);
		$this->set('agreements_items_types', $this->agreements_items_types);
		$this->set('inactiveagreedisagreebutton', $this->inactiveagreedisagreebutton);
		$isAdmin = 0;
		if($this->isSuperAdmin() || $this->isAdmin()){
			$isAdmin = 1;
		}
		$this->set('isAdmin', $isAdmin);			
		if(!empty($userInfoFront)){
			$GLOBALS['is_loggin'] = 1;
		}else{
			$GLOBALS['is_loggin'] = 0;			
		}
		$GLOBALS['is_admin'] = $isAdmin;	
	}
	function beforeRender(){
		$this->setParentCat();
		//$this->setHeaderQuotes();
		if($this->layout != 'ajax'){
			$this->layout = 'forum/main';
		}
		$this->set('base_url', BASE_URL);
		$this->setHeaderGroups();
		$this->set('forum_events_types',$this->forum_events_types);
		$this->set('forum_libraries_types1',$this->forum_libraries_types1);
		$this->set('forum_libraries_types2',$this->forum_libraries_types2);
		$this->set('forum_modules_types',$this->forum_modules_types);				
	}
	function isSuperAdmin(){
		$flag = 0;
		if($this->Cookie->read('userInfoFront')){
			$model = 'Member';
			$conditions[$model.'.id'] = $this->Cookie->read('userInfoFront.id');			
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
			$model = 'Member';
			$conditions[$model.'.id'] = $this->Cookie->read('userInfoFront.id');			
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
		/*if($member['Member'][$block_notification_flag] == 0){
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
		}*/
	}
	public function check_allowed_controllers_actions(){
		$allowed_links = $this->get_allowed_links();		
		$controller = $this->params['controller'];		
		$action = $this->params['action'];		
		$allowed_link_flag = 0;
		foreach ($allowed_links as $key => $value) {
			if($value['controller'] == $controller && $value['action'] == $action){
				$allowed_link_flag = 1;				
			}			
		}
		if(!$this->isAuthenticFront() && ($this->action != 'login') && ($this->action != 'forget') && !($allowed_link_flag)){
			$this->Session->setFlash(__('Sorry! Please login first.', true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'login'));
		}		
	}
	public function setHeaderGroups(){
		$this->loadModel('Group');
		$header_groups = $this->Group->find(
			'all', array(
				'conditions' => array('Group.approved' => 1),
				'order' => array('Group.weight' => 'ASC','Group.id'=>'DESC')
			)	  	 	
		);
		$this->set('header_groups' , $header_groups);	
	}
	public function get_allowed_links(){
		$allowed_links = array();	
		//$allowed_links[] = array('controller' => 'members', 'action' => 'view');
		//$allowed_links[] = array('controller' => 'members', 'action' => 'all');
		//$allowed_links[] = array('controller' => 'members', 'action' => 'group');
		$allowed_links[] = array('controller' => 'calendar', 'action' => 'index');
		$allowed_links[] = array('controller' => 'forum', 'action' => 'index');
		$allowed_links[] = array('controller' => 'events', 'action' => 'view');
		$allowed_links[] = array('controller' => 'events', 'action' => 'willcome');		
		return $allowed_links;
	}
	public function check_isAdmin_isSuperAdmin(){
		if($this->isSuperAdmin() || $this->isAdmin()){
			$this->set('selected','adminpages');
		}else{
			$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'index'));	
		}		
	}
	public function draw_attachement_box($id = 0, $path = '', $delete = 1){
		$path_exploded = explode('.', $path);
		$file_ext = end($path_exploded);
		$path_exploded2 = explode('/', $path);
		$filename = end($path_exploded2);
		$removebtn = '<div data-file-id="{{file_id}}"  class="removeuploadattachementbtn last" path="'.$path.'">X</div>';
		$file_class = $file_ext+'-file';
		$file_link = BASE_URL.$path;
		$file_class = $file_ext.'-file';
		$tpl = '<div class="common-file-post '.$file_class.'" data-file-id="{{file_id}}">
		<a target="_blank" href="'.$file_link.'" >'.$filename."</a>";
		if($delete == 1){
			$tpl .= $removebtn;
		}
		$tpl .= '<input type="hidden" name="file_path[{{file_id}}]" value="{{file_path}}" />'.
		'</div>';
        /*$tpl = '<div class="attachement_wrap" data-file-id="{{file_id}}">
            <div class="file_item">
            <file src="'.BASE_URL.'/{{file_path}}" style="max-width: 250px; max-height: 250px;">
            </div>
            <input type="hidden" name="file_path[{{file_id}}]" value="{{file_path}}" />
            <div class="caption">
            <label>Caption</label>
            <input type="text" name="file_caption[{{file_id}}]" value="{{file_caption}}" />
            </div>
            <div class="cover">
            <input type="radio" name="file_cover" value="{{file_id}}" {{file_cover}} />
            <label>Cover Image</label>
            </div>
            <div class="delete" data-file-id="{{file_id}}" >
                <a>Delete</a>
            </div>
        </div>';*/
        $html = '';        
        if($path != ''){
            if($id == 0){
                $id = $this->generateRandomString();                
            }
            $html = str_replace(array('{{file_id}}', '{{file_path}}'), 
                                array($id, $path), $tpl);
        }
        return $html;
    }
	public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
}