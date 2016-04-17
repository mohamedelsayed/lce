<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2014 Programming by "mohamedelsayed.net"
 */
require_once '../auth_controller.php';
class NewslettersController extends AuthController {
	var $name = 'Newsletters';
	var $uses = array('Newsletter','Queue');
	//use upload component
	//var $components = array('Upload');	
	function index() {
		$tmpconditions = $this->Session->read('conditions');
		if(isset($tmpconditions['Subscriber.user_id']))	
		$this->Session->delete('conditions');		
		$conditions = array();		
		$this->Session->write('empty', 'All');
		//if($this->Session->read('userInfo.User.login_as') == 0)
		//$conditions['Newsletter.user_id'] = $this->Session->read('userInfo.User.id');
		
		if($this->Session->check('conditions.subject')){
		$subject = $this->Session->read('conditions.subject');
		$this->Session->delete('conditions.subject');}	
		//print_r($this->Session->read('conditions'));				
		// set this paginate with data
		$this->paginate = array(
			'conditions' => array($this->Session->read('conditions'), $conditions),
			'order' => array('Newsletter.id' => 'DESC'),
			'limit' => isset($this->params['named']['limit'])?$this->params['named']['limit']:$this->paginate['limit'],
			'page'  => isset($this->params['named']['page'])?$this->params['named']['page']:$this->paginate['page'],
    	);
    	//set data to view
    	$this->Newsletter->recursive = 0;
		$this->set('newsletters', $this->paginate());
	    //get issues and sections and set $this->data to use in filtering form.
    	if(is_array($this->Session->read('conditions'))){
			$this->data['Newsletter'] = $this->Session->read('conditions');
			/*if(isset($this->data['Newsletter']['Newsletter.user_id'])){
				$this->data['Newsletter']['user_id']=$this->data['Newsletter']['Newsletter.user_id'];
				unset($this->data['Newsletter']['Newsletter.user_id']);				
			}*/			
			if(isset($subject)){
				$this->data['Newsletter']['subject'] = $subject;
				//unset($this->data['Newsletter']['Newsletter.name']);
			}
    	}	
		//$users = $this->Newsletter->User->find('list', array('conditions'=>array('User.id >'=>1)));
		//$this->set(compact('users'));
	}	
	//Set newsletters limit ber page.
	function setLimit($limit=null){
		if($limit > 0){
			$this->Session->write('newsletterLimit', $limit);
		}
		$this->redirect(array('action' => 'index'));
	}	
	//Filter newsletter by issue or section or both.
	function filter(){
		//pr($this->data['Newsletter']);
		if(!empty($this->data['Newsletter'])){			
			/*if(!empty($this->data['Newsletter']['user_id']))
				$this->data['Newsletter']['Newsletter.user_id'] = 	$this->data['Newsletter']['user_id'];
			unset($this->data['Newsletter']['user_id']);*/
			if(!empty($this->data['Newsletter']['subject']))
				$this->data['Newsletter']['Newsletter.subject LIKE'] = 	"%".$this->data['Newsletter']['subject']."%";							
			//ex: $this->Session->write('conditions', array('Newsletter.section_id' => 1));
			$this->Session->write('conditions', empty($this->data['Newsletter'])?true:$this->data['Newsletter']);
		}
		$this->redirect(array('action'=>'index'));
	}		
	function view($id = null) {
			if (!$id) {
				$this->Session->setFlash(__('Invalid newsletter', true));
				$this->redirect(array('action' => 'index'));
			}
			$this->set('newsletter', $this->Newsletter->read(null, $id));
	}
	function add() {
		if (!empty($this->data)) {
			//set the user how add the newsletter from session.
			//$this->data['Newsletter']['user_id'] = $this->Session->read('userInfo.User.id');			
			//save data
			$this->Newsletter->create();
			if ($this->Newsletter->save($this->data)) {		
				//set flash
				$this->Session->setFlash(__('The newsletter has been saved', true));
				$this->redirect(array('action' => 'index'));					
			} else {
				$this->Session->setFlash(__('The newsletter could not be saved. Please, try again.', true));
			}
		}		
		//$this->data['Newsletter']['from_email'] = $this->Session->read('Setting.from_email');
		//$users = $this->Newsletter->User->find('list', array('conditions'=>array('User.id >'=>1)));
		//$users[0] = 'All Subscribers';
		//ksort($users);
		//$this->set(compact('users'));
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid newsletter', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			//if($this->Session->read('userInfo.User.login_as') == 1 || $this->data['Newsletter']['user_id'] == $this->Session->read('userInfo.User.id')){
			// save data
			if ($this->Newsletter->saveAll($this->data, array('validate' => 'first'))) {				 								
				//set flash
				$this->Session->setFlash(__('The newsletter has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The newsletter could not be saved. Please, try again.', true));
			}/*}else{
				$this->Session->setFlash(__('Sorry! only Admins can edit this newsletter.', true));
				$this->redirect(array('action' => 'index'));
			}*/			
		}
		//Save valedation errors then load it again after reading data. 
		$this->data['Newsletter']['from_email'] = $this->Session->read('Setting.from_email');
		$holdErrors = $this->Newsletter->validationErrors;
		$this->data = $this->Newsletter->read(null, $id);
		$this->Newsletter->validationErrors = $holdErrors;	
		//$users = $this->Newsletter->User->find('list', array('conditions'=>array('User.id >'=>1)));
		//$users[0] = 'All Subscribers';
		//ksort($users);
		//$this->set(compact('users'));
	}	
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for newsletter', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Newsletter->id = $id;
		//$newsletteruser_id = $this->Newsletter->field('user_id');
		//if($this->Session->read('userInfo.User.login_as') == 1 || $newsletteruser_id == $this->Session->read('userInfo.User.id')){
		//delete
		if ($this->Newsletter->delete($id)) {	
			//set flash
			$this->Session->setFlash(__('Newsletter deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Newsletter was not deleted', true));
		$this->redirect(array('action' => 'index'));
		/*}else{
			$this->Session->setFlash(__('Sorry! only Admins can delete this newsletter.', true));
			$this->redirect(array('action' => 'index'));
		}*/		
	}
	function addToQueue($newsletter_id = null) {
		if (!$newsletter_id) {
			$this->Session->setFlash(__('Invalid id for newsletter', true));
			$this->redirect(array('action'=>'index'));
		}else{
			$this->data['Queue']['newsletter_id'] = $newsletter_id;	
			$this->data['Queue']['status'] = 0;	
			//$old = $this->Queue->find('all', array('conditions' => array('Queue.newsletter_id' => $newsletter_id,'Queue.status < ' => 2)));
			//if(empty($old)){
				//save data
				$this->Queue->create();
				if ($this->Queue->saveAll($this->data, array('validate'=>'first'))) {				
					//set flash
					$this->Session->setFlash(__('The Newsletter has been added to Sending Queue', true));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The Newsletter could not be added. Please, try again.', true));
					$this->redirect(array('action' => 'index'));
				}
			/*}else{
				$this->Session->setFlash(__('The Newsletter could not be added, because you have it in The Sending Queue.', true));
				$this->redirect(array('action' => 'index'));
			}*/
		}		
	}
}
?>