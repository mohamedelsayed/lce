<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
class HomeController  extends AppController {
	var $name = 'Home';
	var $uses = null;
	var $components = array('Email');
	function index(){	
		$this->set('selected','home');
		$this->set('title_for_layout', 'Home');
		$this->loadModel('Slideshow');
		$slideshows = $this->Slideshow->find(
			'all', array(
				'conditions' => array('Slideshow.approved' => 1),
				'order' => array('Slideshow.weight' => 'ASC','Slideshow.id'=>'DESC')
			)	  	 	
		);
		$this->set('slideshows' , $slideshows);
		$this->loadModel('Testimonial');
		$testimonials = $this->Testimonial->find(
			'all', array(
				'conditions' => array('Testimonial.approved' => 1, 'Testimonial.featured' => 1),
				//'order' => array('Testimonial.id'=>'DESC'),
				'order' => 'RAND()',
				'limit' => 4
			)	  	 	
		);
		$this->set('testimonials' , $testimonials);
		$this->loadModel('Article');
		$articles = $this->Article->find(
			'all', array(
				'conditions' => array('Article.approved' => 1, 'Article.featured' => 1),
				'order' => array('Article.id'=>'DESC'),
				'limit' => 1
			)	  	 	
		);
		$this->set('articles' , $articles);
		$this->loadModel('Node');
		$partners  = $this->Node->find(
			'first', array(
				'conditions' => array('Node.approved' => 1, 'Node.id' => 5),
			)	  	 	
		);
		$this->set('partners' , $partners);
		$today = date("Y-m-d"); 
		$this->loadModel('Nevent');
		$event = $this->Nevent->find(
			'first', array(
				'conditions' => array('Nevent.approved' => 1, 'Nevent.start_date >=' => $today,),
				'order' => array('Nevent.start_date' => 'ASC','Nevent.id'=>'DESC'),
				'limit' => 1
			)	  	 	
		);
		$this->set('event' , $event);
	}
	function newsletter(){	
		$error = '';
		//print_r($this->data);
		/*if($this->data['newsletter']['name'] == ''){
			$error .= __('You must enter your Name.', true).'<br />';
		}*/
		if(!filter_var($this->data['newsletter']['email'], FILTER_VALIDATE_EMAIL)) {
			$error .= __('You must enter valid Email.', true).'<br />';
		}	
		/*if(!is_numeric($this->data['newsletter']['phone']) && $this->data['newsletter']['phone'] == ''){
			$error .= __('You must enter valid Mobile.', true).'<br />';
		}*/		
		if($error != ''){
			echo $error;
		}else{
			$this->loadModel('Subscriber');
			$this->data['Subscriber'] = $this->data['newsletter'];
			$this->Subscriber->create();			
			if ($this->Subscriber->save($this->data)) {
				$this->loadModel('Setting');
				$settings = $this->Setting->read(null, 1);				
				$subject = $settings['Setting']['title'].' Newsletter';
				if(SEND_STMP_PORT){
					$this->Email->smtpOptions = array(
						'port' => STMP_PORT,
						'timeout' => STMP_TIMEOUT,
						'host' => STMP_SERVER,
						'username' => STMP_USERNAME,
						'password' => STMP_PASSWORD,
					);
					$this->Email->delivery = 'smtp';
				}
				$this->Email->to = $this->data['newsletter']['email'];
				$this->Email->subject = $subject;			
				$this->Email->replyTo = $settings['Setting']['email'];
				$this->Email->from = $settings['Setting']['title'].'<'.$settings['Setting']['email'].'>';				
				$this->Email->sendAs = 'html';
				$this->Email->template = 'newsletterwelcome';
				$this->set('subject', $subject);
				//$this->set('name', $this->data['newsletter']['name']);			
				$this->set('email', $this->data['newsletter']['email']);
				$this->set('site_title', $settings['Setting']['title']);
				//$this->set('phone', $this->data['newsletter']['phone']);
				//$this->set('message', $this->data['newsletter']['message']);    		
				if ($this->Email->send()){
					echo __('You have subscribed to our Newsletter.', true);
				}
				else{
					echo __('There was a problem sending the Email. Please try again.', true);
				}				
			}else{
				echo __('Your Email already added before.', true);
			}
		}
		$this->autoRender = false;
	}
	function maintenancemode(){
		$this->layout = 'ajax';
		$this->loadModel('Setting');
		$settings = $this->Setting->read(null, 1);				
		$maintenance_mode_text = $settings['Setting']['maintenance_mode_text'];		
		$this->set('maintenance_mode_text', $maintenance_mode_text);
	}
	function events(){
		$this->set('title_for_layout' , 'All Events');		
	}
}