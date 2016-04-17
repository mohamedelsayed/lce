<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2014 Programming by "mohamedelsayed.net"
 */
require_once '../auth_controller.php';
class SlideshowsController extends AuthController {

	var $name = 'Slideshows';
	//use upload component.
	var $components = array('Upload');
	var $target_options = array('0'=>'Self','1'=>'New');

	function index() {
		$this->paginate = array('order' => array('Slideshow.weight' => 'ASC'));
		$this->Slideshow->recursive = 0;
		$this->set('slideshows', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid slideshow', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('slideshow', $this->Slideshow->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			//upload image
			$this->data['Slideshow']['image']=$this->Upload->uploadImage($this->data['Slideshow']['image']);
			$this->Slideshow->create();
			if ($this->Slideshow->save($this->data)) {
				$this->Session->setFlash(__('The slideshow has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The slideshow could not be saved. Please, try again.', true));
			}
		}
		$this->set('target_options',$this->target_options);
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid slideshow', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			//upload image
			$this->Slideshow->id = $id;
			if($this->data['Slideshow']['image']['name']){
				$this->Upload->filesToDelete = array($this->Slideshow->field('image'));
				$this->data['Slideshow']['image']=$this->Upload->uploadImage($this->data['Slideshow']['image']);
			}else
				unset($this->data['Slideshow']['image']);
			if ($this->Slideshow->save($this->data)) {
				$this->Session->setFlash(__('The slideshow has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The slideshow could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Slideshow->read(null, $id);
		}
		$this->set('target_options',$this->target_options);
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for slideshow', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Slideshow->delete($id)) {
			$this->Session->setFlash(__('Slideshow deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Slideshow was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>