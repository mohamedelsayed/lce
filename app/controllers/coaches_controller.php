<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
require_once '../auth_controller.php';
class CoachesController extends AuthController {
	var $name = 'Coaches';
	//use upload component.
	var $components = array('Upload');
	function index() {
		$this->Coach->recursive = 0;
		$this->set('coaches', $this->paginate());
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Coach', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('coach', $this->Coach->read(null, $id));
	}
	function add() {
		if (!empty($this->data)) {
			//upload image
			$this->data['Coach']['image']=$this->Upload->uploadImage($this->data['Coach']['image']);
			$this->Upload->fileTypes = 'flv';//set file types.
			$this->data['Coach']['video_file']=$this->Upload->uploadFile($this->data['Coach']['video_file']);
			$this->Coach->create();
			if ($this->Coach->save($this->data)) {
				$this->Session->setFlash(__('The Coach has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Coach could not be saved. Please, try again.', true));
			}
		}
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Coach', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			//upload image
			$this->Coach->id = $id;
			if($this->data['Coach']['image']['name']){
				$this->Upload->filesToDelete = array($this->Coach->field('image'));
				$this->data['Coach']['image'] = $this->Upload->uploadImage($this->data['Coach']['image']);
			}else{
				unset($this->data['Coach']['image']);
			}
			$this->Upload->fileTypes = 'flv';//set file types.
			if($this->data['Coach']['video_file']['name']){
				$this->Upload->filesToDelete = array($this->Coach->field('video_file'));
				$this->data['Coach']['video_file'] = $this->Upload->uploadFile($this->data['Coach']['video_file']);
			}else{
				unset($this->data['Coach']['video_file']);
			}
			if ($this->Coach->save($this->data)) {
				$this->Session->setFlash(__('The Coach has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Coach could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Coach->read(null, $id);
		}
	}
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Coach', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Coach->delete($id)) {
			$this->Session->setFlash(__('Coach deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Coach was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}