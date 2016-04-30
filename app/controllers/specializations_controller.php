<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
require_once '../auth_controller.php';
class SpecializationsController extends AuthController {
	var $name = 'Specializations';
	var $uses = array('Specialization');
	//use upload component.
	var $components = array('Upload');
	function index() {
		$this->Specialization->recursive = 0;
		if(isset($this->data['Specialization']['title'])){
			$this->paginate = array(
			'conditions' => array('Specialization.title LIKE' => "%".$this->data['Specialization']['title']."%"),
    		);
		}
		$this->set('specializations', $this->paginate());
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid specialization', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('specialization', $this->Specialization->read(null, $id));
	}
	function add() {
		if (!empty($this->data)) {
			//upload image
			//$this->data['Specialization']['image']=$this->Upload->uploadImage($this->data['Specialization']['image']);
			$this->Specialization->create();
			if ($this->Specialization->save($this->data)) {
				$this->Session->setFlash(__('The specialization has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The specialization could not be saved. Please, try again.', true));
			}
		}
		//$artists = $this->Specialization->Artist->find('list');
		//$parents = $this->Specialization->ParentSpecialization->find('list');
		//$this->set(compact('parents'));
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid specialization', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			//upload image
			$this->Specialization->id = $id;
			/*if($this->data['Specialization']['image']['name']){
				$this->Upload->filesToDelete = array($this->Specialization->field('image'));
				$this->data['Specialization']['image']=$this->Upload->uploadImage($this->data['Specialization']['image']);
			}else
				unset($this->data['Specialization']['image']);*/
			if ($this->Specialization->save($this->data)) {
				$this->Session->setFlash(__('The specialization has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The specialization could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Specialization->read(null, $id);
		}
		//$artists = $this->Specialization->Artist->find('list');
		//$parents = $this->Specialization->ParentSpecialization->find('list',array('conditions'=>array('ParentSpecialization.id <>'=>$id)));
		//$this->set(compact('parents'));
	}
	function delete($id = null) {
		/*$forbidden_ids = array(1,2,3);
		if(in_array($id, $forbidden_ids)){
			$this->Session->setFlash(__('You cannot delete this Specializationegory!', true));
			$this->redirect(array('action'=>'index'));
		}*/
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for specialization', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Specialization->delete($id)) {
			$this->Session->setFlash(__('Specialization deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Specialization was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	/*function getArtistSpecializations($artistId = 0, $modelName='Specialization', $field = null, $empty = ''){
		$this->layout = 'ajax';
		$this->Specialization->recursive = -1;
		$specializations = $this->Specialization->find('list', 
							  	 array('conditions' => array('artist_id' => $artistId)));
		$this->set(compact('specializations'));
		//return $specializations;
		$this->set('modelName', $modelName);
		$this->set('empty', $empty);
		$this->set('field', $field);
	}*/
	/*function deleteImage ($id){
		if (!$id) {
			$this->Session->setFlash(__('Invalid Specialization', true));
			$this->redirect($this->referer(array('action' => 'index')));
		}
		//to delete image file
		$this->Specialization->id = $id;
		$this->Upload->filesToDelete = array($this->Specialization->field('image'));
		if ($this->Specialization->saveField('image', '')) {
			$this->Upload->deleteFile();
			$this->Session->setFlash(__('The Specialization image has been deleted', true));
		} else {
			$this->Session->setFlash(__('The Specialization image could not be deleted. Please, try again.', true));
		}
		$this->redirect($this->referer(array('action' => 'index')));	
	}*/
}