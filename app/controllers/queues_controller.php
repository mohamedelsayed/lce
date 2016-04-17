<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2014 Programming by "mohamedelsayed.net"
 */
require_once '../auth_controller.php';
class QueuesController extends AuthController {
	var $name = 'Queues';
	var $uses = array('Queue');		
	function index() {
    	$this->Queue->recursive = 0;
		$this->paginate = array(    			
			'order'      => array('Queue.id'=>'DESC')
    	);	
		$this->set('queues', $this->paginate());
	}
	/*function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Queue', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('queue', $this->Queue->read(null, $id));
	}
	function add() {
		if (!empty($this->data)) {			
			//save data
			$this->Queue->create();
			if ($this->Queue->saveAll($this->data, array('validate'=>'first'))) {				
				//set flash
				$this->Session->setFlash(__('The Queue has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Queue could not be saved. Please, try again.', true));
			}
		}		
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Queue', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {				
			//save data
			if ($this->Queue->saveAll($this->data, array('validate'=>'first'))) {
				//set flash
				$this->Session->setFlash(__('The Queue has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Queue could not be saved. Please, try again.', true));
			}
		}
		//hold validation erros then load it again aftre reading data.
		$holdErrors = $this->Queue->validationErrors;
		$this->data = $this->Queue->read(null, $id);
		$this->Queue->validationErrors = $holdErrors;		
	}*/	
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Queue', true));
			$this->redirect(array('action'=>'index'));
		}
				
		//delete
		if ($this->Queue->delete($id)) {		
			//set flash
			$this->Session->setFlash(__('Queue deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Queue was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}		
}
?>