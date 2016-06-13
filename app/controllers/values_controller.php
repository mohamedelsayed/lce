<?php /**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.mohamedelsayed.net
 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */
require_once '../auth_controller.php';
class ValuesController extends AuthController {
	var $name = 'Values';
	var $uses = array('Value');
	//use upload component.
	var $components = array('Upload');
	function index() {
		$this->Value->recursive = 0;
		if(isset($this->data['Value']['title'])){
			$this->paginate = array(
			'conditions' => array('Value.title LIKE' => "%".$this->data['Value']['title']."%"),
    		);
		}
		$this->set('values', $this->paginate());       
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid value', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('value', $this->Value->read(null, $id));
	}
	function add() {
		if (!empty($this->data)) {
			//upload image
			$this->data['Value']['image']=$this->Upload->uploadImage($this->data['Value']['image']);
			$this->Value->create();
			if ($this->Value->save($this->data)) {
				$this->Session->setFlash(__('The value has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The value could not be saved. Please, try again.', true));
			}
		}
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid value', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			//upload image
			$this->Value->id = $id;
			if($this->data['Value']['image']['name']){
				$this->Upload->filesToDelete = array($this->Value->field('image'));
				$this->data['Value']['image']=$this->Upload->uploadImage($this->data['Value']['image']);
			}else
				unset($this->data['Value']['image']);
			if ($this->Value->save($this->data)) {
				$this->Session->setFlash(__('The value has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The value could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Value->read(null, $id);
		}
	}
	function delete($id = null) {
		$forbidden_ids = array();
		if(in_array($id, $forbidden_ids)){
			$this->Session->setFlash(__('You cannot delete this Value!', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for value', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Value->delete($id)) {
			$this->Session->setFlash(__('Value deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Value was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}	
	function deleteImage ($id){
		if (!$id) {
			$this->Session->setFlash(__('Invalid Value', true));
			$this->redirect($this->referer(array('action' => 'index')));
		}
		//to delete image file
		$this->Value->id = $id;
		$this->Upload->filesToDelete = array($this->Value->field('image'));
		if ($this->Value->saveField('image', '')) {
			$this->Upload->deleteFile();
			$this->Session->setFlash(__('The Value image has been deleted', true));
		} else {
			$this->Session->setFlash(__('The Value image could not be deleted. Please, try again.', true));
		}
		$this->redirect($this->referer(array('action' => 'index')));	
	}
}