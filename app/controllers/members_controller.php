<?php /**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.mohamedelsayed.net/
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
require_once '../authfront_controller.php';
class MembersController extends AuthfrontController {
	var $name = 'Members';
	var $uses = array('Member');
	var $components = array('Upload');		
	function index() {
		$key = '';
		if(isset($_GET['key'])){
			$key = $_GET['key'];
		}
		$this->check_isAdmin_isSuperAdmin();
		//$this->Member->recursive = 0;
		$conditions = array();
		$key = trim($key);
		if($key != ''){			
			$conditions['AND'] = array('OR' => array(
													'Member.fullname LIKE "%'.$key.'%"', 
													'Member.job_title LIKE "%'.$key.'%"'));			
		}
		if($this->isSuperAdmin()){
			$conditions['Member.role >'] = 0;		
			$this->paginate['Member'] = array(
				'conditions' => $conditions,
				'order'      => array('TRIM(Member.fullname)' => 'ASC','Member.id'=>'DESC'),
	    	);
			$this->set('members', $this->paginate('Member'));
		}elseif($this->isAdmin()){
			$conditions['Member.role >'] = 0;
			$this->paginate['Member'] = array(
				'conditions' => $conditions,
				'order'      => array('TRIM(Member.fullname)' => 'ASC','Member.id'=>'DESC'),
	    	);
			$this->set('members', $this->paginate('Member'));
		}else{
			$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'login'));			
		}			
		$this->set('roles' , $this->get_roles());
		$this->set('title_for_layout', 'Contacts');
	}	
	function view($id = null) {
		$this->Member->recursive = 0;
		if (!$id) {
			$this->Session->setFlash(__('Invalid Contact', true));
			$this->redirect(array('action' => 'index'));
		}		
		$this->set('member', $this->Member->read(null, $id));
		$this->set('roles' , $this->get_roles());
		$this->set('title_for_layout', 'Contacts');
		$this->set('selected','contactspages');
	}	
	function add(){
		$this->check_isAdmin_isSuperAdmin();
		if($this->isSuperAdmin() || $this->isAdmin()){
			if (!empty($this->data)) {
				//upload image
				$this->data['Member']['image']=$this->Upload->uploadImage($this->data['Member']['image']);			
				//hash password
				if($this->data['Member']['password'] != ''){
					$this->data['Member']['password'] = Security::hash($this->data['Member']['password'], null, true);
				}			
				//save data
				$this->Member->create();
				if ($this->Member->save($this->data)) {
					$this->Session->setFlash(__('The Contact has been saved', true));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The Contact could not be saved. Please, try again.', true));
				}
			}
			$this->set('roles' , $this->get_roles());
		}else{
			$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'login'));	
		}
		$groups = $this->Member->Group->find('list');
		$this->set(compact('groups'));
		$this->set('title_for_layout', 'Contacts');
	}	
	function edit($id = null){
		$this->set('selected','adminpages');
		//$this->check_isAdmin_isSuperAdmin();
		if (!$id && empty($this->data)) {
			if($this->Cookie->read('userInfoFront')){
				$id = $this->Cookie->read('userInfoFront.id');
				$this->set('selected','editprofilepages');
			}else{
				$this->Session->setFlash(__('Invalid Contact', true));
				$this->redirect(array('action' => 'index'));				
			}
		}
		if (!empty($this->data)) {			
			//to upload image
			$this->Member->id = $id;
			if($this->data['Member']['image']['name']){
				$this->Upload->filesToDelete = array($this->Member->field('image'));
				$this->data['Member']['image']=$this->Upload->uploadImage($this->data['Member']['image']);
			}else{
				$this->data['Member']['image'] = $this->Member->field('image');
			}				
			//if password changed do changes
			if(($this->data['Member']['password'] != $this->Member->field('password')) && ($this->data['Member']['password'] != '')){	
				$this->data['Member']['password'] = Security::hash($this->data['Member']['password'], null, true);
			}				
			if ($this->Member->save($this->data)) {
				$this->Upload->deleteFile();//to delete old images;
				$this->Session->setFlash(__('The Contact has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Contact could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$member = $this->Member->read(null, $id);
			$this->data =$member;
			if($this->isSuperAdmin()){
			}elseif($this->isAdmin()){
				if($member['Member']['role'] == 1 && $this->Cookie->read('userInfoFront.id') != $id || $member['Member']['role'] == 0){
					$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
					$this->redirect(array('controller' => 'forum', 'action' => 'login'));						
				}				
			}else{
				if($this->Cookie->read('userInfoFront.id') != $id){
					$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
					$this->redirect(array('controller' => 'forum', 'action' => 'login'));						
				}				
			}	
		}
		$this->set('roles' , $this->get_roles());
		$groups = $this->Member->Group->find('list');
		$this->set(compact('groups'));
		$this->set('title_for_layout', 'Contacts');		
	}	
	function delete($id = null) {
		$this->check_isAdmin_isSuperAdmin();
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Contact', true));
			$this->redirect(array('action'=>'index'));
		}
		if($id <= 3){
			$this->Session->setFlash(__('Sorry! Web Master can not be deleted.', true));
			$this->redirect(array('action'=>'index'));
		}
		$member = $this->Member->read(null, $id);
		if($this->isSuperAdmin()){
		}elseif($this->isAdmin()){
			if($member['Member']['role'] == 1 && $this->Cookie->read('userInfoFront.id') != $id || $member['Member']['role'] == 0){
				$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
				$this->redirect(array('controller' => 'forum', 'action' => 'login'));						
			}				
		}else{
			if($this->Cookie->read('userInfoFront.id') != $id){
				$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
				$this->redirect(array('controller' => 'forum', 'action' => 'login'));						
			}				
		}	
		//set the component var filesToDelete with an array of files should be deleted.
		$this->Member->id = $id;
		$this->Upload->filesToDelete = array($this->Member->field('image'));		
		if ($this->Member->delete($id)) {
			$this->Upload->deleteFile(); //to delete old images;
			$this->Session->setFlash(__('Contact deleted ', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Contact was not deleted', true));
		$this->redirect(array('action' => 'index'));
		$this->set('title_for_layout', 'Contacts');
	}	
	function deleteImage ($id){
		if (!$id) {
			$this->Session->setFlash(__('Invalid Contact', true));
			$this->redirect($this->referer(array('action' => 'index')));
		}
		//to delete image file
		$this->Member->id = $id;
		$member = $this->Member->read(null, $id);
		if($this->isSuperAdmin()){
		}elseif($this->isAdmin()){
			if($member['Member']['role'] == 1 && $this->Cookie->read('userInfoFront.id') != $id || $member['Member']['role'] == 0){
				$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
				$this->redirect(array('controller' => 'forum', 'action' => 'login'));						
			}				
		}else{
			if($this->Cookie->read('userInfoFront.id') != $id){
				$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
				$this->redirect(array('controller' => 'forum', 'action' => 'login'));						
			}				
		}	
		$this->Upload->filesToDelete = array($this->Member->field('image'));
		if ($this->Member->saveField('image', '')) {
			$this->Upload->deleteFile();
			$this->Session->setFlash(__('The Contact image has been deleted', true));
		} else {
			$this->Session->setFlash(__('The Contact image could not be deleted. Please, try again.', true));
		}
		$this->redirect($this->referer(array('action' => 'index')));	
	}		
	function get_roles(){
		$roles_superAdmin =  array(2 => 'User', 1 => 'Admin');
		$roles_admin =  array(2 => 'User');	
		if($this->isSuperAdmin()){
			return $roles_superAdmin;			
		}elseif($this->isAdmin()){
			return $roles_superAdmin;
			//return $roles_admin;			
		}else{
			return array();
		}
	}
	function all(){
		$key = '';
		if(isset($_GET['key'])){
			$key = $_GET['key'];
		}
		$this->get_members(0, $key);	
		$this->set('selected','contactspages');	
	}
	function group($group_id){
		$key = '';
		if(isset($_GET['key'])){
			$key = $_GET['key'];
		}
		$this->get_members($group_id, $key);
		$this->render('all');
		$this->set('selected','grouppages');	
	}
	function admin(){
		$key = '';
		if(isset($_GET['key'])){
			$key = $_GET['key'];
		}
		$this->get_members(-1, $key);
		$this->render('all');
		$this->set('selected','grouppages');	
	}
	public function get_members($group_id = 0, $key = ''){
		$this->Member->recursive = 0;
		$conditions = array();
		if($group_id == -1){
			$conditions['Member.role'] = 1;
		}
		if($group_id > 0){
			$this->loadModel('Group');
			$conditions['Member.group_id'] = $group_id;
			$this->set('group', $this->Group->read(null, $group_id));
		}
		$key = trim($key);
		if($key != ''){			
			$conditions['AND'] = array('OR' => array(
													'Member.fullname LIKE "%'.$key.'%"', 
													'Member.job_title LIKE "%'.$key.'%"'));			
		}
		$limit = $this->pagingLimit;
		$page = isset($this->params['named']['page'])?$this->params['named']['page']:$this->paginate['page'];	
		$conditions['Member.approved'] = 1;
		$this->paginate['Member'] = array(
    			//'fields'     => array('Member.id', 'Member.title', 'Member.body'),
    			'conditions' => $conditions,
				'order'      => array('TRIM(Member.fullname)' => 'ASC','Member.id'=>'DESC'),
		    	'limit'      => $limit,
		    	'page'  	 => $page
	    	);
		$this->set('page',$page);
		$this->set('members', $this->paginate('Member'));	
		$this->set('title_for_layout', 'Contacts');			
	}
	function admin_all(){
		$this->check_isAdmin_isSuperAdmin();
	}
}