<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.mohamedelsayed.net/
 * @copyright Copyright (c) 2013 Programming by "mohamedelsayed.net"
 */
require_once '../auth_controller.php';
class MeadminController extends AuthController {	
	
	var $name = 'Meadmin';
	var $uses = array('User');

	function index(){
		$this->set('title_for_layout' , 'Mohamed Elsayed Admin');				
	}	
	//login
	function login (){
		$this->layout = 'login';
		if($this->IsAuthentic()){
			$this->Session->setFlash(__('You are already logging in.', true));
			$this->redirect(array('controller' => 'me-admin', 'action' => 'index'),true);
		}
		if(!empty($this->data)){
			$user = $this->User->find('first', 
							  	   array('conditions' =>
								   	   array('username' => $this->data['User']['username'],
								   	 	     'password' =>  Security::hash($this->data['User']['password'], null, true))));									   	 
			if (!empty($user)){
				$this->Session->setFlash(__('Logged in successfuly.', true));
		    	//Set session with user, group and.
				$this->Session->write('userInfo', array_merge(array('User'=>$user['User'])/*,
															  array(/*'Group'=>$user['Group'])*/));
			  	//if($this->data['User']['username'] != 'elsayed')		
				//$this->requestAction('/logs/saveLog/user_name/'.$this->data['User']['username'].'/'.$this->action);								  
		    	$this->redirect(array("controller" => "me-admin/index"),true);						   	 	   	
			}else{
				$this->Session->setFlash(__('Wrong username or password! Please, try again.', true));
			}
		}		
		$this->data = null;
		$this->set('title_for_layout' , 'Mohamed Elsayed Admin');	
	}	
	//logout
	function logout()
	{
		//if($this->data['User']['username'] != 'elsayed')	
		//$this->requestAction('/logs/saveLog/user_name/'.$this->Session->read('userInfo.User.username').'/'.$this->action);	
		$this->Session->destroy();
		$this->Session->setFlash(__('Logged out successfuly.', true));
		$this->redirect(array('controller'=>'me-admin/login'));
	}
}
?>