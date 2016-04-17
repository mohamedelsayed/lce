<?php /**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.mohamedelsayed.net/
 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */
require_once '../authfront_controller.php';
class EventsController extends AuthfrontController {
	var $name = 'Events';
	var $uses = array('Event', 'AttendEvent');
	//use upload component.
	//var $components = array('Upload');
	function index() {
		$this->Event->recursive = 0;
		if($this->isSuperAdmin() || $this->isAdmin()){
			if(isset($this->data['Event']['title'])){
				$this->paginate = array(
					'conditions' => array('Event.title LIKE' => "%".$this->data['Event']['title']."%"),
	    		);
			}
			$this->set('events', $this->paginate());
		}else{
			$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'index'));	
		}
	}
	function view($id = null) {
		$isAdmin = 0;
		if($this->isSuperAdmin() || $this->isAdmin()){
			$isAdmin = 1;
		}
		$this->set('isAdmin', $isAdmin);
		$member_id = $this->Cookie->read('userInfoFront.id');
		$attendEvent = $this->AttendEvent->find(
					'first', array(
						'conditions' => array('AttendEvent.event_id' => $id,'AttendEvent.member_id' => $member_id),
					)	  	 	
				);	
		$attendEventFlag = -1;
		if(!empty($attendEvent)){
			$attendEventFlag = $attendEvent['AttendEvent']['attend_flag'];
		}		
		$this->set('attendEventFlag', $attendEventFlag);	
		$this->set('willyoucome_options' , $this->willyoucome_options);
		$attendEvents = $this->AttendEvent->find(
					'all', array(
						'conditions' => array('AttendEvent.event_id' => $id),
					)	  	 	
				);	
		$this->set('attendEvents', $attendEvents);		
		if (!$id) {
			$this->Session->setFlash(__('Invalid event', true));
			$this->redirect(array('action' => 'index'));
		}
		$event = $this->Event->read(null, $id);
		$this->set('event', $event);
		if(!($event['Event']['approved'] == 1 || $isAdmin == 1)){
			$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'index'));	
		}
	}
	function add() {
		$isAdmin = 0;
		if($this->isSuperAdmin() || $this->isAdmin()){
			$isAdmin = 1;
		}
		$this->set('isAdmin', $isAdmin);	
		if (!empty($this->data)) {
			//upload image and then add it to Gal.
			//$this->data['Gal'][0]['image']=$this->Upload->uploadImage($this->data['Gal'][0]['image']);
			//if($this->data['Gal'][0]['image']=='')unset($this->data['Gal']);
			//if($this->data['Video'][0]['url']=='')unset($this->data['Video']);
			//save data.
			$this->Event->create();
			if ($this->Event->saveAll($this->data, array('validate'=>'first'))) {
				$this->send_email_notification($this->Event->id, 1, $this->data['Event']['title'], 0);
				
				//set flash.
				$this->Session->setFlash(__('The event has been saved', true));
				if($isAdmin == 1){
					$this->redirect(array('action' => 'index'));
				}else{
					$this->redirect(array('controller' => 'calendar', 'action' => 'index'));					
				}
			} else {
				$this->Session->setFlash(__('The event could not be saved. Please, try again.', true));
			}
		}
	}
	function edit($id = null) {
		$isAdmin = 0;
		if($this->isSuperAdmin() || $this->isAdmin()){
			$isAdmin = 1;
		}
		$this->set('isAdmin', $isAdmin);	
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid event', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			//upload image and then add it to Gal.
			//$this->data['Gal'][0]['image']=$this->Upload->uploadImage($this->data['Gal'][0]['image']);
			//if($this->data['Gal'][0]['image']=='')unset($this->data['Gal']);
			if($this->data['Video'][0]['url']=='')unset($this->data['Video']);
			//save data.
			if ($this->Event->saveAll($this->data, array('validate'=>'first'))) {
				//set flash.
				$this->Session->setFlash(__('The event has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Event->read(null, $id);
			if(!($this->isSuperAdmin() || $this->isAdmin())){
				if($this->data['Event']['member_id'] != $this->Cookie->read('userInfoFront.id')){
					$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
					$this->redirect(array('controller' => 'forum', 'action' => 'index'));	
				}					
			}
		}
		//$holdErrors = $this->Event->validationErrors;
		//$this->data = $this->Event->read(null, $id);
		//$this->Event->validationErrors = $holdErrors;
	}
	function delete($id = null) {
		$event = $this->Event->read(null, $id);
		$isAdmin = 0;
		if($this->isSuperAdmin() || $this->isAdmin()){
			$isAdmin = 1;
		}
		if($isAdmin == 1 || ($event['Event']['member_id'] == $this->Cookie->read('userInfoFront.id'))){
			if (!$id) {
				$this->Session->setFlash(__('Invalid id for event', true));
				$this->redirect(array('action'=>'index'));
			}
			//set the component var filesToDelete with an array of files should be deleted.
			//$this->Upload->filesToDelete  = $this->Event->Gal->find('list', array('fields'=>'Gal.image' ,'conditions' => array('event_id' => $id)));
			
			if ($this->Event->delete($id)) {
				$this->send_email_notification($id, 3, $event['Event']['title'], 0);				
				//$this->Upload->deleteFile(); //delete old files.
				$this->Session->setFlash(__('Event deleted', true));
				if($isAdmin == 1){
					$this->redirect(array('action' => 'index'));
				}else{
					$this->redirect(array('controller' => 'calendar', 'action' => 'index'));					
				}
			}
			$this->Session->setFlash(__('Event was not deleted', true));
			if($isAdmin == 1){
				$this->redirect(array('action' => 'index'));
			}else{
				$this->redirect(array('controller' => 'calendar', 'action' => 'index'));					
			}
		}else{
			$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'index'));	
		}
	}	
	function willcome($id, $flag = 0){
		$member_id = $this->Cookie->read('userInfoFront.id');
		$this->data['AttendEvent']['event_id'] = $id;
		$this->data['AttendEvent']['member_id'] = $member_id;
		$this->data['AttendEvent']['attend_flag'] = $flag;
		$attendEvent = $this->AttendEvent->find(
					'first', array(
						'conditions' => array('AttendEvent.event_id' => $id,'AttendEvent.member_id' => $member_id),
					)	  	 	
				);	
		if(empty($attendEvent)){
			$this->AttendEvent->create();
			if ($this->AttendEvent->save($this->data)) {
				$this->redirect(array('controller' => 'events', 'action' => 'view', $id));
			}			
		}	
	}
	/*function all(){
		$limit = $this->pagingLimit;
		$page = isset($this->params['named']['page'])?$this->params['named']['page']:$this->paginate['page'];	
		$conditions = array('Event.approved' => 1);					
		$this->paginate['Event'] = array(
    			//'fields'     => array('Event.id', 'Event.title', 'Event.body'),
    			'conditions' => $conditions,
				'order'      => array('Event.updated' => 'DESC','Event.id'=>'DESC'),
		    	'limit'      => $limit,
		    	'page'  	 => $page
	    	);
		$this->set('page',$page);
		$this->set('events', $this->paginate('Event'));		
	}*/
}