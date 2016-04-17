<?php
require_once '../auth_controller.php';
class CommentsController extends AuthController {

	var $name = 'Comments';

	function index() {
		$this->Comment->recursive = 0;
		$this->paginate = array(
			//'conditions' => array($conditions),
			'order' => array('Comment.created'=> 'DESC', 'Article.id' => 'DESC'),
    	);
		$this->set('comments', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid comment', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('comment', $this->Comment->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Comment->create();
			if ($this->Comment->save($this->data)) {
				$this->Session->setFlash(__('The comment has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The comment could not be saved. Please, try again.', true));
			}
		}
		//$members = $this->Comment->Member->find('list');
		$articles = $this->Comment->Article->find('list');
		//$advices = $this->Comment->Advice->find('list');
		$this->set(compact('articles'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid comment', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Comment->save($this->data)) {
				$this->Session->setFlash(__('The comment has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The comment could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Comment->read(null, $id);
		}
		//$members = $this->Comment->Member->find('list');
		$articles = $this->Comment->Article->find('list');
		//$advices = $this->Comment->Advice->find('list');
		$this->set(compact('articles'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for comment', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Comment->delete($id)) {
			$this->Session->setFlash(__('Comment deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Comment was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function approve($id = null, $approved){
		if (!$id) {
			$this->Session->setFlash(__('Invalid Comment', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Comment->id = $id;
		$this->Comment->set('approved', $approved);
		$this->Comment->save();
		$this->redirect(array('action' => 'index'));		
	}
}
?>