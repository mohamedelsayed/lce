<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
require_once '../authfront_controller.php';
class GroupsController extends AuthfrontController {
	var $name = 'Groups';
	var $uses = array('Group');
	//use upload component.
	var $components = array('Upload');
	function index() {
		$this->Group->recursive = 0;
		if(isset($this->data['Group']['title'])){
			$this->paginate = array(
			'conditions' => array('Group.title LIKE' => "%".$this->data['Group']['title']."%"),
    		);
		}
		$this->set('groups', $this->paginate());
		$this->set('selected','adminpages');
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Group', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('group', $this->Group->read(null, $id));
		$this->set('selected','adminpages');
	}
	function add() {
		if (!empty($this->data)) {
			//upload image
			//$this->data['Group']['image']=$this->Upload->uploadImage($this->data['Group']['image']);
			$this->Group->create();
			if ($this->Group->save($this->data)) {
				$this->Session->setFlash(__('The group has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.', true));
			}
		}
		//$artists = $this->Group->Artist->find('list');
		//$parents = $this->Group->ParentGroup->find('list');
		//$this->set(compact('parents'));
		$this->set('selected','adminpages');
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid group', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			//upload image
			$this->Group->id = $id;
			/*if($this->data['Group']['image']['name']){
				$this->Upload->filesToDelete = array($this->Group->field('image'));
				$this->data['Group']['image']=$this->Upload->uploadImage($this->data['Group']['image']);
			}else{
				unset($this->data['Group']['image']);
			}*/
			if ($this->Group->save($this->data)) {
				$this->Session->setFlash(__('The group has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Group->read(null, $id);
		}
		//$artists = $this->Group->Artist->find('list');
		//$parents = $this->Group->ParentGroup->find('list',array('conditions'=>array('ParentGroup.id <>'=>$id)));
		//$this->set(compact('parents'));
		$this->set('selected','adminpages');
	}
	function delete($id = null) {
		/*$forbidden_ids = array(1,2,3);
		if(in_array($id, $forbidden_ids)){
			$this->Session->setFlash(__('You cannot delete this Groupegory!', true));
			$this->redirect(array('action'=>'index'));
		}*/
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Group', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Group->delete($id)) {
			$this->Session->setFlash(__('Group deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Group was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}