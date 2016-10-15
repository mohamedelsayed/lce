<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
require_once '../authfront_controller.php';
class ForumContentsController extends AuthfrontController {
	var $name = 'ForumContents';
	//use upload component
	var $components = array('Upload');
	var $uses = array('Content');
	function index() {
		$this->Content->recursive = 0;
		$this->paginate = array(
			'conditions' => array('Content.forum_flag' => 1),
			'order' => array('Content.id' => 'DESC'),
    	);
		$this->set('contents', $this->paginate());
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid item', true));
			$this->redirect(array('controller'=>'forum','action' => 'admin_all'));
		}		
		if (!empty($this->data)) {
			$this->data['Gal'][0]['image'] = $this->Upload->uploadImage($this->data['Gal'][0]['image']);
			if($this->data['Gal'][0]['image'] == '') unset($this->data['Gal']);
			//upload image and video file then add them to Videos.
			//$this->data['Video'][0]['image']=$this->Upload->uploadImage($this->data['Video'][0]['image']);
			//$this->Upload->fileTypes = 'flv';//set file types.
			//$this->data['Video'][0]['file']=$this->Upload->uploadFile($this->data['Video'][0]['file']);
			//if($this->data['Video'][0]['file']=='' && $this->data['Video'][0]['url']=='')unset($this->data['Video']);
			//if($this->data['Video'][0]['url']=='')unset($this->data['Video']);
			if ($this->Content->saveAll($this->data)) {
				$this->Session->setFlash(__('The item has been saved', true));
				$this->redirect(array('controller' => 'forum', 'action' => 'admin_all'));
				//$this->redirect(array('controller'=>'forum','action' => 'index'));
			} else {
				$this->Session->setFlash(__('The item could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Content->read(null, $id);
		}
	}
	/*function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid item', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('content', $this->Content->read(null, $id));
	}
	function add() {
		if (!empty($this->data)) {
			$this->Content->create();
			if ($this->Content->save($this->data)) {
				$this->Session->setFlash(__('The item has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The item could not be saved. Please, try again.', true));
			}
		}
	}*/
	/*function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for item', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Content->delete($id)) {
			$this->Session->setFlash(__('Content deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Content was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}*/
}