<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
require_once '../auth_controller.php';
class SubscribersController extends AuthController {
	var $name = 'Subscribers';
	var $uses = array('Subscriber');
	//use upload component
	//var $components = array('Upload');	
	function index() {
		$tmpconditions = $this->Session->read('conditions');
		if(isset($tmpconditions['Newsletter.user_id']))	
		$this->Session->delete('conditions');	
		$conditions = array();		
		$this->Session->write('empty', 'All');
		//if($this->Session->read('userInfo.User.login_as') == 0)
		//$conditions['Subscriber.user_id'] = $this->Session->read('userInfo.User.id');
		
		if($this->Session->check('conditions.name')){
		$name = $this->Session->read('conditions.name');
		$this->Session->delete('conditions.name');}
		if($this->Session->check('conditions.email')){		
		$email = $this->Session->read('conditions.email');		
		$this->Session->delete('conditions.email');}		
		//print_r($this->Session->read('conditions'));				
		// set this paginate with data
		$this->paginate = array(
			'conditions' => array($this->Session->read('conditions'), $conditions),
			'order' => array('Subscriber.id' => 'DESC'),
			'limit' => isset($this->params['named']['limit'])?$this->params['named']['limit']:$this->paginate['limit'],
			'page'  => isset($this->params['named']['page'])?$this->params['named']['page']:$this->paginate['page'],
    	);
    	//set data to view
    	$this->Subscriber->recursive = 0;
		$this->set('subscribers', $this->paginate());
	    //get issues and sections and set $this->data to use in filtering form.
    	if(is_array($this->Session->read('conditions'))){
			$this->data['Subscriber'] = $this->Session->read('conditions');
			/*if(isset($this->data['Subscriber']['Subscriber.user_id'])){
				$this->data['Subscriber']['user_id']=$this->data['Subscriber']['Subscriber.user_id'];
				unset($this->data['Subscriber']['Subscriber.user_id']);				
			}*/			
			if(isset($name)){
				$this->data['Subscriber']['name'] = $name;
				//unset($this->data['Subscriber']['Subscriber.name']);
			}
			if(isset($email)){
				$this->data['Subscriber']['email'] = $email;
				//unset($this->data['Subscriber']['Subscriber.email']);
			}
    	}	
		//$users = $this->Subscriber->User->find('list', array('conditions'=>array('User.id >'=>1)));
		//$this->set(compact('users'));
	}	
	//Set subscribers limit ber page.
	function setLimit($limit=null){
		if($limit > 0){
			$this->Session->write('subscriberLimit', $limit);
		}
		$this->redirect(array('action' => 'index'));
	}	
	//Filter subscriber by issue or section or both.
	function filter(){
		//pr($this->data['Subscriber']);
		if(!empty($this->data['Subscriber'])){			
			//if(!empty($this->data['Subscriber']['user_id']))
				//$this->data['Subscriber']['Subscriber.user_id'] = 	$this->data['Subscriber']['user_id'];
			//unset($this->data['Subscriber']['user_id']);
			if(!empty($this->data['Subscriber']['name']))
				$this->data['Subscriber']['Subscriber.name LIKE'] = 	"%".$this->data['Subscriber']['name']."%";			
			if(!empty($this->data['Subscriber']['email']))
				$this->data['Subscriber']['Subscriber.email LIKE'] = 	"%".$this->data['Subscriber']['email']."%";				
			//ex: $this->Session->write('conditions', array('Subscriber.section_id' => 1));
			$this->Session->write('conditions', empty($this->data['Subscriber'])?true:$this->data['Subscriber']);
		}
		$this->redirect(array('action'=>'index'));
	}	
	/*
	function view($id = null) {
			if (!$id) {
				$this->Session->setFlash(__('Invalid subscriber', true));
				$this->redirect(array('action' => 'index'));
			}
			$this->set('subscriber', $this->Subscriber->read(null, $id));
		}*/
	function add() {
		if (!empty($this->data)) {
			//set the user how add the subscriber from session.
			//$this->data['Subscriber']['user_id'] = $this->Session->read('userInfo.User.id');
			//$this->data['Subscriber']['user_id'] = 0;			
			//save data
			$this->Subscriber->create();
			if ($this->Subscriber->saveAll($this->data, array('validate'=>'first'))) {			
				//set flash
				$this->Session->setFlash(__('The subscriber has been saved', true));
				$this->redirect(array('action' => 'index'));					
			} else {
				$this->Session->setFlash(__('The subscriber could not be saved. Please, try again.', true));
			}
		}
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid subscriber', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			//if($this->Session->read('userInfo.User.login_as') == 1 || $this->data['Subscriber']['user_id'] == $this->Session->read('userInfo.User.id')){
			// save data
			if ($this->Subscriber->saveAll($this->data, array('validate' => 'first'))) {				 								
				//set flash
				$this->Session->setFlash(__('The subscriber has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The subscriber could not be saved. Please, try again.', true));
			}/*}else{
				$this->Session->setFlash(__('Sorry! only Admins can edit this subscriber.', true));
				$this->redirect(array('action' => 'index'));
			}*/
		}
		//Save valedation errors then load it again after reading data. 
		$holdErrors = $this->Subscriber->validationErrors;
		$this->data = $this->Subscriber->read(null, $id);
		$this->Subscriber->validationErrors = $holdErrors;	
	}	
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for subscriber', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Subscriber->id = $id;
		//$subscriberuser_id = $this->Subscriber->field('user_id');
		//if($this->Session->read('userInfo.User.login_as') == 1 || $subscriberuser_id == $this->Session->read('userInfo.User.id')){
		//if($this->Session->read('userInfo.User.login_as') == 1){
		//delete
		if ($this->Subscriber->delete($id)) {	
			//set flash
			$this->Session->setFlash(__('Subscriber deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Subscriber was not deleted', true));
		$this->redirect(array('action' => 'index'));
		/*}else{
			$this->Session->setFlash(__('Sorry! only Admins can delete this subscriber.', true));
			$this->redirect(array('action' => 'index'));
		}*/		
	}
	function subscribers_import(){
		//if($this->Session->read('userInfo.User.login_as') == 1){
			if(!empty($this->data)){
				if($this->data['Subscriber']['type'] == 0){
					if(!empty($this->data['Subscriber']['mail_list'])){
						$mail_lists_data = $this->data['Subscriber']['mail_list'];
						$this->data['Subscriber']['mail_list']='';				
						$table = 'subscribers';
		    			$fields = array('email','sent','user_id');    
						$mail_lists = explode(",",$mail_lists_data);
						$row_count = 0;
						foreach($mail_lists as $row){
							if(!empty($row)){
								if(filter_var( $row, FILTER_VALIDATE_EMAIL )){
									$sql_query = "INSERT INTO $table(". implode(',',$fields) .") VALUES('";
				 				   	$sql_query .=  $row;
				   					$sql_query .= "', '0','0');";
				        			if($this->Subscriber->query($sql_query))
									$row_count++;
								}
							}
						}
					$this->Session->setFlash(__('The List of Email Addresses has been saved Successfully, '.$row_count.' records imported', true));
					$this->redirect(array('action' => 'index'));	
					}else	
					$this->Session->setFlash(__('You must enter List of Email Addresses!', true));		
				}elseif($this->data['Subscriber']['type'] == 1){				
					$handle = fopen($this->data['Subscriber']['file']['tmp_name'],'r');
					if(!$handle){
						die('Cannot open uploaded file.');
					}
					$row_count = 0;
					$rows = array();
					$table = 'subscribers';
		    		$fields = array('email','sent','user_id');
					while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
						if(!empty($data[0])){
							if(filter_var( $data[0], FILTER_VALIDATE_EMAIL )){
								$sql_query = "INSERT INTO $table(". implode(',',$fields) .") VALUES('";
			 				   	$sql_query .=  $data[0];
			   					$sql_query .= "', '0','0');";
			        			if($this->Subscriber->query($sql_query))
								$row_count++;
							}
						}					
					}		
					$this->Session->setFlash(__('The .CSV file has been saved Successfully, '.$row_count.' records imported', true));
					$this->redirect(array('action' => 'index'));	
				}
			}				 
		/*}else{
			$this->Session->setFlash(__('Sorry! only Admins can make Import Subscribers.', true));
			$this->redirect(array('action' => 'index'));
		}*/
	}
	function subscribers_delete(){
		//if($this->Session->read('userInfo.User.login_as') == 1){
			if(!empty($this->data)){
				if($this->data['Subscriber']['type'] == 0){
					if(!empty($this->data['Subscriber']['mail_list'])){
						$mail_lists_data = $this->data['Subscriber']['mail_list'];
						$this->data['Subscriber']['mail_list'] = '';				
						$table = 'subscribers';
		    			$fields = array('email','sent','user_id');    
						$mail_lists = explode(",",$mail_lists_data);
						$row_count = 0;
						foreach($mail_lists as $row){
							if(!empty($row)){
								if(filter_var( $row, FILTER_VALIDATE_EMAIL )){
									$sql_query = 'DELETE FROM `'.$table.'` WHERE `'.$table.'`.`email` = "'.$row.'";';		
				        			if($this->Subscriber->query($sql_query))
									$row_count++;
								}
							}
						}
					$this->Session->setFlash(__('The List of Email Addresses has been deleted Successfully, '.$row_count.' records deleted', true));
					$this->redirect(array('action' => 'index'));	
					}else	
					$this->Session->setFlash(__('You must enter List of Email Addresses!', true));		
				}elseif($this->data['Subscriber']['type'] == 1){				
					$handle = fopen($this->data['Subscriber']['file']['tmp_name'],'r');
					if(!$handle){
						die('Cannot open uploaded file.');
					}
					$row_count = 0;
					$rows = array();
					$table = 'subscribers';
		    		$fields = array('email','sent','user_id');
					while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
						if(!empty($data[0])){
							if(filter_var( $data[0], FILTER_VALIDATE_EMAIL )){
								$sql_query = 'DELETE FROM `'.$table.'` WHERE `'.$table.'`.`email` = "'.$data[0].'";';
			        			if($this->Subscriber->query($sql_query))
								$row_count++;
							}
						}					
					}		
					$this->Session->setFlash(__('The .CSV file has been deleted Successfully, '.$row_count.' records deleted', true));
					$this->redirect(array('action' => 'index'));	
				}
			}				 
		/*}else{
			$this->Session->setFlash(__('Sorry! only Admins can make Delete Subscribers.', true));
			$this->redirect(array('action' => 'index'));
		}*/
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Subscriber', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('subscriber', $this->Subscriber->read(null, $id));
	}
}