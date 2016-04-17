<?php
require_once '../auth_controller.php';
class SettingsController extends AuthController {

	var $name = 'Settings';
	var $uses = array('Setting');
	
	function index() {
		$this->redirect(array('action' => 'edit'));
	}
	
	function edit() {
		if (!empty($this->data)) {
			if ($this->Setting->save($this->data)){
				//reset session settings
				$this->setSettings(); 
				$this->Session->setFlash(__('The setting has been saved', true));
				$this->redirect(array('action' => 'edit'));
			} else {
				$this->Session->setFlash(__('The setting could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Setting->read(null, 1);
		}
	}
}
?>