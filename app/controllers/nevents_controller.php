<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
require_once '../auth_controller.php';
class NeventsController extends AuthController {
	var $name = 'Nevents';
	//use upload component.
	var $components = array('Upload');
	function index() {
		$this->Nevent->recursive = 0;
		$this->set('nevents', $this->paginate());
		$this->set('title_for_layout' , 'Events');
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Event', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('nevent', $this->Nevent->read(null, $id));
		$this->set('title_for_layout' , 'Events');
	}
	function add() {
		if (!empty($this->data)) {
			//upload image
			$this->data['Nevent']['image']=$this->Upload->uploadImage($this->data['Nevent']['image']);
			$this->Nevent->create();
			if ($this->Nevent->save($this->data)) {
				$this->Session->setFlash(__('The Event has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Event could not be saved. Please, try again.', true));
			}
		}
		$instructors = $this->Nevent->Instructor->find('list');
		$this->set(compact('instructors'));
		$this->set('title_for_layout' , 'Events');
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Event', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			//upload image
			$this->Nevent->id = $id;
			if($this->data['Nevent']['image']['name']){
				$this->Upload->filesToDelete = array($this->Nevent->field('image'));
				$this->data['Nevent']['image']=$this->Upload->uploadImage($this->data['Nevent']['image']);
			}else
				unset($this->data['Nevent']['image']);
			if ($this->Nevent->save($this->data)) {
				$this->Session->setFlash(__('The Event has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Event could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Nevent->read(null, $id);
		}
		$instructors = $this->Nevent->Instructor->find('list');
		$this->set(compact('instructors'));
		$this->set('title_for_layout' , 'Events');
	}
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Event', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Nevent->delete($id)) {
			$this->Session->setFlash(__('Nevent deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Nevent was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}