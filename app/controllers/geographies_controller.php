<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
require_once '../auth_controller.php';
class GeographiesController extends AuthController {
	var $name = 'Geographies';
	var $uses = array('Geography');
	//use upload component.
	var $components = array('Upload');
	function index() {
		$this->Geography->recursive = 0;
		if(isset($this->data['Geography']['title'])){
			$this->paginate = array(
			'conditions' => array('Geography.title LIKE' => "%".$this->data['Geography']['title']."%"),
    		);
		}
		$this->set('geographys', $this->paginate());
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid geography', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('geography', $this->Geography->read(null, $id));
	}
	function add() {
		if (!empty($this->data)) {
			//upload image
			//$this->data['Geography']['image']=$this->Upload->uploadImage($this->data['Geography']['image']);
			$this->Geography->create();
			if ($this->Geography->save($this->data)) {
				$this->Session->setFlash(__('The geography has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The geography could not be saved. Please, try again.', true));
			}
		}
		//$artists = $this->Geography->Artist->find('list');
		//$parents = $this->Geography->ParentGeography->find('list');
		//$this->set(compact('parents'));
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid geography', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			//upload image
			$this->Geography->id = $id;
			/*if($this->data['Geography']['image']['name']){
				$this->Upload->filesToDelete = array($this->Geography->field('image'));
				$this->data['Geography']['image']=$this->Upload->uploadImage($this->data['Geography']['image']);
			}else
				unset($this->data['Geography']['image']);*/
			if ($this->Geography->save($this->data)) {
				$this->Session->setFlash(__('The geography has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The geography could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Geography->read(null, $id);
		}
		//$artists = $this->Geography->Artist->find('list');
		//$parents = $this->Geography->ParentGeography->find('list',array('conditions'=>array('ParentGeography.id <>'=>$id)));
		//$this->set(compact('parents'));
	}
	function delete($id = null) {
		/*$forbidden_ids = array(1,2,3);
		if(in_array($id, $forbidden_ids)){
			$this->Session->setFlash(__('You cannot delete this Geographyegory!', true));
			$this->redirect(array('action'=>'index'));
		}*/
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for geography', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Geography->delete($id)) {
			$this->Session->setFlash(__('Geography deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Geography was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	/*function getArtistGeographys($artistId = 0, $modelName='Geography', $field = null, $empty = ''){
		$this->layout = 'ajax';
		$this->Geography->recursive = -1;
		$geographys = $this->Geography->find('list', 
							  	 array('conditions' => array('artist_id' => $artistId)));
		$this->set(compact('geographys'));
		//return $geographys;
		$this->set('modelName', $modelName);
		$this->set('empty', $empty);
		$this->set('field', $field);
	}*/
	/*function deleteImage ($id){
		if (!$id) {
			$this->Session->setFlash(__('Invalid Geography', true));
			$this->redirect($this->referer(array('action' => 'index')));
		}
		//to delete image file
		$this->Geography->id = $id;
		$this->Upload->filesToDelete = array($this->Geography->field('image'));
		if ($this->Geography->saveField('image', '')) {
			$this->Upload->deleteFile();
			$this->Session->setFlash(__('The Geography image has been deleted', true));
		} else {
			$this->Session->setFlash(__('The Geography image could not be deleted. Please, try again.', true));
		}
		$this->redirect($this->referer(array('action' => 'index')));	
	}*/
}