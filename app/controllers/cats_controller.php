<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2014 Programming by "mohamedelsayed.net"
 */
require_once '../auth_controller.php';
class CatsController extends AuthController {

	var $name = 'Cats';
	var $uses = array('Cat');
	//use upload component.
	var $components = array('Upload');

	function index() {
		$this->Cat->recursive = 0;
		if(isset($this->data['Cat']['title'])){
			$this->paginate = array(
			'conditions' => array('Cat.title LIKE' => "%".$this->data['Cat']['title']."%"),
    		);
		}
		$this->set('cats', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid cat', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('cat', $this->Cat->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			//upload image
			$this->data['Cat']['image']=$this->Upload->uploadImage($this->data['Cat']['image']);
			$this->Cat->create();
			if ($this->Cat->save($this->data)) {
				$this->Session->setFlash(__('The cat has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cat could not be saved. Please, try again.', true));
			}
		}
		//$artists = $this->Cat->Artist->find('list');
		$parents = $this->Cat->ParentCat->find('list');
		$this->set(compact('parents'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid cat', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			//upload image
			$this->Cat->id = $id;
			if($this->data['Cat']['image']['name']){
				$this->Upload->filesToDelete = array($this->Cat->field('image'));
				$this->data['Cat']['image']=$this->Upload->uploadImage($this->data['Cat']['image']);
			}else
				unset($this->data['Cat']['image']);
			if ($this->Cat->save($this->data)) {
				$this->Session->setFlash(__('The cat has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cat could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Cat->read(null, $id);
		}
		//$artists = $this->Cat->Artist->find('list');
		$parents = $this->Cat->ParentCat->find('list',array('conditions'=>array('ParentCat.id <>'=>$id)));
		$this->set(compact('parents'));
	}
	function delete($id = null) {
		$forbidden_ids = array(1,2,3);
		if(in_array($id, $forbidden_ids)){
			$this->Session->setFlash(__('You cannot delete this Category!', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for cat', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Cat->delete($id)) {
			$this->Session->setFlash(__('Cat deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Cat was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	/*function getArtistCats($artistId = 0, $modelName='Cat', $field = null, $empty = ''){
		$this->layout = 'ajax';
		$this->Cat->recursive = -1;
		$cats = $this->Cat->find('list', 
							  	 array('conditions' => array('artist_id' => $artistId)));
		$this->set(compact('cats'));
		//return $cats;
		$this->set('modelName', $modelName);
		$this->set('empty', $empty);
		$this->set('field', $field);
	}*/
	function deleteImage ($id){
		if (!$id) {
			$this->Session->setFlash(__('Invalid Cat', true));
			$this->redirect($this->referer(array('action' => 'index')));
		}
		//to delete image file
		$this->Cat->id = $id;
		$this->Upload->filesToDelete = array($this->Cat->field('image'));
		if ($this->Cat->saveField('image', '')) {
			$this->Upload->deleteFile();
			$this->Session->setFlash(__('The Cat image has been deleted', true));
		} else {
			$this->Session->setFlash(__('The Cat image could not be deleted. Please, try again.', true));
		}
		$this->redirect($this->referer(array('action' => 'index')));	
	}
}
?>