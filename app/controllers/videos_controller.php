<?php
require_once '../auth_controller.php';
class VideosController extends AuthController {

	var $name = 'Videos';
	var $uses = array('Video');
	//use upload component.
	var $components = array('Upload');

	function deleteVideo($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for video', true));
			$this->redirect($this->referer(array('controller'=>'admin/index')));
		}
		//Redirect if the user wrote the url by hand.
		$urlArr = explode('/', $this->referer());
		if( ($this->referer()=='/') || ($urlArr[2]!='edit') ){
			$this->Session->setFlash(__('Image was not deleted. Plz click the right link', true));
			$this->redirect(array('controller'=>'admin/index'));
		}
		//set the component var filesToDelete with an array of files should be deleted.
		$this->Video->id = $id;
		$this->Upload->filesToDelete = array($this->Video->field('file'), $this->Video->field('image'));
		if ($this->Video->delete($id)) {
			$this->Upload->deleteFile(); //delete old files.
			$this->Session->setFlash(__('Video deleted', true));
			$this->redirect($this->referer(array('controller'=>'admin/index')));
		}
		$this->Session->setFlash(__('Video was not deleted', true));
		$this->redirect($this->referer(array('controller'=>'admin/index')));
	}

}
?>