<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2014 Programming by "mohamedelsayed.net"
 */
require_once '../auth_controller.php';
class GalsController extends AuthController {

	var $name = 'Gals';
	var $uses = array('Gal');
	//use upload component.
	var $components = array('Upload');
	
	function index($id = null, $model = null) {
		$positionField =  'position';
		$this->Gal->recursive = 0;
		$field = strtolower($model).'_id';
		$conditions['Gal.'.$field] = $id;
		$this->paginate = array(
			'conditions' => $conditions,
			'order' => array('Gal.position' => 'ASC', 'Gal.id' => 'DESC'),
			'limit' => isset($this->params['named']['limit'])?$this->params['named']['limit']:$this->paginate['limit'],
			'page'  => isset($this->params['named']['page'])?$this->params['named']['page']:$this->paginate['page'],			
		);
		$this->savePositions($positionField);
		$this->set('gals', $this->paginate());
		$this->Session->write('back_model', $model);
		$this->Session->write('back_id', $id);
	}
	//save articles positions.	
	private function savePositions($positionField){
		if(!empty($this->data['Gal']['ids'])){
			// set the start positions order.
			$i = (($this->paginate['page']-1) * $this->paginate['limit']) + 1;
			// save positions  	
			foreach ($this->data['Gal']['ids'] as $id){
				$this->Gal->id = $id;
				$this->Gal->saveField($positionField, $i);
				$i++;
			}
			$this->Session->setFlash(__('The Images positions have been saved', true));	
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid gal', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('gal', $this->Gal->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Gal->create();
			if ($this->Gal->save($this->data)) {
				$this->Session->setFlash(__('The gal has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The gal could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid gal', true));
			$this->redirect(array('action' => 'index/'.$this->Session->read('article_id')));
		}			
		if (!empty($this->data)) {
			//to upload image
			$this->Gal->id = $id;
			if($this->data['Gal']['image']['name']){
				$this->Upload->filesToDelete = array($this->Gal->field('image'));
				$this->data['Gal']['image']=$this->Upload->uploadImage($this->data['Gal']['image']);
			}
			else
				$this->data['Gal']['image'] = $this->Gal->field('image');			
			if ($this->Gal->save($this->data)) {
				$this->Session->setFlash(__('The Image has been saved', true));				
				$this->redirect($this->Session->read('Setting.url').'/gals/index/'.$this->Session->read('back_id').'/'.$this->Session->read('back_model'));						
			} else {
				$this->Session->setFlash(__('The Image could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Gal->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Image', true));
			$this->redirect($this->Session->read('Setting.url').'/gals/index/'.$this->Session->read('back_id').'/'.$this->Session->read('back_model'));
		}
		if ($this->Gal->delete($id)) {
			$this->Session->setFlash(__('Image deleted', true));
			$this->redirect($this->Session->read('Setting.url').'/gals/index/'.$this->Session->read('back_id').'/'.$this->Session->read('back_model'));
		}
		$this->Session->setFlash(__('Image was not deleted', true));
		$this->redirect($this->Session->read('Setting.url').'/gals/index/'.$this->Session->read('back_id').'/'.$this->Session->read('back_model'));
	}
	
	function deleteImage($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Image', true));
			$this->redirect($this->referer(array('controller'=>'admin/index')));
		}
		//Redirect if the user wrote the url by hand.
		$urlArr = explode('/', $this->referer());
		if( ($this->referer()=='/') || ($urlArr[2]!='edit') ){
			$this->Session->setFlash(__('Image was not deleted. Plz click the right link', true));
			$this->redirect(array('controller'=>'admin/index'));
		}
		//set the component var filesToDelete with an array of files should be deleted.
		$this->Gal->id = $id;
		$this->Upload->filesToDelete = array($this->Gal->field('image'));
		if ($this->Gal->delete($id)) {
			$this->Upload->deleteFile(); //delete old files.
			$this->Session->setFlash(__('Image deleted', true));
			$this->redirect($this->referer(array('controller'=>'admin/index')));
		}
		$this->Session->setFlash(__(' Image was not deleted', true));
		$this->redirect($this->referer(array('controller'=>'admin/index')));
	}
}
?>