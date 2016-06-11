<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2013 Programming by "mohamedelsayed.net"
 */
require_once '../auth_controller.php';
class NodesController extends AuthController {

	var $name = 'Nodes';
	//use upload component.
	var $components = array('Upload');

	function index() {
		$this->Node->recursive = 0;
		if(isset($this->data['Node']['title'])){
			$this->paginate = array(
			'conditions' => array('Node.title LIKE' => "%".$this->data['Node']['title']."%"),
    		);
		}
		$this->set('nodes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid node', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('node', $this->Node->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			//upload image and then add it to Gal.
			$this->data['Gal'][0]['image']=$this->Upload->uploadImage($this->data['Gal'][0]['image']);
			if($this->data['Gal'][0]['image']=='')unset($this->data['Gal']);
			
			//upload image and video file then add them to Videos.
			//$this->data['Video'][0]['image']=$this->Upload->uploadImage($this->data['Video'][0]['image']);
			//$this->Upload->fileTypes = 'flv';//set file types.
			//$this->data['Video'][0]['file']=$this->Upload->uploadFile($this->data['Video'][0]['file']);
			//if($this->data['Video'][0]['file']=='' && $this->data['Video'][0]['url']=='')unset($this->data['Video']);
			//if($this->data['Video'][0]['url']=='')unset($this->data['Video']);
			
			//upload attachment file and then add it to Attachments.
			//$this->Upload->fileTypes = 'pdf';//set file types.
			//$this->data['Attachment'][0]['file']=$this->Upload->uploadFile($this->data['Attachment'][0]['file']);
			//if($this->data['Attachment'][0]['file']=='')unset($this->data['Attachment']);
			
			$this->Node->create();
			if ($this->Node->saveAll($this->data)) {
				$this->Session->setFlash(__('The node has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The node could not be saved. Please, try again.', true));
			}
		}
		//$artists = $this->Node->Artist->find('list');
		$cats = $this->Node->Cat->find('list');
		$this->set(compact('cats'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid node', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			//upload image and then add it to Gal.
			$this->data['Gal'][0]['image']=$this->Upload->uploadImage($this->data['Gal'][0]['image']);
			if($this->data['Gal'][0]['image']=='')unset($this->data['Gal']);
			
			//upload image and video file then add them to Videos.
			//$this->data['Video'][0]['image']=$this->Upload->uploadImage($this->data['Video'][0]['image']);
			//$this->Upload->fileTypes = 'flv';//set file types.
			//$this->data['Video'][0]['file']=$this->Upload->uploadFile($this->data['Video'][0]['file']);
			//if($this->data['Video'][0]['file']=='' && $this->data['Video'][0]['url']=='')unset($this->data['Video']);
			//if($this->data['Video'][0]['url']=='')unset($this->data['Video']);

			//upload attachment file and then add it to Attachments.
			//$this->Upload->fileTypes = 'pdf';//set file types.
			//$this->data['Attachment'][0]['file']=$this->Upload->uploadFile($this->data['Attachment'][0]['file']);
			//if($this->data['Attachment'][0]['file']=='')unset($this->data['Attachment']);
			
			if ($this->Node->saveAll($this->data)) {
				$this->Session->setFlash(__('The node has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The node could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Node->read(null, $id);
			if(isset($this->data['Cat']['parent_id'])){
				if($this->data['Cat']['parent_id'] == 2){
					$this->set('ourservices_cat_id', $this->data['Cat']['parent_id']);				
				}
			}
		}		
		//$artists = $this->Node->Artist->find('list');
		$cats = $this->Node->Cat->find('list');
		$this->set(compact('cats'));
	}

	function delete($id = null) {
		$forbidden_ids = array(2, 3, 5, 6, 20);
		if(in_array($id, $forbidden_ids)){
			$this->Session->setFlash(__('You cannot delete this Node!', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for node', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Node->delete($id)) {
			$this->Session->setFlash(__('Node deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Node was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>