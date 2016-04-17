<?php
require_once '../auth_controller.php';
class ImagesController extends AuthController {	
	
	var $name = 'Images';
	var $uses = null;
	
	var $helpers = array ('Html', 'Form', 'Cropimage' );
	//use upload component.
	var $components = array('Upload');

	public function view($imageName='', $size='thumb'){
		$imagePath = $this->Upload->imageUploadDir.$imageName;
		if(!$imageName || !file_exists($imagePath)){
			$this->Session->setFlash(__('No image found!', true));
			$this->redirect($this->referer(array('controller' => 'admin')));
		}
		switch ($size){
			case 'thumb':
			$cropWidth  = $this->Upload->thumbWidth;
			$cropHeight = $this->Upload->thumbHeight;
			break;
			
			case 'medium':
			$cropWidth  = $this->Upload->mediumImageWidth;
			$cropHeight = $this->Upload->mediumImageHeight;
			break;
			
			case 'large':
			$cropWidth  = $this->Upload->largeImageWidth;
			$cropHeight = $this->Upload->largeImageHeight;
			break;
			
			default:
			$this->Session->setFlash(__('Wrong Size!', true));
			$this->redirect($this->referer(array('controller' => 'admin')));
			break;
		}
		//To save return url;
		if(substr($this->referer(), 0, 7) != '/images')
			$this->Session->write('returnUrl', $this->referer(array('controller' => 'admin')));						
		$this->set(array(
			'imageName'   => $imageName,
			'imageWidth'  => $this->Upload->getWidth($imagePath),
			'imageHeight' => $this->Upload->getHeight($imagePath),
			'cropWidth'	  => $cropWidth,
			'cropHeight'  => $cropHeight,
			'size'        => $size,
			'imageDir'    => $this->Upload->imageUploadDir));
	}
	
	function crop($size){
		if(!empty($this->data)){
			$imagePath = $this->Upload->imageUploadDir.$this->data['Image']['imageName'];
			$cropPath = $this->Upload->imageUploadDir.$size.'_'.$this->data['Image']['imageName'];
			if($this->Upload->cropImage($imagePath, $cropPath, $size, $this->data['Image']['x1'], $this->data['Image']['y1'], $this->data['Image']['x2'], $this->data['Image']['y2'], $this->data['Image']['w'], $this->data['Image']['h']))
				$this->Session->setFlash(__('Done.', true));
			else
				$this->Session->setFlash(__('Faild! please try again', true));
				 
			$this->redirect(array('action' => 'view', $this->data['Image']['imageName'], $size));		
				
		}
		$this->Session->setFlash(__('No data!', true));
		$this->redirect(array('controller' => 'admin'));
	}
	
}
?>