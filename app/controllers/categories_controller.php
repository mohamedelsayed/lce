<?php /**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.mohamedelsayed.net/
 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */
require_once '../authfront_controller.php';
class CategoriesController extends AuthfrontController {
	var $name = 'Categories';
	var $uses = array('Category');
	//use upload component.
	var $components = array('Upload');
	function index() {
		$this->Category->recursive = 0;
		if($this->isSuperAdmin() || $this->isAdmin()){
			if(isset($this->data['Category']['title'])){
				$this->paginate = array(
				'conditions' => array('Category.title LIKE' => "%".$this->data['Category']['title']."%"),
	    		);
			}
			$this->set('categories', $this->paginate());
		}else{
			$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'login'));	
		}
	}
	function view($id = null) {
		if($this->isSuperAdmin() || $this->isAdmin()){
			if (!$id) {
				$this->Session->setFlash(__('Invalid Category', true));
				$this->redirect(array('action' => 'index'));
			}
			$this->set('category', $this->Category->read(null, $id));
		}else{
			$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'login'));	
		}
	}
	function add() {
		if($this->isSuperAdmin() || $this->isAdmin()){
			if (!empty($this->data)) {
				//upload image
				//$this->data['Category']['image']=$this->Upload->uploadImage($this->data['Category']['image']);
				$this->Category->create();
				if($this->data['Category']['parent_id'] == null){
					$this->data['Category']['parent_id'] = 0;				
				}
				if ($this->Category->save($this->data)) {
					$this->Session->setFlash(__('The Category has been saved', true));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The Category could not be saved. Please, try again.', true));
				}
			}
			//$artists = $this->Category->Artist->find('list');
			$parents = $this->Category->ParentCategory->find('list');
			$this->set(compact('parents'));
		}else{
			$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'login'));	
		}
	}
	function edit($id = null) {
		if($this->isSuperAdmin() || $this->isAdmin()){
			if (!$id && empty($this->data)) {
				$this->Session->setFlash(__('Invalid Category', true));
				$this->redirect(array('action' => 'index'));
			}
			if (!empty($this->data)) {
				//upload image
				$this->Category->id = $id;
				/*if($this->data['Category']['image']['name']){
					$this->Upload->filesToDelete = array($this->Category->field('image'));
					$this->data['Category']['image']=$this->Upload->uploadImage($this->data['Category']['image']);
				}else
					unset($this->data['Category']['image']);*/
				if ($this->Category->save($this->data)) {
					$this->Session->setFlash(__('The Category has been saved', true));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The Category could not be saved. Please, try again.', true));
				}
			}
			if (empty($this->data)) {
				$this->data = $this->Category->read(null, $id);
			}
			//$artists = $this->Category->Artist->find('list');
			$parents = $this->Category->ParentCategory->find('list',array('conditions'=>array('ParentCategory.id <>'=>$id)));
			$this->set(compact('parents'));
		}else{
			$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'login'));	
		}
	}
	function delete($id = null) {
		if($this->isSuperAdmin() || $this->isAdmin()){
			/*$forbidden_ids = array(1,2,3);
			if(in_array($id, $forbidden_ids)){
				$this->Session->setFlash(__('You cannot delete this Categoryegory!', true));
				$this->redirect(array('action'=>'index'));
			}*/
			if (!$id) {
				$this->Session->setFlash(__('Invalid id for Category', true));
				$this->redirect(array('action'=>'index'));
			}
			if ($this->Category->delete($id)) {
				$this->Session->setFlash(__('Category deleted', true));
				$this->redirect(array('action'=>'index'));
			}
			$this->Session->setFlash(__('Category was not deleted', true));
			$this->redirect(array('action' => 'index'));
		}else{
			$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'login'));	
		}
	}
	/*function getArtistCategoryegories($artistId = 0, $modelName='Category', $field = null, $empty = ''){
		$this->layout = 'ajax';
		$this->Category->recursive = -1;
		$categories = $this->Category->find('list', 
							  	 array('conditions' => array('artist_id' => $artistId)));
		$this->set(compact('categories'));
		//return $categories;
		$this->set('modelName', $modelName);
		$this->set('empty', $empty);
		$this->set('field', $field);
	}*/
	/*function deleteImage ($id){
		if (!$id) {
			$this->Session->setFlash(__('Invalid Category', true));
			$this->redirect($this->referer(array('action' => 'index')));
		}
		//to delete image file
		$this->Category->id = $id;
		$this->Upload->filesToDelete = array($this->Category->field('image'));
		if ($this->Category->saveField('image', '')) {
			$this->Upload->deleteFile();
			$this->Session->setFlash(__('The Category image has been deleted', true));
		} else {
			$this->Session->setFlash(__('The Category image could not be deleted. Please, try again.', true));
		}
		$this->redirect($this->referer(array('action' => 'index')));	
	}*/
}