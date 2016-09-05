<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.mohamedelsayed.net/
 * @copyright Copyright (c) 2013 Programming by "mohamedelsayed.net"
 */
require_once '../auth_controller.php';
class ProfilController  extends AuthController {
	var $name = 'Profil';
	var $uses = array('User');
	var $components = array('Email');
	
	function index(){
		$this->redirect(BASE_URL.'/forget-password');
	}	
	//forget password.
	function forgot($memberId=null, $code=null){
		$this->layout = 'login';
		$this->set('title_for_layout','Forgot username or password');
		$this->loadModel('Setting');
		$settings = $this->Setting->read(null, 1);
		//print_r($settings);
		if(!empty($this->data['User']['email'])){
			if(Validation::email($this->data['User']['email'])){
				$member = $this->User->find('first', array(
					'conditions' => array(
						'User.email'     => $this->data['User']['email'],
						//'Member.confirmed' => 1,
					)
				));
				//print_r($member);
				if(!empty($member)){
					//change confirm code
					$unId = String::uuid();
					$this->User->id = $member['User']['id'];
					$this->User->saveField('confirm_code', $unId, false);
					//send confirmation mail
					if(SEND_STMP){
						$this->Email->smtpOptions = array(
							'port' => STMP_PORT,
							'timeout' => STMP_TIMEOUT,
							'host' => STMP_SERVER,
							'username' => STMP_USERNAME,
							'password' => STMP_PASSWORD,
						);
						$this->Email->delivery = 'smtp';
					}
					$this->Email->to = $this->data['User']['email'];
					$this->Email->subject = $settings['Setting']['title'];
					$this->Email->replyTo = $settings['Setting']['email'];
					$this->Email->from = $settings['Setting']['email'];
					$this->Email->sendAs = 'html';
					$this->Email->template = 'forgot';
					//set data to template 'forgot'.
					$this->set('member', $member);
					$this->set('code', $unId);
					$this->set('url', $settings['Setting']['url']);
					if ($this->Email->send())
						$this->Session->setFlash(__('Confirmation mail sent. Please check your inbox', true));
					else 
						$this->Session->setFlash(__('There was a problem sending mail. Please try again', true));
				}else 
					$this->Session->setFlash(__('Invalid user email.', true));
			}else 
				$this->User->validationErrors['email'] = 'Please enter valid email.';
		}elseif($memberId && $code){
			$member = $this->User->find('first', array(
					'conditions' => array(
						'User.id'     => $memberId,
						//'Member.confirmed' => 1,
					)
				));
			if($member['User']['confirm_code'] == $code){
				if(isset($this->data)){
					if(!empty($this->data['User']['password'])){
						$password = $this->data['User']['password'];
						$hashPassword = Security::hash($this->data['User']['password'], null, true);
						$newCode = String::uuid();					
						$this->User->updateAll(
							array('User.password' => "'$hashPassword'", 'User.confirm_code' => "'$newCode'"),
							array('User.id' => $memberId, 'User.confirm_code' => $code)
						);
						$this->Session->setFlash(__('Password changed successfully.', true));				
						$this->redirect(BASE_URL.'/me-admin');
					}else 
						$this->User->validationErrors['password'] = 'Please enter new password.';	
				} 
			}
			else{
				$this->Session->setFlash(__('Wrong code.', true));
				$this->redirect(BASE_URL.'/forget-password');
			}
			$this->set('title_for_layout', 'Change password');
			$this->render('change_password');	
		}	
	}
}
?>