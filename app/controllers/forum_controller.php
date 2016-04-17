<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.lifecoachingegypt.com
 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */
require_once '../authfront_controller.php';
class ForumController  extends AuthfrontController {
	var $name = 'Forum';
	var $uses = array('Member');
	//var $components = array('Email', 'Upload');
	function index(){
		$limit = $this->pagingLimit;
		$this->set('limit', $limit);
		$this->loadModel('Announcement');
		$announcement = $this->Announcement->find(
			'first', array(
				'conditions' => array('Announcement.approved' => 1),
				'order'      => array('Announcement.weight' => 'ASC','Announcement.updated' => 'DESC','Announcement.id'=>'DESC'),		    	
			)	  	 	
		);
		$this->set('announcement', $announcement);
		$this->loadModel('Post');
		$this->paginate = array(
    		'Post'=>array(
	    		'conditions' => array('Post.approved' => 1),
				'order'      => array('Post.created'=>'DESC','Post.id'=>'DESC'),
		    	'limit'      => $limit
    		)
    	);
		$this->set('posts', $this->paginate('Post'));
		$categories = $this->Post->Category->find('list');
		$this->set(compact('categories'));
	}
	function login(){
		$this->layout = 'login';
		$model = 'Member';
		if($this->isAuthenticFront()){
			$this->Session->setFlash(__('You are already logging in.', true));
			$this->redirect(array('controller' => 'forum', 'action' => 'index'),true);
		}
		if(!empty($this->data)){
			$conditions1['password'] = $conditions2['password'] = Security::hash($this->data[$model]['password'], null, true);
			$conditions1['approved'] = $conditions2['approved'] = 1;
			$conditions1['username'] = $this->data[$model]['username'];	
			$conditions2['email'] = $this->data[$model]['username'];
			$this->loadModel($model);
			$record1 = $this->$model->find('first', array('conditions' => $conditions1));
			$record2 = $this->$model->find('first', array('conditions' => $conditions2));
			if(!empty($record1) || !empty($record2)){
				if(!empty($record1)){
					$user = $record1;
				}elseif(!empty($record2)){
					$user = $record2;
				}
				//$this->Session->setFlash(__('Logged in successfuly.', true));
				if ($this->data[$model]['remember'])
		    		$this->Cookie->time = '+10 weeks';
				$this->Cookie->write('userInfoFront', $user[$model], true, $this->Cookie->time);	
		    	$this->redirect(array("controller" => "forum/index"),true);						   	 	   	
			}else{
				$this->Session->setFlash(__('Wrong username or password! Please, try again.', true));
			}
		}		
		$this->data = null;		
	}
	function logout(){
		$this->Cookie->delete('userInfoFront');
		$this->Session->setFlash(__('Logged out successfuly.', true));
		$this->redirect(array('controller'=>'forum/login'));		
	}
	function forget($memberId=null, $code=null){
		//$this->layout = 'login';
		$this->set('title_for_layout','Forgot username or password');
		$this->loadModel('Setting');
		$settings = $this->Setting->read(null, 1);
		//print_r($settings);
		if(!empty($this->data['Member']['email'])){
			if(Validation::email($this->data['Member']['email'])){
				$member = $this->Member->find('first', array(
					'conditions' => array(
						'Member.email'     => $this->data['Member']['email'],
						//'Member.confirmed' => 1,
					)
				));
				//print_r($member);
				if(!empty($member)){
					//change confirm code
					$unId = String::uuid();
					$this->Member->id = $member['Member']['id'];
					$this->Member->saveField('confirm_code', $unId, false);
					//send confirmation mail
					$this->Email->to = $this->data['Member']['email'];
					$this->Email->subject = $settings['Setting']['title'];
					$this->Email->replyTo = $settings['Setting']['email'];
					$this->Email->from = $settings['Setting']['email'];
					$this->Email->sendAs = 'html';
					$this->Email->template = 'forumforgot';
					//set data to template 'forgot'.
					$this->set('member', $member);
					$this->set('code', $unId);
					$this->set('url', $settings['Setting']['url']);
					if ($this->Email->send())
						$this->Session->setFlash(__('Confirmation mail sent. Please check your inbox', true));
					else 
						$this->Session->setFlash(__('There was a problem sending mail. Please try again', true));
				}else 
					$this->Session->setFlash(__('Invalid Member email.', true));
			}else 
				$this->Member->validationErrors['email'] = 'Please enter valid email.';
		}elseif($memberId && $code){
			$member = $this->Member->find('first', array(
					'conditions' => array(
						'Member.id'     => $memberId,
						//'Member.confirmed' => 1,
					)
				));				
			if($member['Member']['confirm_code'] == $code){
				if(isset($this->data)){
					if(!empty($this->data['Member']['password'])){
						$password = $this->data['Member']['password'];
						$hashPassword = Security::hash($this->data['Member']['password'], null, true);
						$newCode = String::uuid();					
						$this->Member->updateAll(
							array('Member.password' => "'$hashPassword'", 'Member.confirm_code' => "'$newCode'"),
							array('Member.id' => $memberId, 'Member.confirm_code' => $code)
						);
						$this->Session->setFlash(__('Password changed successfully.', true));				
						$this->redirect($this->Session->read('Setting.url').'/forum/login');
					}else 
						$this->Member->validationErrors['password'] = 'Please enter new password.';	
				} 
			}else{
				$this->Session->setFlash(__('Wrong code.', true));
				$this->redirect($this->Session->read('Setting.url').'/forum/forget');
			}
			$this->set('title_for_layout', 'Change password');
			$this->render('change_password');	
		}		
	}
	function uploadimage(){
		$this->data['image'] = $this->Upload->uploadImage($_FILES['file']);
		if($this->data['image']){
			$data['status'] = 'success';
			$data['file_path'] = $this->data['image'];
			$data['file_name'] = $this->data['image'];
			echo json_encode($data);
		}else{
			$data['status'] = 'error';
			echo json_encode($data);
		}
		$this->autoRender = false;		
	}
	function uploadfile(){
		$this->data['file'] = $this->Upload->uploadFile($_FILES['file']);
		if($this->data['file']){
			$data['status'] = 'success';
			$data['file_path'] = $this->data['file'];
			$data['file_name'] = $this->data['file'];
			echo json_encode($data);
		}else{
			$data['status'] = 'error';
			echo json_encode($data);
		}
		$this->autoRender = false;		
	}
	function removefile(){
		$path = $_POST['path'];
		if($path != ''){
			//$this->Upload->filesToDelete = array($path);
			//$this->Upload->deleteFile();
			$data['status'] = 'success';
			echo json_encode($data);
		}else{
			$data['status'] = 'error';
			echo json_encode($data);
		}
		$this->autoRender = false;	
	}
}