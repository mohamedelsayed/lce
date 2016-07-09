<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
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
				$this->Session->setFlash(__('The settings has been saved', true));
				$this->redirect(array('action' => 'edit'));
			} else {
				$this->Session->setFlash(__('The settings could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Setting->read(null, 1);
		}
	}
	function instalments()	{
		if (!empty($this->data)) {
			$form_data = $this->data;
			$this->data = $this->Setting->read(null, 1);
			$this->data['Setting']['number_of_instalments'] = $form_data['Setting']['number_of_instalments'];
			$this->data['Setting']['value_for_each_installment'] = $form_data['Setting']['value_for_each_installment'];			
			if ($this->Setting->save($this->data)){
				$this->Session->setFlash(__('The instalments settings has been saved', true));
				$this->redirect(array('action' => 'instalments'));
			} else {
				$this->Session->setFlash(__('The instalments settings could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Setting->read(null, 1);
		}		
	}
}