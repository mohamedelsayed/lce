<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
class TextsController extends AppController {
	var $name = 'Texts';
	var $uses = array('Content');
	var $components = array('Email');
	//var $helpers = array('GoogleMapV3'); 	
	function index(){
		$this->redirect($this->referer(BASE_URL));		
	}
	function display($id = null, $title = null){
		if(!$id){
			$this->redirect($this->referer(BASE_URL));
		}
		$content = $this->Content->read(null, $id);
		$this->set('title_for_layout', $content['Content']['title']);
		$this->set('content', $content);
		$this->set('selected','content');
	}
	function terms_and_conditions($id = null){
		if(!$id){
			$this->redirect($this->referer(BASE_URL));
		}
		$content = $this->Content->read(null, $id);
		$this->set('title_for_layout', $content['Content']['title']);
		$this->set('content', $content);
		$this->set('selected','content2');		
	}
	function contactusForm($type = 'notajax'){
		$error = '';	
		if($this->data['Contactus']['name'] == ''){
			$error .= __('You must enter your Name.', true).'<br />';
		}		
		if(!filter_var($this->data['Contactus']['email'], FILTER_VALIDATE_EMAIL)) {
			$error .= __('You must enter valid Email.', true).'<br />';
		}
		/*if($this->data['Contactus']['phone'] == '' || !is_numeric($this->data['Contactus']['phone'])){
			$error .= __('You must enter valid Phone.', true).'<br />';
		}	
		if($this->data['Contactus']['adress'] == ''){
			$error .= __('You must enter your Adress.', true).'<br />';
		}*/
		if($this->data['Contactus']['message'] == ''){
			$error .= __('You must enter your Message.', true).'<br />';
		}		
		if($error != ''){
			echo $error;
		}else{
			$this->loadModel('Setting');
			$this->loadModel('Content');
			$settings = $this->Setting->read(null, 1);	
			$contents = $this->Content->read(null, 1);					
			$subject = __('Contact Us',true);
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
			$this->Email->to = $contents['Content']['mail'];
			$this->Email->subject = $subject;			
			$this->Email->replyTo = $this->data['Contactus']['email'];
			$this->Email->from = $this->data['Contactus']['name'].'<'.$this->data['Contactus']['email'].'>';				
			$this->Email->sendAs = 'html';
			//for arabic
			/*if(isset($this->params['named']['lang'])){
				$this->Email->template = 'contactusar';
			}else{*/		
			$this->Email->template = 'contactus';
			//}
			$this->set('subject', $subject);
			$this->set('name', $this->data['Contactus']['name']);
			//$this->set('phone', $this->data['Contactus']['phone']);			
			$this->set('email', $this->data['Contactus']['email']);
			//$this->set('adress', $this->data['Contactus']['adress']);
			$this->set('message', $this->data['Contactus']['message']);	
			$this->set('url', $settings['Setting']['url']);			     		
			if ($this->Email->send()){
				//echo __('<span style="color:#00FF00;">Email has been sent.</span>', true);
				//echo __('Email has been sent.', true);
				echo __('Thank you for your message. We will get back to you the soonest.', true);			 
			}
			else{
				echo __('There was a problem sending the Email. Please try again.', true);
			}				
		}
		if($type == 'notajax'){
			//for arabic
			/*if(isset($this->params['named']['lang'])){
				$this->redirect(BASE_URL.'/contact-us/index/lang:'.$this->params['named']['lang']);
			}else{*/	
				$this->redirect(BASE_URL.'/contact-us');
			//}
		}elseif($type == 'ajax'){
			$this->autoRender = false;
		}
	}       
}