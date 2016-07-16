<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.lifecoachingegypt.com
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
require_once 'elsayed_db.php';
class AppController extends Controller {
	public $helpers = array('Html', 'Form', 'Javascript', 'Ajax', 'Session', 'Lang');
	public $components = array('Session', 'Cookie');
	public $settings;	
	public $clearProSession = true;
	public $currency = 'EGP';
	public $payment_merchant_id = 'Test290510EGP';
	public $payment_access_code = 'B972DDBB';
	public $payment_hash_secret = 'C0DF9A7B3819968807A9D4E48D0E65C6';
	public $default_user_image = '/img/front/default-user-image.png';
	function beforeFilter() {
		//write settings in session
		if(!$this->Session->check('Setting')){
			$this->setSettings();
		}
		$this->checkMaintenanceMode();
		//Set Cookie	
		$this->setCookie();
		//Set Header Quotes
		//$this->setHeaderQuotes();
		//$this->setAllArticlesTags();
		//$this->setRecentArticles();
		//$this->setParentCat();
		$this->loadModel('Setting');
		$settings = $this->Setting->read(null, 1);
		$this->set("minYearValue", $settings['Setting']['minimum_year']);
		$this->set("maxYearValue", $settings['Setting']['maximum_year']);
		$this->set('settings', $settings['Setting']);
		$this->settings = $settings['Setting'];
		$this->set('currency', $this->currency);
		$this->set('payment_merchant_id', $this->payment_merchant_id);
		$this->set('payment_access_code', $this->payment_access_code);
		$this->set('payment_hash_secret', $this->payment_hash_secret);
		$this->set('default_user_image', $this->default_user_image);
	}	
	function beforeRender(){
		if($this->name == 'CakeError'){
			$page_not_found_text = 'Page Not Found';	
			$this->set('title_for_layout' , $page_not_found_text);
			$this->set('page_not_found_text', $page_not_found_text);
		}
		$this->setHeaderQuotes();
		$this->setAllArticlesTags();
		$this->setRecentArticles();
		$this->setParentCat();
		if($this->layout != 'ajax'){
			$this->layout = 'front/main';
		}
		$this->loadModel('Setting');
        $setting = $this->Setting->read(null, 1);
        $this->set('base_url', BASE_URL);
	}	
	function afterFilter(){
		//$this->Session->write('dontPopup', true);
	}	
	protected function setSettings(){
		$this->loadModel('Setting');
		$this->Session->write($this->Setting->read(null, 1));
	}
	function getPagingLimit(){
		$this->loadModel('Setting');
		$settings = $this->Setting->read(null, 1);
		return $settings['Setting']['paging_limit'];
	}
	function getCommentPagingLimit(){
		$this->loadModel('Setting');
		$settings = $this->Setting->read(null, 1);
		return $settings['Setting']['comment_paging_limit'];
	}	
	protected function setCookie(){
		//Set Cookie	
		$this->Cookie->name = 'lce';
		$this->Cookie->key = '#MaT7ssccesaAmOOR*';
		$this->Cookie->time = 3600; // or '1 hour'
	}	
	protected function setHeaderQuotes(){
		$this->loadModel('Content');
		$contact_us = $this->Content->read(null, 1);
		$this->set('header_contact_us_title',$contact_us['Content']['title']);	
		$this->loadModel('Quote');
		$quote = $this->Quote->find(
			'first', array(
				'conditions' => array('Quote.approved' => 1),
				'order' => 'RAND()',
			)	  	 	
		);
		$this->set('quote',$quote);		
	}	
	// clean Title
	function cleanTitle($title = null){		
    	if(!$title)
    		return '';
		return Inflector::slug(strtolower($title), '-');
		//return Inflector::slug($artistName, '');
    }
	/**
	 * @author Author "Mohamed Elsayed"  
	 * @author Author Email "me@mohamedelsayed.net"
	 * @copyright Copyright (c) 2014 Programming by "mohamedelsayed.net"
	 * this function was created to send newsletter on Shared Hosting that send 500 mail/hour
	 * so if you send all mails one time it will not work
	 * so I make it send limit mails (by set it from Settings) at one time & call it by Cron jobs every hour 
	 */
	function send_newsletter($key = null){
		if($key == 'hr3w2a4t1515s23w6pae'){
			$this->autoRender = false;				
			$this->loadModel('Setting');
			$settings = $this->Setting->read(null, 1);
			$limit = $settings['Setting']['newsletter_limit'];		
			$tempDomain = explode("/", $settings['Setting']['url']);		
			$currentDomain = $tempDomain[0]."//".$tempDomain[2]."/app/webroot/";
			$this->set('currentDomain', $currentDomain);
			$this->loadModel('Queue');
			$this->loadModel('Subscriber');
			$this->Subscriber->recursive = -1;
			$newsletter_sending = array();
			//get current newsletter
			$newsletter_sending = $this->Queue->find('first', array('conditions' => array('Queue.status' => 1)));
			if(empty($newsletter_sending)){
				$newsletter_pending = $this->Queue->find('first', array('conditions' => array('Queue.status' => 0),'order'=>array('Queue.id'=>'ASC')));
				if(!empty($newsletter_pending)){
					$this->Queue->updateAll(array('Queue.status' => 1), array('Queue.id'=>$newsletter_pending['Queue']['id']));
					if($newsletter_pending['Newsletter']['user_id'] != 0)
					$this->Subscriber->updateAll(array('Subscriber.sent' => 0), array('Subscriber.user_id'=>$newsletter_pending['Newsletter']['user_id']));
					else
					$this->Subscriber->updateAll(array('Subscriber.sent' => 0));					
					$newsletter_sending = $newsletter_pending;
				}			
			}		
			if(!empty($newsletter_sending)){			
				if($newsletter_sending['Newsletter']['user_id'] != 0){
					$subscribers = $this->Subscriber->find(
						'all', 
						array(
							'fields'     => array('Subscriber.id','Subscriber.email'),
							'conditions' => array('Subscriber.user_id' => $newsletter_sending['Newsletter']['user_id'],'Subscriber.sent' => 0),
				  	 		'order'      => array('Subscriber.id'=>'DESC'),
							'limit'      => $limit
				  	 	)
				  	);
				}
				else{
					$subscribers = $this->Subscriber->find(
						'all', 
						array(
							'fields'     => array('Subscriber.id','Subscriber.email'),
							'conditions' => array('Subscriber.sent' => 0),
				  	 		'order'      => array('Subscriber.id'=>'DESC'),
							'limit'      => $limit
				  	 	)
				  	);
				}
				if(empty($subscribers)){
					$this->Queue->updateAll(array('Queue.status' => 2), array('Queue.id'=>$newsletter_sending['Queue']['id']));
				}else{
					foreach($subscribers as $subscriber){
						$this->Email->reset();
						$this->Email->to = $subscriber['Subscriber']['email'];
						$this->Email->subject = $newsletter_sending['Newsletter']['subject'];
						$this->Email->replyTo = $newsletter_sending['Newsletter']['from_email'];
						$this->Email->return = $settings['Setting']['return_path_email'];
						$this->Email->additionalParams = '-f'.$settings['Setting']['return_path_email'];					
						$this->Email->from = $newsletter_sending['Newsletter']['from_name'].' <'.$newsletter_sending['Newsletter']['from_email'].'>';
						$this->Email->sendAs = 'html';
						$this->Email->template = 'newsletter';
						$newsletter_body = str_replace("/app/webroot/", $currentDomain, $newsletter_sending['Newsletter']['body']);
						$this->set('newsletter', $newsletter_body);
						//$this->set('signature', $settings['Setting']['signature']);
						if ($this->Email->send()) {
							$this->Subscriber->updateAll(array('Subscriber.sent' => 1), array('Subscriber.id' => $subscriber['Subscriber']['id']));
							echo 'The newsletter has been sent to '.$subscriber['Subscriber']['email'].'.<br/>';			
						}else{
							echo 'There was a problem sending The newsletter. Please try again<br/>';
						}
					}
					$this->autoRender = false;		
				}
			}
		}else {
			echo 'Wrong key!';
			$this->autoRender = false;	
		}
	}	
	// get All Articles Tags
	function setAllArticlesTags(){
		$all_tags = array();
		$this->loadModel('Article');
		$articles = $this->Article->find(
			'all', array(
				'fields'     => array('Article.id', 'Article.tags'),
				'conditions' => array('Article.approved' => 1),
				'order' => array('Article.date' => 'DESC','Article.id'=>'DESC')
			)	  	 	
		);
		foreach ($articles as $key => $article) {
			$tags = explode(",", $article['Article']['tags']);
			foreach ($tags as $key => $tag) {
				$tag = trim($tag);
				if($tag != ''){
					if(!in_array($tag, $all_tags)){
						$all_tags[] = $tag;
					}
				}
			}		
		}	
		$this->set('all_tags',$all_tags);	
	}
	// get Recent Articles 
	function setRecentArticles(){
		$this->loadModel('Article');
		$articles = $this->Article->find(
			'all', array(
				//'fields'     => array('Article.id', 'Article.tags'),
				'conditions' => array('Article.approved' => 1),
				'order' => array('Article.date' => 'DESC','Article.id'=>'DESC'),
				'limit' => 3
			)	  	 	
		);	
		$this->set('recent_articles',$articles);	
	}
	function setParentCat(){
		$this->loadModel('Cat');
		$cats = $this->Cat->find(
			'all', array(
				//'fields'     => array('Article.id', 'Article.tags'),
				'conditions' => array('Cat.approved' => 1, 'Cat.parent_id' => null),
				'order' => array('Cat.weight' => 'ASC','Cat.id'=>'DESC'),
				'limit' => 3
			)	  	 	
		);	
		$this->set('header_cats',$cats);		
	}
	function checkMaintenanceMode(){
		$front_controllers_list = array('Home','Page', 'Article', 'Faq', 'Texts');
		if(!$this->isAuthentic()){
			if(in_array($this->name, $front_controllers_list)){
				$this->loadModel('Setting');
				$settings = $this->Setting->read(null, 1);				
				$maintenance_mode = $settings['Setting']['maintenance_mode'];
				if($maintenance_mode == 1 && $this->action != 'maintenancemode'){
					$this->redirect($this->Session->read('Setting.url').'/maintenance');
				}		
			}
		}
	}
	//Check Authentication.
	protected function isAuthentic(){
		if($this->Session->check('userInfo')){
			//check if data in session (userInfo) existing in database.
			if($this->inDataBase()){
				//write settings in session and return
				if(!$this->Session->check('Setting'))
					$this->setSettings();
				return true;
			}else{
				$this->Session->destroy();
				return false;
			}
		}else
			return false;
	}
	//Check that session user in database.
	protected function inDataBase (){
		$this->loadModel('User');
		$this->User->recursive = -1;
		return $this->User->find('count', 
							  	  array('conditions' =>
								   	   array('username' => $this->Session->read('userInfo.User.username'),
								   	 	     'password' => $this->Session->read('userInfo.User.password'))));
	}
	public function remove_facebook_linkedin_string($string = ''){
		$replace = '';
		$search1 = 'https://www.linkedin.com';
		$search2 = 'http://www.linkedin.com';
		$search3 = 'https://linkedin.com';
		$search4 = 'http://linkedin.com';
		$string = str_replace($search1, $replace, $string);
		$string = str_replace($search2, $replace, $string);
		$string = str_replace($search3, $replace, $string);
		$string = str_replace($search4, $replace, $string);
		$search1 = 'https://www.facebook.com';
		$search2 = 'http://www.facebook.com';
		$search3 = 'https://facebook.com';
		$search4 = 'http://facebook.com';
		$string = str_replace($search1, $replace, $string);
		$string = str_replace($search2, $replace, $string);
		$string = str_replace($search3, $replace, $string);
		$string = str_replace($search4, $replace, $string);
		return $string;		
	}
	function print_event_date($event = array(), $show_time = 1){
		$all_date = '';
		if(!empty($event)){
			$model = 'Nevent';
			$duration = $event[$model]['duration'];	
			$from_date = strtotime($event[$model]['start_date']);
			$from_date_month = date('M', $from_date);
			$from_date_day = date('j', $from_date);
			$from_date_year = date('Y', $from_date);
			$all_date = $from_date_month.' '.$from_date_day.', '.$from_date_year;
			if($duration > 1){
				$duration_in = $duration - 1;
				$to_date = strtotime("+".$duration_in." day", strtotime($event[$model]['start_date']));
				$to_date_month = date('M', $to_date);
				$to_date_day = date('j', $to_date);
				$to_date_year = date('Y', $to_date);			
				if($to_date_year == $from_date_year && $to_date_month == $from_date_month){
					$all_date = $from_date_month.' '.$from_date_day.'-'.$to_date_day.', '.$from_date_year;
				}elseif($to_date_year == $from_date_year){
					$all_date = $from_date_month.' '.$from_date_day.' - '.$to_date_month.' '.$to_date_day.', '.$from_date_year;
				}else{
					$all_date = $from_date_month.' '.$from_date_day.', '.$from_date_year.'-'.$to_date_month.' '.$to_date_day.', '.$from_date_year;
				}
			}
			if($show_time == 1){
				$time_from = date('g:i a', strtotime($event[$model]['time_from']));
				$time_to = date('g:i a', strtotime($event[$model]['time_to']));
				$all_date .= ' <br />'.$time_from.' to '.$time_to;
			}
		}		
		return $all_date;
	}
	function elsayed_send_custom_mail($to_emails = array(), $subject = '', $message = '', $from_email = '', $from_name = ''){
		$error = 1;
		$server_email_info = array(
	        'Username' => STMP_USERNAME,
	        'Password' => STMP_PASSWORD,
	        'Host' => STMP_SERVER,
	        'Port' => STMP_PORT,
	    );
		require_once 'PHPMailer/PHPMailerAutoload.php';                       	
		if(!empty($to_emails)){
			foreach ($to_emails as $key => $to_email) {
				$mail = new PHPMailer();
			   	$mail->isSMTP();
			    $mail->CharSet = "utf-8";
			    $mail->SMTPDebug = 0;
			    $mail->SMTPSecure = 'tls';
			    $mail->SMTPAuth = true;
			    $mail->Host = $server_email_info['Host'];
			    $mail->Port = $server_email_info['Port'];
			    $mail->ReturnPath = $server_email_info['Username'];
			    $mail->isHTML(true);
			    $mail->Username = $server_email_info['Username'];
			    $mail->Password = $server_email_info['Password'];	
			    $mail->setFrom($from_email, $from_name);
			    $mail->addReplyTo($from_email, $from_name);
			    $mail->addAddress(trim(strtolower($to_email)));
			    $mail->Subject = $subject;
			    $mail->Body = $message;
			    if ($mail->send()) {
			    	$error = 0;
		    	} else {
		    		$error = 1;
	            }
	        }
		}
		if($error){
			return FALSE;
		}else{
			return TRUE;
		}
	}	
}