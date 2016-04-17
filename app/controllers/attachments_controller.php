<?php
require_once '../auth_controller.php';
class AttachmentsController extends AuthController {

	var $name = 'Attachments';
	var $uses = array('Attachment');
	//use upload component.
	var $components = array('Upload');
	
	function deleteAttachment($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Attachment', true));
			$this->redirect($this->referer(array('controller'=>'admin/index')));
		}
		//Redirect if the user wrote the url by hand.
		$urlArr = explode('/', $this->referer());
		if( ($this->referer()=='/') || ($urlArr[2]!='edit') ){
			$this->Session->setFlash(__('Image was not deleted. Plz click the right link', true));
			$this->redirect(array('controller'=>'admin/index'));
		}
		//set the component var filesToDelete with an array of files should be deleted.
		$this->Attachment->id = $id;
		$this->Upload->filesToDelete = array($this->Attachment->field('file'));
		if ($this->Attachment->delete($id)) {
			$this->Upload->deleteFile(); //delete old files.
			// Save Log in case of (articles).
			if(($urlArr[1]=='articles') && (intval($urlArr[3])>0)){
				$this->requestAction('/logs/saveLog/article_id/'.$urlArr[3].'/DeleteAttachment');
			}
			$this->Session->setFlash(__('Attachment deleted', true));
			$this->redirect($this->referer(array('controller'=>'admin/index')));
		}
		$this->Session->setFlash(__('Attachment was not deleted', true));
		$this->redirect($this->referer(array('controller'=>'admin/index')));
	}

}
?>