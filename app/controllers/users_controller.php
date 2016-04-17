<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2014 Programming by "mohamedelsayed.net"
 */
require_once '../auth_controller.php';
class UsersController extends AuthController {

	var $name = 'Users';
	var $uses = array('User');
	//use upload component.
	var $components = array('Upload');
		
	function index() {
		$this->User->recursive = 0;
		$this->paginate = array(
			'conditions' => array('User.id >' => 1)
    	);
		$this->set('users', $this->paginate());
	}
	
	function view($id = null) {
		$this->User->recursive = 0;
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}
	
	function add() {
		if (!empty($this->data)) {
			//upload image
			$this->data['User']['image']=$this->Upload->uploadImage($this->data['User']['image']);
			
			//hash password
			if($this->data['User']['password'] != '')
				$this->data['User']['password'] = Security::hash($this->data['User']['password'], null, true);
			
			//save data
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		//$groups = $this->User->Group->find('list');
		//$this->set(compact('groups'));
	}	

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			
			//to upload image
			$this->User->id = $id;
			if($this->data['User']['image']['name']){
				$this->Upload->filesToDelete = array($this->User->field('image'));
				$this->data['User']['image']=$this->Upload->uploadImage($this->data['User']['image']);
			}else
				$this->data['User']['image'] = $this->User->field('image');
				
			//if password changed do changes
			if(($this->data['User']['password'] != $this->User->field('password')) && ($this->data['User']['password'] != ''))	
				$this->data['User']['password'] = Security::hash($this->data['User']['password'], null, true);
				
			if ($this->User->save($this->data)) {
				$this->Upload->deleteFile();//to delete old images;
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
		//$groups = $this->User->Group->find('list');
		//$this->set(compact('groups'));
	}
	
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if($id <= 2){
			$this->Session->setFlash(__('Sorry! Web Master can not be deleted.', true));
			$this->redirect(array('action'=>'index'));
		}
		//set the component var filesToDelete with an array of files should be deleted.
		$this->User->id = $id;
		$this->Upload->filesToDelete = array($this->User->field('image'));
		
		if ($this->User->delete($id)) {
			$this->Upload->deleteFile(); //to delete old images;
			$this->Session->setFlash(__('User deleted ', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function deleteImage ($id){
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect($this->referer(array('action' => 'index')));
		}
		//to delete image file
		$this->User->id = $id;
		$this->Upload->filesToDelete = array($this->User->field('image'));
		if ($this->User->saveField('image', '')) {
			$this->Upload->deleteFile();
			$this->Session->setFlash(__('The user image has been deleted', true));
		} else {
			$this->Session->setFlash(__('The user image could not be deleted. Please, try again.', true));
		}
		$this->redirect($this->referer(array('action' => 'index')));	
	}		
}
?>