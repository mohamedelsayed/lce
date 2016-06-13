<?php /**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.mohamedelsayed.net
 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */
require_once '../auth_controller.php';
class PointsController extends AuthController {
	var $name = 'Points';
	var $uses = array('Point');
	//use upload component.
	var $components = array('Upload');
	function index() {
		$this->Point->recursive = 0;
		if(isset($this->data['Point']['title'])){
			$this->paginate = array(
			'conditions' => array('Point.title LIKE' => "%".$this->data['Point']['title']."%"),
    		);
		}
		$this->set('points', $this->paginate());       
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid point', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('point', $this->Point->read(null, $id));
	}
	function add() {
		if (!empty($this->data)) {
			//upload image
			$this->data['Point']['image']=$this->Upload->uploadImage($this->data['Point']['image']);
			$this->Point->create();
			if ($this->Point->save($this->data)) {
				$this->Session->setFlash(__('The point has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The point could not be saved. Please, try again.', true));
			}
		}
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid point', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			//upload image
			$this->Point->id = $id;
			if($this->data['Point']['image']['name']){
				$this->Upload->filesToDelete = array($this->Point->field('image'));
				$this->data['Point']['image']=$this->Upload->uploadImage($this->data['Point']['image']);
			}else
				unset($this->data['Point']['image']);
			if ($this->Point->save($this->data)) {
				$this->Session->setFlash(__('The point has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The point could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Point->read(null, $id);
		}
	}
	function delete($id = null) {
		$forbidden_ids = array();
		if(in_array($id, $forbidden_ids)){
			$this->Session->setFlash(__('You cannot delete this Point!', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for point', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Point->delete($id)) {
			$this->Session->setFlash(__('Point deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Point was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}	
	function deleteImage ($id){
		if (!$id) {
			$this->Session->setFlash(__('Invalid Point', true));
			$this->redirect($this->referer(array('action' => 'index')));
		}
		//to delete image file
		$this->Point->id = $id;
		$this->Upload->filesToDelete = array($this->Point->field('image'));
		if ($this->Point->saveField('image', '')) {
			$this->Upload->deleteFile();
			$this->Session->setFlash(__('The Point image has been deleted', true));
		} else {
			$this->Session->setFlash(__('The Point image could not be deleted. Please, try again.', true));
		}
		$this->redirect($this->referer(array('action' => 'index')));	
	}
}