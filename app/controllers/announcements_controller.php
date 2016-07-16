<?php /**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.mohamedelsayed.net/
 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */
require_once '../authfront_controller.php';
class AnnouncementsController extends AuthfrontController {
	var $name = 'Announcements';
	var $uses = array('Announcement');
	//var $components = array('Upload');
	function index() {
		$this->Announcement->recursive = 0;
		if($this->isSuperAdmin() || $this->isAdmin()){
			if(isset($this->data['Announcement']['title'])){
				$this->paginate = array(
				'conditions' => array('Announcement.title LIKE' => "%".$this->data['Announcement']['title']."%"),
	    		);
			}
			$this->set('announcements', $this->paginate());
		}else{
			$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'index'));	
		}
	}
	function view($id = null) {
		$isAdmin = 0;
		if($this->isSuperAdmin() || $this->isAdmin()){
			$isAdmin = 1;
		}
		$this->set('isAdmin', $isAdmin);	
		if (!$id) {
			$this->Session->setFlash(__('Invalid Announcement', true));
			$this->redirect(array('action' => 'index'));
		}
		$announcement = $this->Announcement->read(null, $id);
		$this->set('announcement', $announcement);
		if(!($announcement['Announcement']['approved'] == 1 || $isAdmin == 1)){
			$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'index'));	
		}
	}
	function add() {
		$isAdmin = 0;
		if($this->isSuperAdmin() || $this->isAdmin()){
			$isAdmin = 1;
		}
		$this->set('isAdmin', $isAdmin);	
		if($this->isSuperAdmin() || $this->isAdmin()){		
			if (!empty($this->data)) {
				$this->Announcement->create();
				if ($this->Announcement->save($this->data)) {
					$this->Session->setFlash(__('The Announcement has been saved', true));
					if($isAdmin == 1){
						$this->redirect(array('action' => 'index'));
					}else{
						$this->redirect(array('action' => 'all'));					
					}
				} else {
					$this->Session->setFlash(__('The Announcement could not be saved. Please, try again.', true));
				}
			}
		}else{
			$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'index'));	
		}
	}
	function edit($id = null) {
		$isAdmin = 0;
		if($this->isSuperAdmin() || $this->isAdmin()){
			$isAdmin = 1;
		}
		$this->set('isAdmin', $isAdmin);		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Announcement', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$this->Announcement->id = $id;
			if ($this->Announcement->save($this->data)) {
				$this->Session->setFlash(__('The Announcement has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Announcement could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Announcement->read(null, $id);
			if(!($this->isSuperAdmin() || $this->isAdmin())){
				$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
				$this->redirect(array('controller' => 'forum', 'action' => 'index'));							
			}
		}
	}
	function delete($id = null) {
		if($this->isSuperAdmin() || $this->isAdmin()){
			if (!$id) {
				$this->Session->setFlash(__('Invalid id for Announcement', true));
				$this->redirect(array('action'=>'index'));
			}
			$this->Announcement->id = $id;
			if ($this->Announcement->delete($id)) {
				$this->Session->setFlash(__('Announcement deleted', true));
				$this->redirect(array('action'=>'index'));
			}
			$this->Session->setFlash(__('Announcement was not deleted', true));
			$this->redirect(array('action' => 'index'));
		}else{
			$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'index'));	
		}
	}
	function all(){
		$limit = $this->pagingLimit;
		$page = isset($this->params['named']['page'])?$this->params['named']['page']:$this->paginate['page'];	
		$conditions = array('Announcement.approved' => 1);					
		$this->paginate['Announcement'] = array(
    			//'fields'     => array('Announcement.id', 'Announcement.title', 'Announcement.body'),
    			'conditions' => $conditions,
				'order'      => array('Announcement.weight' => 'ASC','Announcement.updated' => 'DESC','Announcement.id'=>'DESC'),
		    	'limit'      => $limit,
		    	'page'  	 => $page
	    	);
		$this->set('page',$page);
		$this->set('announcements', $this->paginate('Announcement'));		
	}
	function sendannouncement($id){		
		if(!empty($_POST)){
			$data = $_POST;
			$announcementid = 0;
			if(isset($data['announcementid'])){
				$announcementid = $data['announcementid'];
			}
			if($announcementid != 0){
				$announcement = $this->Announcement->read(null, $id);
				$subject = $announcement['Announcement']['title'];
				$membersids = array();
				if(isset($data['membersids'])){
					$membersids = $data['membersids'];
				}
				$sent = 0;
				$notsent = 0;
				if(!empty($membersids)){
					foreach ($membersids as $key => $memberid) {
						$member = $this->Member->read(null, $memberid);
						if($member['Member']['block_announcements_notification'] == 0){
							if(SEND_STMP_PORT){
								$this->Email->smtpOptions = array(
									'port' => STMP_PORT,
									'timeout' => STMP_TIMEOUT,
									'host' => STMP_SERVER,
									'username' => STMP_USERNAME,
									'password' => STMP_PASSWORD,
								);
								$this->Email->delivery = 'smtp';
							}
							$this->Email->to = $member['Member']['email'];
							$this->Email->subject = $subject;
							$this->Email->replyTo = $this->replyto;
							$this->loadModel('Setting');
							$settings = $this->Setting->read(null, 1);
							$this->Email->from = $settings['Setting']['title'].'<'.$this->replyto.'>';
							$this->Email->sendAs = 'html';
							$this->Email->template = 'announcements';
							$this->set('announcement_body', $announcement['Announcement']['body']);			     		
							if ($this->Email->send()){
								$sent++;
								//echo __('Thank you for your message. We will get back to you the soonest.', true);			 
							}
							else{
								$notsent++;
								//echo __('There was a problem sending the Email. Please try again.', true);
							}														
						}						
					}
					$msg = $sent.' success.';
					if($notsent > 0){
						$msg = $sent.' success, '.$notsent.' fail.';							
					}						
					$this->Session->setFlash(__($msg, true), true);					
				}else{
					$this->Session->setFlash(__('You must select at least one user.', true), true);				
				}
			}else{
				$this->Session->setFlash(__('Error.', true), true);				
			}
		}	
		$this->set('id',$id);
		$members = $this->Member->find(
					'all', 
					array(
						//'fields'     => array('Member.id', 'Member.title'),
						'conditions' => array('Member.approved' => 1),
			  	 		'order'      => array('Member.fullname' => 'ASC','Member.id'=>'DESC'),
			  	 	)
		  	 	);			
		$this->set('members',$members);	
		$this->render('sendannouncement');		
	}
}