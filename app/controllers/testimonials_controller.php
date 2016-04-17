<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2014 Programming by "mohamedelsayed.net"
 */
require_once '../auth_controller.php';
class TestimonialsController extends AuthController {

	var $name = 'Testimonials';
	//use upload component.
	var $components = array('Upload');

	function index() {
		$this->Testimonial->recursive = 0;
		$this->set('testimonials', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid testimonial', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('testimonial', $this->Testimonial->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			//upload image
			$this->data['Testimonial']['image']=$this->Upload->uploadImage($this->data['Testimonial']['image']);
			$this->Testimonial->create();
			if ($this->Testimonial->save($this->data)) {
				$this->Session->setFlash(__('The testimonial has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The testimonial could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid testimonial', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			//upload image
			$this->Testimonial->id = $id;
			if($this->data['Testimonial']['image']['name']){
				$this->Upload->filesToDelete = array($this->Testimonial->field('image'));
				$this->data['Testimonial']['image']=$this->Upload->uploadImage($this->data['Testimonial']['image']);
			}else
				unset($this->data['Testimonial']['image']);
			if ($this->Testimonial->save($this->data)) {
				$this->Session->setFlash(__('The testimonial has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The testimonial could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Testimonial->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for testimonial', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Testimonial->delete($id)) {
			$this->Session->setFlash(__('Testimonial deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Testimonial was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>