<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
require_once '../auth_controller.php';
class NeventOrdersController extends AuthController {
	var $name = 'NeventOrders';
	//use upload component.
	var $components = array('Upload');
	function index() {
		$this->NeventOrder->recursive = 0;
		$this->paginate = array(
			//'conditions' => array('Node.title LIKE' => "%".$this->data['Node']['title']."%"),
			'order' => array('NeventOrder.id'=>'DESC'),
		);
		$this->set('nevent_orders', $this->paginate());
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid NeventOrder', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('nevent_order', $this->NeventOrder->read(null, $id));
	}
	/*function add() {
		if (!empty($this->data)) {
			//upload image
			$this->data['NeventOrder']['image']=$this->Upload->uploadImage($this->data['NeventOrder']['image']);
			$this->NeventOrder->create();
			if ($this->NeventOrder->save($this->data)) {
				$this->Session->setFlash(__('The NeventOrder has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The NeventOrder could not be saved. Please, try again.', true));
			}
		}
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid NeventOrder', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			//upload image
			$this->NeventOrder->id = $id;
			if($this->data['NeventOrder']['image']['name']){
				$this->Upload->filesToDelete = array($this->NeventOrder->field('image'));
				$this->data['NeventOrder']['image']=$this->Upload->uploadImage($this->data['NeventOrder']['image']);
			}else
				unset($this->data['NeventOrder']['image']);
			if ($this->NeventOrder->save($this->data)) {
				$this->Session->setFlash(__('The NeventOrder has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The NeventOrder could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->NeventOrder->read(null, $id);
		}
	}
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for NeventOrder', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->NeventOrder->delete($id)) {
			$this->Session->setFlash(__('NeventOrder deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('NeventOrder was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}*/
}