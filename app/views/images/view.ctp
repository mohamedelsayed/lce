<?php 
	echo $this->Javascript->link('crop/jquery.imgareaselect-0.3.min', false);
	echo $this->Html->link(__('Crop thumb image', true), array('action' => 'view', $imageName, 'thumb'));
	echo ' | ';
	echo $this->Html->link(__('Crop medium image', true), array('action' => 'view', $imageName, 'medium'));
	echo ' | ';
	echo $this->Html->link(__('Crop large image', true), array('action' => 'view', $imageName, 'large'));
	echo ' | ';
	echo $this->Html->link(__('Back', true), $this->Session->read('returnUrl'));
	echo $this->Form->create('Image', array('action' => "crop/$size", "enctype" => "multipart/form-data")); 
	echo $this->Form->submit('Crop', array("id"=>"save_thumb")); 
	echo $this->Cropimage->createJavaScript($imageWidth, $imageHeight, $cropWidth, $cropHeight);
	echo $this->Cropimage->createForm($imageName, $cropWidth, $cropHeight, $size, $imageDir);
	
?>