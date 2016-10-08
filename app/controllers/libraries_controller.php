<?php /**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.mohamedelsayed.net/
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
require_once '../authfront_controller.php';
class LibrariesController extends AuthfrontController {
	var $name = 'Libraries';
	var $uses = array('Library');
	//use upload component.
	var $components = array('Upload');
	function index() {		
		$type1 = isset($this->params['named']['type1'])?$this->params['named']['type1']:0;	
		$this->set('type1', $type1);
		$this->check_isAdmin_isSuperAdmin();
		$this->Library->recursive = 0;
		$order = array('Library.updated' => 'DESC', 'Library.created' => 'DESC', 'Library.id' => 'DESC');		
		$this->paginate = array(
			'conditions' => array('Library.type1' => $type1),
			'order' => $order,
    	);
		$this->set('libraries', $this->paginate());
		$this->set('title_for_layout' , 'Libraries');			
	}
	function view($id = null) {
		$this->check_isAdmin_isSuperAdmin();
		if (!$id) {
			$this->Session->setFlash(__('Invalid Library', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('library', $this->Library->read(null, $id));		
	}
	function add() {		
		$type1 = isset($this->params['named']['type1'])?$this->params['named']['type1']:0;
		$this->set('type1', $type1);
		$this->check_isAdmin_isSuperAdmin();
		if (!empty($this->data)) {
			//upload image
			//$this->data['Library']['image']=$this->Upload->uploadImage($this->data['Library']['image']);
			$this->Library->create();
			/*if($this->data['Library']['parent_id'] == null){
				$this->data['Library']['parent_id'] = 0;				
			}*/
			if ($this->Library->save($this->data)) {
				$this->Session->setFlash(__('The Library has been saved', true));
				$this->redirect(array('action' => 'index/type1:'.$this->data['Library']['type1']));
			} else {
				$this->Session->setFlash(__('The Library could not be saved. Please, try again.', true));
			}
		}
		//$artists = $this->Library->Artist->find('list');
		//$parents = $this->Library->ParentLibrary->find('list');
		//$this->set(compact('parents'));
	}
	function edit($id = null) {
		$this->check_isAdmin_isSuperAdmin();
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Library', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			//upload image
			$this->Library->id = $id;
			/*if($this->data['Library']['image']['name']){
				$this->Upload->filesToDelete = array($this->Library->field('image'));
				$this->data['Library']['image']=$this->Upload->uploadImage($this->data['Library']['image']);
			}else
				unset($this->data['Library']['image']);*/
			if ($this->Library->save($this->data)) {
				$this->Session->setFlash(__('The Library has been saved', true));
				$this->redirect(array('action' => 'index/type1:'.$this->data['Library']['type1']));
			} else {
				$this->Session->setFlash(__('The Library could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Library->read(null, $id);
		}
		//$artists = $this->Library->Artist->find('list');
		//$parents = $this->Library->ParentLibrary->find('list',array('conditions'=>array('ParentLibrary.id <>'=>$id)));
		//$this->set(compact('parents'));
	}
	function delete($id = null) {
		$this->check_isAdmin_isSuperAdmin();
		/*$forbidden_ids = array(1,2,3);
		if(in_array($id, $forbidden_ids)){
			$this->Session->setFlash(__('You cannot delete this Libraryegory!', true));
			$this->redirect(array('action'=>'index'));
		}*/
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Library', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->data = $this->Library->read(null, $id);
		if ($this->Library->delete($id)) {
			$this->Session->setFlash(__('Library deleted', true));
			$this->redirect(array('action'=> 'index/type1:'.$type));
		}
		$this->Session->setFlash(__('Library was not deleted', true));
		$this->redirect(array('action' => 'index'));		
	}
	function admin_all(){
		$this->check_isAdmin_isSuperAdmin();
	}
}