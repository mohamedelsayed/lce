<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
require_once '../auth_controller.php';
class NeventsController extends AuthController {
	var $name = 'Nevents';
	//use upload component.
	var $components = array('Upload');
	function index() {
		$this->Nevent->recursive = 0;
		$this->set('nevents', $this->paginate());
		$this->set('title_for_layout' , 'Events');
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Event', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('nevent', $this->Nevent->read(null, $id));
		$this->set('title_for_layout' , 'Events');
		$saved_instructors = $this->get_saved_many_items($id);
		$this->set(compact('saved_instructors'));		
	}
	function add() {
		if (!empty($this->data)) {
			//upload image
			$this->data['Nevent']['image']=$this->Upload->uploadImage($this->data['Nevent']['image']);
			$this->Nevent->create();
			if ($this->Nevent->save($this->data)) {
				$event_id = $this->Nevent->id;
				$this->save_many_items_ids($event_id, $_POST['instructors_ids']);
				$this->Session->setFlash(__('The Event has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Event could not be saved. Please, try again.', true));
			}
		}
		//$instructors = $this->Nevent->Instructor->find('list');
		$this->set(compact('instructors'));
		$this->set('title_for_layout' , 'Events');
		$saved_instructors = array();
		$this->set(compact('saved_instructors'));
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Event', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			//upload image
			$this->Nevent->id = $id;
			if($this->data['Nevent']['image']['name']){
				$this->Upload->filesToDelete = array($this->Nevent->field('image'));
				$this->data['Nevent']['image']=$this->Upload->uploadImage($this->data['Nevent']['image']);
			}else
				unset($this->data['Nevent']['image']);
			if ($this->Nevent->save($this->data)) {
				$event_id = $this->data['Nevent']['id'];
				$this->save_many_items_ids($event_id, $_POST['instructors_ids']);
				$this->Session->setFlash(__('The Event has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Event could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Nevent->read(null, $id);
		}
		$instructors = $this->Nevent->Instructor->find('list');
		$this->set(compact('instructors'));
		$this->set('title_for_layout' , 'Events');
		$saved_instructors = $this->get_saved_many_items($id);
		$this->set(compact('saved_instructors'));
	}
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Event', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Nevent->delete($id)) {
			$this->Session->setFlash(__('Nevent deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Nevent was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function save_many_items_ids($event_id = 0, $items_ids, $model = 'NeventInstructor'){
		if($model != ''){
			if($model == 'NeventInstructor'){
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
	function get_saved_many_items($event_id = 0, $model = 'NeventInstructor'){
		if($model == 'NeventInstructor'){
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
}