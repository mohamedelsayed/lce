<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
require_once '../auth_controller.php';
class CoachesController extends AuthController {
	var $name = 'Coaches';
	//use upload component.
	var $components = array('Upload');
	var $statement_limit = 200;
	var $biography_limit = 800;
	function index() {
		$this->Coach->recursive = 0;
		$this->paginate = array(
			//'conditions' => array($conditions),
			'order' => array('Coach.created' => 'DESC', 'Coach.id' => 'DESC'),
    	);
		$this->set('coaches', $this->paginate());
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Coach', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('coach', $this->Coach->read(null, $id));
		$specializations = $this->Coach->Specialization->find('list');
		$geographys = $this->Coach->Geography->find('list');
		$saved_specializations = $this->get_saved_many_items($id, 'CoachSpecialization');
		$saved_geographys = $this->get_saved_many_items($id, 'CoachGeography');
		$this->set(compact('specializations', 'geographys', 'saved_specializations', 'saved_geographys'));		
	}
	function add() {
		if (!empty($this->data)) {
			//upload image
			$this->data['Coach']['image']=$this->Upload->uploadImage($this->data['Coach']['image']);
			$this->Upload->fileTypes = 'flv';//set file types.
			$this->data['Coach']['video_file']=$this->Upload->uploadFile($this->data['Coach']['video_file']);
			$this->Coach->create();
			if ($this->Coach->saveAll($this->data)) {
				$coach_id = $this->Coach->id;
				$this->save_many_items_ids($coach_id, $_POST['specializations_ids'], 'CoachSpecialization');
				$this->save_many_items_ids($coach_id, $_POST['geographys_ids'], 'CoachGeography');
				$this->Session->setFlash(__('The Coach has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Coach could not be saved. Please, try again.', true));
			}
		}
		$this->set('statement_limit',$this->statement_limit);
		$this->set('biography_limit',$this->biography_limit);
		$specializations = $this->Coach->Specialization->find('list');
		$geographys = $this->Coach->Geography->find('list');
		$saved_specializations = array();
		$saved_geographys = array();
		$this->set(compact('specializations', 'geographys', 'saved_specializations', 'saved_geographys'));
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Coach', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			//upload image
			$this->Coach->id = $id;
			if($this->data['Coach']['image']['name']){
				$this->Upload->filesToDelete = array($this->Coach->field('image'));
				$this->data['Coach']['image'] = $this->Upload->uploadImage($this->data['Coach']['image']);
			}else{
				unset($this->data['Coach']['image']);
			}
			$this->Upload->fileTypes = 'flv';//set file types.
			if($this->data['Coach']['video_file']['name']){
				$this->Upload->filesToDelete = array($this->Coach->field('video_file'));
				$this->data['Coach']['video_file'] = $this->Upload->uploadFile($this->data['Coach']['video_file']);
			}else{
				unset($this->data['Coach']['video_file']);
			}
			if ($this->Coach->saveAll($this->data)) {
				$coach_id = $this->data['Coach']['id'];
				$this->save_many_items_ids($coach_id, $_POST['specializations_ids'], 'CoachSpecialization');
				$this->save_many_items_ids($coach_id, $_POST['geographys_ids'], 'CoachGeography');
				$this->Session->setFlash(__('The Coach has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Coach could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Coach->read(null, $id);
		}
		$this->set('statement_limit',$this->statement_limit);
		$this->set('biography_limit',$this->biography_limit);
		$specializations = $this->Coach->Specialization->find('list');
		$geographys = $this->Coach->Geography->find('list');
		$saved_specializations = $this->get_saved_many_items($id, 'CoachSpecialization');
		$saved_geographys = $this->get_saved_many_items($id, 'CoachGeography');
		$this->set(compact('specializations', 'geographys', 'saved_specializations', 'saved_geographys'));		
	}
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Coach', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Coach->delete($id)) {
			$this->Session->setFlash(__('Coach deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Coach was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function save_many_items_ids($coach_id = 0, $items_ids, $model = ''){
		if($model != ''){
			if($model == 'CoachSpecialization'){
				$field = 'specialization_id';
			}elseif($model == 'CoachGeography'){
				$field = 'geography_id';				
			}
			$items_ids =  trim(trim($items_ids, ','));
			$new_items_array = explode(',', $items_ids);
			$this->loadModel($model);
			$old_items_array = $this->get_saved_many_items($coach_id, $model);
			$data_intersect = array_intersect($new_items_array, $old_items_array);
	        $data_to_add = array_diff($new_items_array, $data_intersect);
	        $data_to_delete = array_diff($old_items_array, $data_intersect);
			foreach ($data_to_add as $key => $value) {
				if(is_numeric($value) && $value > 0){
					$data = array(
					    $model => array(
					        'coach_id' => $coach_id,
					        $field => $value
					    )
					);
					$this->$model->create();
					$this->$model->save($data);			
				}
			}		
			foreach ($data_to_delete as $key => $value) {
				$this->$model->deleteAll(array($model.'.coach_id' => $coach_id,
															$model.'.specialization_id' => $value,));
			}
		}
	}
	function get_saved_many_items($coach_id = 0, $model = ''){
		if($model == 'CoachSpecialization'){
			$field = 'specialization_id';
		}elseif($model == 'CoachGeography'){
			$field = 'geography_id';				
		}
		$this->loadModel($model);
		$old_items = $this->$model->find(
			'all', array(
				'conditions' => array($model.'.coach_id' => $coach_id),
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