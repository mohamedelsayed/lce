<?php
require_once '../auth_controller.php';
class AlbumsController extends AuthController {

	var $name = 'Albums';
	var $uses = array('Album');
	//use upload component.
	var $components = array('Upload');
	
	function index() {
    	$this->Album->recursive = 0;
		$this->paginate = array(    			
				'order'      => array('Album.id'=>'DESC')
	    	);		
		$this->set('albums', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Album', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('album', $this->Album->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			//upload image and then add it to Gal.
			/*$this->data['Gal'][0]['image']=$this->Upload->uploadImage($this->data['Gal'][0]['image']);
			if($this->data['Gal'][0]['image']=='')unset($this->data['Gal']);*/
			
			$this->Upload->fileTypes = 'mp3';//set file types.
			$this->data['Audio'][0]['file'] = $this->Upload->uploadFile($this->data['Audio'][0]['file']);
			if($this->data['Audio'][0]['file'] =='' ) unset($this->data['Audio']);
			
			//upload image and video file then add them to Videos.
			$this->data['Video'][0]['image']=$this->Upload->uploadImage($this->data['Video'][0]['image']);
			$this->Upload->fileTypes = 'flv';//set file types.
			$this->data['Video'][0]['file']=$this->Upload->uploadFile($this->data['Video'][0]['file']);
			if($this->data['Video'][0]['file']=='' && $this->data['Video'][0]['url']=='')unset($this->data['Video']);
			
			//save data
			$this->Album->create();
			if ($this->Album->saveAll($this->data, array('validate'=>'first'))) {				
				//set flash
				$this->Session->setFlash(__('The Album has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Album could not be saved. Please, try again.', true));
			}
		}
		//$sections = $this->Album->Section->find('list');
		//$issues = $this->Album->Issue->find('list',array('order'  => array('Issue.date'=>'DESC','Issue.status' => 'ASC')));
		//$this->set(compact('sections', 'issues'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Album', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			//upload image and then add it to Gal.
			/*$this->data['Gal'][0]['image']=$this->Upload->uploadImage($this->data['Gal'][0]['image']);
			if($this->data['Gal'][0]['image']=='')unset($this->data['Gal']);*/
			
			$this->Upload->fileTypes = 'mp3';//set file types.
			$this->data['Audio'][0]['file'] = $this->Upload->uploadFile($this->data['Audio'][0]['file']);
			if($this->data['Audio'][0]['file'] =='' ) unset($this->data['Audio']);
			
			//upload image and video file then add them to Videos.
			$this->data['Video'][0]['image']=$this->Upload->uploadImage($this->data['Video'][0]['image']);
			$this->Upload->fileTypes = 'flv';//set file types.
			$this->data['Video'][0]['file']=$this->Upload->uploadFile($this->data['Video'][0]['file']);
			if($this->data['Video'][0]['file']=='' && $this->data['Video'][0]['url']=='')unset($this->data['Video']);
				
			//save data
			if ($this->Album->saveAll($this->data, array('validate'=>'first'))) {
				//set flash
				$this->Session->setFlash(__('The Album has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Album could not be saved. Please, try again.', true));
			}
		}
		//hold validation erros then load it again aftre reading data.
		$holdErrors = $this->Album->validationErrors;
		$this->data = $this->Album->read(null, $id);
		$this->Album->validationErrors = $holdErrors;
		//$sections = $this->Album->Section->find('list');
		//$issues = $this->Album->Issue->find('list',array('order'  => array('Issue.date'=>'DESC','Issue.status' => 'ASC')));
		//$this->set(compact('sections', 'issues'));
	}
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Album', true));
			$this->redirect(array('action'=>'index'));
		}
		//set the component var filesToDelete with an array of files should be deleted.
		//$relatedImgs    = $this->Album->Gal->find('list', array('fields'=>'Gal.image' ,'conditions' => array('album_id' => $id)));
		$relatedVids    = $this->Album->Video->find('list', array('fields'=>'Video.file' ,'conditions' => array('album_id' => $id)));
		$relatedThumb   = $this->Album->Video->find('list', array('fields'=>'Video.image' ,'conditions' => array('album_id' => $id)));					  	 					   
		$this->Upload->filesToDelete = array_merge( $relatedVids, $relatedThumb);		
		//delete
		if ($this->Album->delete($id)) {
			$this->Upload->deleteFile(); //delete old files.			
			//set flash
			$this->Session->setFlash(__('Album deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Album was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}	
	
}