<?php /**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.mohamedelsayed.net/
 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */
require_once '../authfront_controller.php';
class ForumCommentsController extends AuthfrontController{
	var $name = 'ForumComments';
	function index() {
		if($this->isSuperAdmin() || $this->isAdmin()){
			$this->ForumComment->recursive = 0;
			$this->paginate = array(
				//'conditions' => array($conditions),
				'order' => array('ForumComment.created'=> 'DESC', 'ForumComment.id' => 'DESC'),
	    	);
			$this->set('comments', $this->paginate());
		}else{
			$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'index'));			
		}	
	}
	function view($id = null) {
		if($this->isSuperAdmin() || $this->isAdmin()){
			if (!$id) {
				$this->Session->setFlash(__('Invalid comment', true));
				$this->redirect(array('action' => 'index'));
			}
			$this->set('comment', $this->ForumComment->read(null, $id));
		}else{
			$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'index'));			
		}
	}
	function delete($id = null) {
		if($this->isSuperAdmin() || $this->isAdmin()){
			if (!$id) {
				$this->Session->setFlash(__('Invalid id for comment', true));
				$this->redirect(array('action'=>'index'));
			}
			if ($this->ForumComment->delete($id)) {
				$this->Session->setFlash(__('Comment deleted', true));
				$this->redirect(array('action'=>'index'));
			}
			$this->Session->setFlash(__('Comment was not deleted', true));
			$this->redirect(array('action' => 'index'));
		}else{
			$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'index'));			
		}
	}
	function approve($id = null, $approved){
		if($this->isSuperAdmin() || $this->isAdmin()){
			if (!$id) {
				$this->Session->setFlash(__('Invalid Comment', true));
				$this->redirect(array('action' => 'index'));
			}
			$this->ForumComment->id = $id;
			$this->ForumComment->set('approved', $approved);
			$this->ForumComment->save();
			$this->redirect(array('action' => 'index'));		
		}else{
			$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'index'));			
		}
	}
}