<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2014 Programming by "mohamedelsayed.net"
 */
require_once '../auth_controller.php';
class ContentsController extends AuthController {

	var $name = 'Contents';
	//use upload component
	var $components = array('Upload');

	function index() {
		$this->Content->recursive = 0;
		$this->set('contents', $this->paginate());
	}
	
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid content', true));
			$this->redirect(array('controller'=>'admin','action' => 'index'));
		}
		if (!empty($this->data)) {
			$this->data['Gal'][0]['image']=$this->Upload->uploadImage($this->data['Gal'][0]['image']);
			if($this->data['Gal'][0]['image']=='')unset($this->data['Gal']);
			//upload image and video file then add them to Videos.
			//$this->data['Video'][0]['image']=$this->Upload->uploadImage($this->data['Video'][0]['image']);
			//$this->Upload->fileTypes = 'flv';//set file types.
			//$this->data['Video'][0]['file']=$this->Upload->uploadFile($this->data['Video'][0]['file']);
			//if($this->data['Video'][0]['file']=='' && $this->data['Video'][0]['url']=='')unset($this->data['Video']);
			if($this->data['Video'][0]['url']=='')unset($this->data['Video']);
			if ($this->Content->saveAll($this->data)) {
				$this->Session->setFlash(__('The content has been saved', true));
				$this->redirect(array('action' => 'edit',$id));
				//$this->redirect(array('controller'=>'admin','action' => 'index'));
			} else {
				$this->Session->setFlash(__('The content could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Content->read(null, $id);
		}
	}
	/*function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid content', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('content', $this->Content->read(null, $id));
	}
	function add() {
		if (!empty($this->data)) {
			$this->Content->create();
			if ($this->Content->save($this->data)) {
				$this->Session->setFlash(__('The content has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The content could not be saved. Please, try again.', true));
			}
		}
	}*/
	/*function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for content', true));
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
?>