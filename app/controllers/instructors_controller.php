<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
require_once '../auth_controller.php';
class InstructorsController extends AuthController {
	var $name = 'Instructors';
	//use upload component.
	var $components = array('Upload');
	function index() {
		$this->Instructor->recursive = 0;
		$this->paginate = array(
			'conditions' => array('Instructor.forum_flag' => 0),
			'order' => array('Instructor.id' => 'DESC'),
    	);
		$this->set('instructors', $this->paginate());
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Instructor', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('instructor', $this->Instructor->read(null, $id));
	}
	function add() {
		if (!empty($this->data)) {
			//upload image
			$this->data['Instructor']['image']=$this->Upload->uploadImage($this->data['Instructor']['image']);
			$this->Instructor->create();
			if ($this->Instructor->save($this->data)) {
				$this->Session->setFlash(__('The Instructor has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Instructor could not be saved. Please, try again.', true));
			}
		}
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Instructor', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			//upload image
			$this->Instructor->id = $id;
			if($this->data['Instructor']['image']['name']){
				$this->Upload->filesToDelete = array($this->Instructor->field('image'));
				$this->data['Instructor']['image']=$this->Upload->uploadImage($this->data['Instructor']['image']);
			}else
				unset($this->data['Instructor']['image']);
			if ($this->Instructor->save($this->data)) {
				$this->Session->setFlash(__('The Instructor has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Instructor could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Instructor->read(null, $id);
		}
	}
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Instructor', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Instructor->delete($id)) {
			$this->Session->setFlash(__('Instructor deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Instructor was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function deleteImage ($id){
		$model = 'Instructor';
		if (!$id) {
			$this->Session->setFlash(__('Invalid Item', true));
			$this->redirect($this->referer(array('action' => 'index')));
		}
		//to delete image file
		$this->$model->id = $id;
		$this->Upload->filesToDelete = array($this->$model->field('image'));
		if ($this->$model->saveField('image', '')) {
			$this->Upload->deleteFile();
			$this->Session->setFlash(__('The Item image has been deleted', true));
		} else {
			$this->Session->setFlash(__('The Item image could not be deleted. Please, try again.', true));
		}
		$this->redirect($this->referer(array('action' => 'index')));	
	}
}