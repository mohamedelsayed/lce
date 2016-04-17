<?php
require_once '../auth_controller.php';
class LogosController extends AuthController {
	var $name = 'Logos';
	var $components = array('Upload');
	function index() {
		$this->paginate = array('order' => array('Logo.weight' => 'ASC'));
		$this->Logo->recursive = 0;
		$this->set('logos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid logo', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('logo', $this->Logo->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->data['Logo']['image']=$this->Upload->uploadImage($this->data['Logo']['image']);
			$this->Logo->create();
			if ($this->Logo->save($this->data)) {
				$this->Session->setFlash(__('The logo has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The logo could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid logo', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$this->Logo->id = $id;

			if($this->data['Logo']['image']['name']){

				$this->Upload->filesToDelete = array($this->Logo->field('image'));
				$this->data['Logo']['image']=$this->Upload->uploadImage($this->data['Logo']['image']);

			}else

				unset($this->data['Logo']['image']);
			if ($this->Logo->save($this->data)) {
				$this->Session->setFlash(__('The logo has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The logo could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Logo->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for logo', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Logo->id = $id;

		$this->Upload->filesToDelete = array($this->Logo->field('image'));
		if ($this->Logo->delete($id)) {
			$this->Session->setFlash(__('Logo deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Logo was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function deleteImage ($id){

		if (!$id) {
			$this->Session->setFlash(__('Invalid image', true));
			$this->redirect($this->referer(array('action' => 'index')));
		}
		$this->Logo->id = $id;
		$this->Upload->filesToDelete = array($this->Logo->field('image'));
		if ($this->Logo->saveField('image', '')) {
			$this->Upload->deleteFile();
			$this->Session->setFlash(__('The image has been deleted', true));
		} else {
			$this->Session->setFlash(__('The image could not be deleted. Please, try again.', true));
		}
		$this->redirect($this->referer(array('action' => 'index')));	
	}
}
?>