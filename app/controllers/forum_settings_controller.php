<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
require_once '../authfront_controller.php';
class ForumSettingsController extends AuthfrontController {
	var $name = 'ForumSettings';
	var $uses = array('Setting');		
	function index() {
		$this->check_isAdmin_isSuperAdmin();
		if (!empty($this->data)) {
			if ($this->Setting->save($this->data)){
				//reset session settings
				//$this->setSettings(); 
				$this->Session->setFlash(__('The Settings has been saved', true));
				$this->redirect(array('controller' => 'ForumSettings', 'action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Settings could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Setting->read(null, 2);
		}
	}
}