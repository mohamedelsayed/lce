<?php /**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.mohamedelsayed.net/
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
require_once '../authfront_controller.php';
class CategoriesController extends AuthfrontController {
	var $name = 'Categories';
	var $uses = array('Category');
	//use upload component.
	var $components = array('Upload');
	function index() {
		$order = array('Category.updated' => 'DESC', 'Category.created' => 'DESC', 'Category.id' => 'DESC');
		$type = isset($this->params['named']['type'])?$this->params['named']['type']:0;	
		$this->set('type', $type);
		$this->check_isAdmin_isSuperAdmin();
		$this->Category->recursive = 0;
		$conditions = array();
		$conditions['Category.type'] = $type;
		if($this->isSuperAdmin() || $this->isAdmin()){
			$conditions['Category.title LIKE'] = "%".$this->data['Category']['title']."%";
			$this->set('selected','adminpages');
			if(isset($this->data['Category']['title'])){
				$this->paginate = array(
					'conditions' => $conditions,
					'order' => $order,
	    		);
			}else{
				$this->paginate = array(
					'conditions' => $conditions,
					'order' => $order,
    			);
			}		
			$this->set('categories', $this->paginate());
		}else{
			$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'login'));	
		}
	}
	function view($id = null) {
		$this->check_isAdmin_isSuperAdmin();
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
		$type = isset($this->params['named']['type'])?$this->params['named']['type']:0;	
		$this->set('type', $type);
		$this->check_isAdmin_isSuperAdmin();
		if($this->isSuperAdmin() || $this->isAdmin()){
			if (!empty($this->data)) {
				//upload image
				//$this->data['Category']['image']=$this->Upload->uploadImage($this->data['Category']['image']);
				$this->Category->create();
				/*if($this->data['Category']['parent_id'] == null){
					$this->data['Category']['parent_id'] = 0;				
				}*/
				if ($this->Category->save($this->data)) {
					$this->Session->setFlash(__('The Category has been saved', true));
					$this->redirect(array('action' => 'index/type:'.$type));
				} else {
					$this->Session->setFlash(__('The Category could not be saved. Please, try again.', true));
				}
			}
			//$artists = $this->Category->Artist->find('list');
			//$parents = $this->Category->ParentCategory->find('list');
			//$this->set(compact('parents'));
		}else{
			$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'login'));	
		}
	}
	function edit($id = null) {
		$this->check_isAdmin_isSuperAdmin();
		if($this->isSuperAdmin() || $this->isAdmin()){
			if (!$id && empty($this->data)) {
				$this->Session->setFlash(__('Invalid Category', true));
				$this->redirect(array('action' => 'index'));
			}
			$category = $this->Category->read(null, $id);
			$type = $category['Category']['type'];	
			$this->set('type', $type);
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
					$this->redirect(array('action' => 'index/type:'.$type));
				} else {
					$this->Session->setFlash(__('The Category could not be saved. Please, try again.', true));
				}
			}
			if (empty($this->data)) {
				$this->data = $category;
			}
			//$artists = $this->Category->Artist->find('list');
			//$parents = $this->Category->ParentCategory->find('list',array('conditions'=>array('ParentCategory.id <>'=>$id)));
			//$this->set(compact('parents'));
		}else{
			$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'login'));	
		}
	}
	function delete($id = null) {
		$this->check_isAdmin_isSuperAdmin();
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
			$category = $this->Category->read(null, $id);
			$type = $category['Category']['type'];	
			$this->set('type', $type);
			if ($this->Category->delete($id)) {
				$this->Session->setFlash(__('Category deleted', true));
				$this->redirect(array('action' => 'index/type:'.$type));
			}
			$this->Session->setFlash(__('Category was not deleted', true));
			$this->redirect(array('action' => 'index/type:'.$type));
		}else{
			$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'login'));	
		}
	}
}