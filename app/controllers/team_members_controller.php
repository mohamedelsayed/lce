<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2014 Programming by "mohamedelsayed.net"
 */
require_once '../auth_controller.php';
class TeamMembersController extends AuthController {

	var $name = 'TeamMembers';
	//use upload component.
	var $components = array('Upload');
	var $type_options = array('0'=>'Team Members','1'=>'Board Members', '2' => 'LCE Community');

	function index() {
		$this->TeamMember->recursive = 0;
		$this->set('teamMembers', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid member', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('teamMember', $this->TeamMember->read(null, $id));
		$this->set('type_options',$this->type_options);
	}

	function add() {
		if (!empty($this->data)) {
			//upload image
			$this->data['TeamMember']['image']=$this->Upload->uploadImage($this->data['TeamMember']['image']);
			$this->TeamMember->create();
			if ($this->TeamMember->save($this->data)) {
				$this->Session->setFlash(__('The member has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The member could not be saved. Please, try again.', true));
			}
		}
		$this->set('type_options',$this->type_options);
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid member', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			//upload image
			$this->TeamMember->id = $id;
			if($this->data['TeamMember']['image']['name']){
				$this->Upload->filesToDelete = array($this->TeamMember->field('image'));
				$this->data['TeamMember']['image']=$this->Upload->uploadImage($this->data['TeamMember']['image']);
			}else
				unset($this->data['TeamMember']['image']);
			if ($this->TeamMember->save($this->data)) {
				$this->Session->setFlash(__('The member has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The member could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->TeamMember->read(null, $id);
		}
		$this->set('type_options',$this->type_options);
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for member', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->TeamMember->delete($id)) {
			$this->Session->setFlash(__('Team member deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Team member was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>