<?php /**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.mohamedelsayed.net/
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
require_once '../authfront_controller.php';
class EventsController extends AuthfrontController {
	var $name = 'Events';
	var $uses = array('Event', 'AttendEvent');
	function index() {
		$type = 0;
		if(isset($_GET['type'])){
			$type = $_GET['type'];
		}
		$this->set('type', $type);
		$this->set('selected','adminpages');
		if($this->isSuperAdmin() || $this->isAdmin()){
			$this->Event->recursive = 0;
			$this->paginate = array(
				'conditions' => array('Event.type' => $type),
				'order' => array('Event.id' => 'DESC'),
	    	);
			$this->set('events', $this->paginate());
			$this->set('title_for_layout' , 'Events');
		}else{
			$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'login'));	
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
			$this->Session->setFlash(__('Invalid Event', true));
			$this->redirect(array('action' => 'index'));
		}
		$event = $this->Event->read(null, $id);
		$this->set('event', $event);
		if(!($event['Event']['approved'] == 1 || $isAdmin == 1)){
			$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'login'));	
		}
		$this->set('title_for_layout' , $event['Event']['title']);
		$saved_instructors = $this->get_saved_many_items($id);
		$instructors = $this->Event->Instructor->find('list', array('conditions' => array('Instructor.forum_flag' => 1, 'Instructor.approved' => 1)));
		$this->set(compact('instructors'));
		$this->set(compact('saved_instructors'));	
		if($event['Event']['type'] == 0 || $GLOBALS['is_loggin']){
		}else{
			$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'login'));
		}
	}
	function add() {
		$type = 0;
		if(isset($_GET['type'])){
			$type = $_GET['type'];
		}
		$this->set('type', $type);
		$this->set('selected','adminpages');
		$isAdmin = 0;
		if($this->isSuperAdmin() || $this->isAdmin()){
			$isAdmin = 1;
		}
		$this->set('isAdmin', $isAdmin);
		if($this->isSuperAdmin() || $this->isAdmin()){
			if (!empty($this->data)) {
				//upload image
				$this->data['Event']['image']=$this->Upload->uploadImage($this->data['Event']['image']);
				$this->Event->create();
				if ($this->Event->saveAll($this->data, array('validate'=>'first'))) {
					$this->send_email_notification($this->Event->id, 1, $this->data['Event']['title'], 0);
					$event_id = $this->Event->id;
					$this->save_many_items_ids($event_id, $_POST['instructors_ids']);
					$this->Session->setFlash(__('The Event has been saved', true));
					if($isAdmin == 1){
						$this->redirect(array('action' => 'index?type='.$this->data['Event']['type']));
					}else{
						$this->redirect(array('controller' => 'calendar', 'action' => 'index'));					
					}
				} else {
					$this->Session->setFlash(__('The Event could not be saved. Please, try again.', true));
				}
			}
			$instructors = $this->Event->Instructor->find('list', array('conditions' => array('Instructor.forum_flag' => 1)));
			$this->set(compact('instructors'));
			$this->set('title_for_layout' , 'Events');
			$saved_instructors = array();
			$this->set(compact('saved_instructors'));
		}else{
			$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'login'));	
		}	
	}
	function edit($id = null) {
		$this->set('selected','adminpages');
		$isAdmin = 0;
		if($this->isSuperAdmin() || $this->isAdmin()){
			$isAdmin = 1;
		}
		$this->set('isAdmin', $isAdmin);	
		if($this->isSuperAdmin() || $this->isAdmin()){
			if (!$id && empty($this->data)) {
				$this->Session->setFlash(__('Invalid Event', true));
				$this->redirect(array('action' => 'index'));
			}
			if (!empty($this->data)) {
				//upload image
				$this->Event->id = $id;
				if($this->data['Event']['image']['name']){
					$this->Upload->filesToDelete = array($this->Event->field('image'));
					$this->data['Event']['image']=$this->Upload->uploadImage($this->data['Event']['image']);
				}else
					unset($this->data['Event']['image']);
				if ($this->Event->save($this->data)) {
					$event_id = $this->data['Event']['id'];
					$this->save_many_items_ids($event_id, $_POST['instructors_ids']);
					$this->Session->setFlash(__('The Event has been saved', true));
					$this->redirect(array('action' => 'index?type='.$this->data['Event']['type']));
				} else {
					$this->Session->setFlash(__('The Event could not be saved. Please, try again.', true));
				}
			}
			if (empty($this->data)) {
				$this->data = $this->Event->read(null, $id);
				$this->set('type', $this->data['Event']['type']);
			}
			$instructors = $this->Event->Instructor->find('list', array('conditions' => array('Instructor.forum_flag' => 1)));
			$this->set(compact('instructors'));
			$this->set('title_for_layout' , 'Events');
			$saved_instructors = $this->get_saved_many_items($id);
			$this->set(compact('saved_instructors'));
		}else{
			$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'login'));	
		}	
	}
	function delete($id = null) {
		if($this->isSuperAdmin() || $this->isAdmin()){
			if (!$id) {
				$this->Session->setFlash(__('Invalid id for Event', true));
				$this->redirect(array('action'=>'index'));
			}
			$this->data = $this->Event->read(null, $id);
			$type = $this->data['Event']['type'];
			if ($this->Event->delete($id)) {
				$this->Session->setFlash(__('Event deleted', true));
				$this->redirect(array('action'=> 'index?type='.$type));
			}
			$this->Session->setFlash(__('Event was not deleted', true));
			$this->redirect(array('action' => 'index'));
		}else{
			$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'login'));	
		}
	}	
	function willcome($id, $flag = 0){
		$member_id = $this->Cookie->read('userInfoFront.id');
		if(!is_numeric($member_id)){
			$member_id = 0;
		}
		$this->data['AttendEvent']['event_id'] = $id;
		$this->data['AttendEvent']['member_id'] = $member_id;
		$this->data['AttendEvent']['attend_flag'] = $flag;
		$attendEvent = $this->AttendEvent->find(
			'first', array(
				'conditions' => array('AttendEvent.event_id' => $id,'AttendEvent.member_id' => $member_id),
			)	  	 	
		);	
		if(empty($attendEvent) || $member_id == 0){
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
	function all(){
		$this->set('selected','adminpages');
	}
	function save_many_items_ids($event_id = 0, $items_ids, $model = 'EventInstructor'){
		if($model != ''){
			if($model == 'EventInstructor'){
				$field = 'instructor_id';
			}
			$items_ids =  trim(trim($items_ids, ','));
			$new_items_array = explode(',', $items_ids);
			$this->loadModel($model);
			$old_items_array = $this->get_saved_many_items($event_id, $model);
			$data_intersect = array_intersect($new_items_array, $old_items_array);
	        $data_to_add = array_diff($new_items_array, $data_intersect);
	        $data_to_delete = array_diff($old_items_array, $data_intersect);
			foreach ($data_to_add as $key => $value) {
				if(is_numeric($value) && $value > 0){
					$data = array(
					    $model => array(
					        'event_id' => $event_id,
					        $field => $value
					    )
					);
					$this->$model->create();
					$this->$model->save($data);			
				}
			}		
			foreach ($data_to_delete as $key => $value) {
				$this->$model->deleteAll(array($model.'.event_id' => $event_id,
															$model.'.instructor_id' => $value,));
			}
		}
	}
	function get_saved_many_items($event_id = 0, $model = 'EventInstructor'){
		if($model == 'EventInstructor'){
			$field = 'instructor_id';
		}
		$this->loadModel($model);
		$old_items = $this->$model->find(
			'all', array(
				'conditions' => array($model.'.event_id' => $event_id),
			)	  	 	
		);
		$old_items_array = array();
		if(!empty($old_items)){
			foreach ($old_items as $key => $value) {
				$old_items_array[] = $value[$model][$field];		
			}
		}	
		return $old_items_array;
	}
	function deleteImage ($id){
		if (!$id) {
			$this->Session->setFlash(__('Invalid Event', true));
			$this->redirect($this->referer(array('action' => 'index')));
		}
		//to delete image file
		$this->Event->id = $id;
		$event = $this->Event->read(null, $id);
		if($this->isSuperAdmin() || $this->isAdmin()){
			$this->Upload->filesToDelete = array($this->Event->field('image'));
			if ($this->Event->saveField('image', '')) {
				$this->Upload->deleteFile();
				$this->Session->setFlash(__('The Event image has been deleted', true));
			} else {
				$this->Session->setFlash(__('The Event image could not be deleted. Please, try again.', true));
			}
			$this->redirect($this->referer(array('action' => 'index')));
		}else{
			$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'login'));	
		}		
	}	
}