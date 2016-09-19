<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
require_once '../authfront_controller.php';
class ForumInstructorsController extends AuthfrontController {
	var $name = 'ForumInstructors';
	//use upload component.
	var $components = array('Upload');
	var $uses = array('Instructor');	
	function index() {
		$this->set('selected','adminpages');
		$this->Instructor->recursive = 0;
		$this->paginate = array(
			'conditions' => array('Instructor.forum_flag' => 1),
			'order' => array('Instructor.id' => 'DESC'),
    	);
		$this->set('instructors', $this->paginate());
	}
	function view($id = null) {
		$this->set('selected','adminpages');
		if (!$id) {
			$this->Session->setFlash(__('Invalid Instructor', true));
			$this->redirect(array('controller' => 'ForumInstructors', 'action' => 'index'));
		}
		$this->set('instructor', $this->Instructor->read(null, $id));
	}
	function add() {
		$this->set('selected','adminpages');
		if (!empty($this->data)) {
			//upload image
			$this->data['Instructor']['image']=$this->Upload->uploadImage($this->data['Instructor']['image']);
			$this->Instructor->create();
			if ($this->Instructor->save($this->data)) {
				$this->Session->setFlash(__('The Instructor has been saved', true));
				$this->redirect(array('controller' => 'ForumInstructors', 'action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Instructor could not be saved. Please, try again.', true));
			}
		}
	}
	function edit($id = null) {
		$this->set('selected','adminpages');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Instructor', true));
			$this->redirect(array('controller' => 'ForumInstructors', 'action' => 'index'));
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
				$this->redirect(array('controller' => 'ForumInstructors', 'action' => 'index'));
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
		$this->redirect(array('controller' => 'ForumInstructors', 'action' => 'index'));
	}
}