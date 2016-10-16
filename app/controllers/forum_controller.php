<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.lifecoachingegypt.com
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
require_once '../authfront_controller.php';
class ForumController  extends AuthfrontController {
	var $name = 'Forum';
	var $uses = array('Member');
	//var $components = array('Email', 'Upload');
	function index(){
		//$this->redirect(array('controller' => 'calendar', 'action' => 'index'));
		$this->set('selected','home');
		$model = 'Slideshow';
		$this->loadModel($model);
		unset($items);
		$items = $this->$model->find(
			'all', array(
				'conditions' => array($model.'.approved' => 1, $model.'.forum_flag' => 1),
				'order' => array($model.'.weight' => 'ASC', $model.'.id'=>'DESC')
			)	  	 	
		);
		$this->set('slideshows' , $items);
		$model = 'Post';
		$this->loadModel($model);
		unset($items);
		$items = $this->$model->find(
			'all', array(
				'conditions' => array($model.'.approved' => 1),
				'order' => array($model.'.id'=>'DESC'),
				'limit' => 6
			)	  	 	
		);
		$this->set('posts' , $items);
		$model = 'Content';
		$this->loadModel($model);
		$welcome_note = $this->Content->read(null, 3);
		$this->set('welcome_note' , $welcome_note);
		$happening_now = $this->Content->read(null, 4);		
		$this->set('happening_now', $happening_now);
		$recent_activities_limit = 5;
		$model = 'Library';
		$this->loadModel($model);
		$model = 'ForumComment';
		$this->loadModel($model);		
		$libraries = array();
		$comments = array();
		$sql="(SELECT `id`, `title`, `created`, 'event' AS `type` FROM `events` WHERE `approved` = 1) UNION
	 		  (SELECT `id`, `title`, `created`, 'library' AS `type` FROM `libraries` WHERE `approved` = 1) UNION
	 		  (SELECT `id`, `comment`, `created`, 'comment' AS `type` FROM `forum_comments` WHERE `approved` = 1)
	 		  ORDER BY `created` DESC
			  LIMIT ".$recent_activities_limit.";";                          
		$recent_activities = $this->$model->query($sql);
		if(!empty($recent_activities)){
			foreach ($recent_activities as $key => $recent_activity) {
				$type = $recent_activity[0]['type'];
				$id = $recent_activity[0]['id'];
				if($type == 'library'){
					$library = $this->Library->read(null, $id);
					$libraries[$id] = $library;
				}elseif($type == 'event'){
				}elseif($type == 'comment'){
					$comment = $this->ForumComment->read(null, $id);
					$comments[$id] = $comment;
				}
			}
		}
		$this->set('recent_activities', $recent_activities);
		$this->set('libraries', $libraries);
		$this->set('comments', $comments);	
		$today = date("Y-m-d"); 
		$this->loadModel('Event');
		$event = $this->Event->find(
			'first', array(
				'conditions' => array('Event.approved' => 1, 'Event.from_date >=' => $today,),
				'order' => array('Event.from_date' => 'ASC','Event.id'=>'DESC'),
				'limit' => 1
			)	  	 	
		);
		$this->set('event' , $event);	
	}
	function login(){
		$this->layout = 'login';
		$model = 'Member';
		if($this->isAuthenticFront()){
			$this->Session->setFlash(__('You are already logging in.', true));
			$this->redirect(array('controller' => 'forum', 'action' => 'index'),true);
		}
		if(!empty($this->data)){
			$conditions1[$model.'.password'] = $conditions2[$model.'.password'] = Security::hash($this->data[$model]['password'], null, true);
			$conditions1[$model.'.approved'] = $conditions2[$model.'.approved'] = 1;
			$conditions1[$model.'.username'] = $this->data[$model]['username'];	
			$conditions2[$model.'.email'] = $this->data[$model]['username'];
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
				if ($this->data[$model]['remember']){
		    		$this->Cookie->time = '+10 weeks';
				}
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
					if(SEND_STMP){
						$this->Email->smtpOptions = array(
							'port' => STMP_PORT,
							'timeout' => STMP_TIMEOUT,
							'host' => STMP_SERVER,
							'username' => STMP_USERNAME,
							'password' => STMP_PASSWORD,
						);
						$this->Email->delivery = 'smtp';
					}
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
						$this->redirect(BASE_URL.'/forum/login');
					}else 
						$this->Member->validationErrors['password'] = 'Please enter new password.';	
				} 
			}else{
				$this->Session->setFlash(__('Wrong code.', true));
				$this->redirect(BASE_URL.'/forum/forget');
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
	function upload_file(){
        $absolute_webroot = ROOT.DS.APP_DIR.DS.WEBROOT_DIR;        
        $upload_dir = $absolute_webroot.DS.'files'.DS.'upload';
        if (!file_exists($upload_dir)) {
             mkdir($upload_dir, 0777);
        } 
        $current_year = date('Y');
        $current_month = date('m');
        $dir_name_with_year = $upload_dir.DS.$current_year;
        if (!file_exists($dir_name_with_year)) {
            mkdir($dir_name_with_year, 0777);
        }
        $dir_name_with_month = $upload_dir.DS.$current_year.DS.$current_month;
        if (!file_exists($dir_name_with_month)) {
            mkdir($dir_name_with_month, 0777);
        }
        $final_upload_dir = $upload_dir.DS.$current_year.DS.$current_month.DS;
        $file_name = str_replace("#", "_", basename($_FILES['file']['name']));
        $file_name = str_replace("?", "_", $file_name);
        $file_name = str_replace(" ", "_", $file_name);
        $file = $final_upload_dir.$file_name; 
        if (file_exists($file)) {
            $file_name = time().$file_name;
        }
        $file = $final_upload_dir.$file_name; 
        $file_path = '';        
        if(move_uploaded_file($_FILES['file']['tmp_name'], $file)){
            $file_path = $file;
        }   
        $final_path = str_replace($absolute_webroot, '', $file_path);
        echo $this->draw_attachement_box(0, $final_path);
        $this->autoRender = false; 
    }     
	function admin_all(){
		$this->check_isAdmin_isSuperAdmin();
	}
}