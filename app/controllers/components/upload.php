<?php
class UploadComponent extends AppController{
	var $name = 'Upload';	
	public $folder; //upload dir.
	public $fileName; // save the base name of the file ex: 'image.jpg'.
	public $types; //string of file types ex "jpeg,gif,png,jpg". 
	public $maxUploadSize; //max file size in bytes.
	//resize -> 0 no resizing, and make a Thumb copy whith width $thumbWidth height $thumbHight.
	// 1 -> resize image to $masterImageWidth and $masterImageHeight.
	// 2 -> resize image to $masterImageWidth and $masterImageHeight, and make a Thumb copy $thumbWidth and $thumbHight.
	// 3 -> resize image to $maxImageWidt (if image width > $maxImageWidth), and make a Thumb copy $thumbWidth and $thumbHight. 
	public $resize;
	public $maxImageWidth;
	public $masterImageWidth;
	public $masterImageHeight;
	// To Crop a large image.
	public $largeImageWidth;
	public $largeImageHeight;
	// To Crop a medium image.
	public $mediumImageWidth;
	public $mediumImageHeight;
	// To Crop a thumbnail.
	public $thumbWidth;
	public $thumbHeight;
	//other vars
	public $relatedRatio = 0;
	public $aspectWidth = 0;
	public $aspectHight = 0;
	public $validity = 0.05;
	public $filesToDelete = array(); //array of files should be deleted.
	public $error; //save upload errors.
	
	/***************************************************
	    * Initializes UploadComponent for use in the controller
	    *
	    * @param object $controller A reference to the instantiating controller object
	    * @return void
	    * @access public
	*/
	function startup(&$controller){
		$this->setVars();
	}
	
	public function setVars(){
		//$this->fileName 		 = '';
		$this->imageUploadDir    = IMAGES.'upload'.DS; 
		$this->fileUploadDir     = WWW_ROOT.'files'.DS.'upload'.DS;
		$this->imageTypes 		 = $this->Session->read('Setting.image_types');
		$this->fileTypes 		 = $this->Session->read('Setting.file_types');
		$this->maxUploadSize     = $this->Session->read('Setting.max_upload_size')*1024*1024;//Convert megas to bytes.
		$this->resize  			 = $this->Session->read('Setting.resize');
		$this->maxImageWidth 	 = $this->Session->read('Setting.max_image_width');
		$this->masterImageWidth  = $this->Session->read('Setting.master_image_width');
		$this->masterImageHeight = $this->Session->read('Setting.master_image_height');
		$this->largeImageWidth   = $this->Session->read('Setting.large_image_width');
		$this->largeImageHeight  = $this->Session->read('Setting.large_image_height');
		$this->mediumImageWidth  = $this->Session->read('Setting.medium_image_width');
		$this->mediumImageHeight = $this->Session->read('Setting.medium_image_height');
		$this->thumbWidth 		 = $this->Session->read('Setting.thumb_width');
		$this->thumbHeight 		 = $this->Session->read('Setting.thumb_height');
		//$this->filesToDelete 	 = array();
		$this->error			 = '';
	}
	
	//Delete files  
	public function deleteFile(){
		if(!empty($this->filesToDelete)){
			foreach($this->filesToDelete as $fileToDelete){
				if($fileToDelete != ''){
					if(file_exists($this->fileUploadDir.$fileToDelete)) 
					    unlink($this->fileUploadDir.$fileToDelete);
					else{ 
						if(file_exists($this->imageUploadDir.$fileToDelete)) 
						    unlink($this->imageUploadDir.$fileToDelete);
						if(file_exists($this->imageUploadDir.'large_'.$fileToDelete)) 
						    unlink($this->imageUploadDir.'large_'.$fileToDelete);
						if(file_exists($this->imageUploadDir.'medium_'.$fileToDelete)) 
						    unlink($this->imageUploadDir.'medium_'.$fileToDelete);
						if(file_exists($this->imageUploadDir.'thumb_'.$fileToDelete)) 
						    unlink($this->imageUploadDir.'thumb_'.$fileToDelete);        
					}    
				}	        
			}
		}
		$this->filesToDelete=array();
	}
	
	//Upload File
	public function uploadFile($dataArr){
		//Check that file exists
		if(!$dataArr['name']){
			$this->setVars();
			return '';
		}
		//Check maxUploadSize
		if($dataArr['size']>$this->maxUploadSize)
		{
			$this->error = "'".$dataArr['name']."' File Size Is larger than Max Size:".round($this->maxUploadSize/1024)." Kb"; //Show error if any.
			$this->getOut();
		}
		//Get file extension
		$ext_arr = split("\.",basename($dataArr['name']));
		$ext = strtolower($ext_arr[count($ext_arr)-1]); //Get the last extension
		$file_name_without_ext = str_replace('.'.$ext,"",$dataArr['name']);
		//Not really uniqe - but for all practical reasons, it is
		$uniqer = substr(md5(uniqid(rand(),1)),0,5);
		//$this->fileName = $uniqer . '_' . $dataArr['name'];//Get Unique Name
		$this->fileName =  $file_name_without_ext . '_' . $uniqer . '.' . $ext;//Get Unique Name
		$this->fileName = str_replace(" ","_",$this->fileName);
		$special = array(DS,'!','&','*','~','#','$','%','^','(',')','-','<','>','?','@','+','|','=',DS,'\\','"','\'','[',']','{','}',':',';',',');
		$this->fileName = str_replace($special,'_', $this->fileName);
		$all_types = explode(",",strtolower($this->fileTypes));
		if($this->fileTypes) {
			if(in_array($ext,$all_types));
			else {
				$this->error = "'".$dataArr['name']."' is not a valid file."; //Show error if any.
				$this->getOut();
			}
		}
		//Where the file must be uploaded to
		$uploadfile = $this->fileUploadDir . $this->fileName;
		//Move the file from the stored location to the new location
		if (!move_uploaded_file($dataArr['tmp_name'], $uploadfile)) {
			$this->error = "Cannot upload the file '".$dataArr['name']."'"; //Show error if any.
			if(!file_exists($this->fileUploadDir)) {
				$this->error .= " : Folder don't exist.";
			} elseif(!is_writable($this->fileUploadDir)) {
				$this->error .= " : Folder not writable.";
			} elseif(!is_writable($uploadfile)) {
				$this->error .= " : File not writable.";
			}
		} else {
			if(!$dataArr['size']) { //Check if the file is made
				@unlink($uploadfile);//Delete the Empty file
				$this->error = "Empty file found - please use a valid file."; //Show the error message
			}else{
				chmod($uploadfile,0777);//Make it universally writable.
			}
		}
		if($this->error)
			$this->getOut();
		else {
			$this->setVars();
			return $this->fileName;
		}		
	}
	
	//upload image
	public function uploadImage($dataArr){
		//Check that file exists 
		if(!$dataArr['name']){
			$this->setVars();
			return '';
		}
		//Check maxUploadSize
		if($dataArr['size']>$this->maxUploadSize)
		{
			$this->error = "'".$dataArr['name']."' File Size Is larger than Max Size:".round($this->maxUploadSize/1024)." Kb"; //Show error if any.
			$this->getOut();
		}
		if($this->relatedRatio==1)
		{
			list($width, $height, $type, $attr) = getimagesize($dataArr['tmp_name']);

			$exp_width=$width/$this->aspectWidth;
			$exp_height=$exp_width*$this->aspectHight;
			if(abs($exp_height-$height)>$this->validity*$exp_height)
			{
				if($this->aspectHight ==$this->aspectWidth)
					$this->error = "'".$dataArr['name']."Sorry the image upload for (".$dataArr['name'].") failed: image ratio/size does not match the required aspect ratio 1:1 (Square Image). Please resize to upload."; //Show error if any.
				else
					$this->error = "Sorry the image upload for (".$dataArr['name'].") failed: image ratio/size does not match the required aspect ratio $this->aspectWidth:$this->aspectHight. Please resize to upload."; //Show error if any.
				$this->getOut();
			}

		}
		//Get file extension
		$ext_arr = split("\.",basename($dataArr['name']));
		$ext = strtolower($ext_arr[count($ext_arr)-1]); //Get the last extension
	    $file_name_without_ext = str_replace('.'.$ext,"",$dataArr['name']);
		//Not really uniqe - but for all practical reasons, it is
		$uniqer = substr(md5(uniqid(rand(),1)),0,5);
		$this->fileName= $uniqer . '_' . $dataArr['name'];//Get Unique Name
		$this->fileName =  $file_name_without_ext . '_' . $uniqer . '.' . $ext;//Get Unique Name
		$this->fileName=str_replace(" ","_",$this->fileName);
		$special = array(DS,'!','&','*','~','#','$','%','^','(',')','-','<','>','?','@','+','|','=',DS,'\\','"','\'','[',']','{','}',':',';',',');
		$this->fileName = str_replace($special,'_', $this->fileName);
		$all_types = explode(",",strtolower($this->imageTypes));
		if($this->imageTypes) {
			if(in_array($ext,$all_types));
			else {
				$this->error = "'".$dataArr['name']."' is not a valid file."; //Show error if any.
				$this->getOut();
			}
		}
		//Where the file must be uploaded to
		$uploadfile 	  = $this->imageUploadDir . $this->fileName;
		//$thumb_uploadfile = $this->imageUploadDir . 'thumb_'. $this->fileName;
		//Move the file from the stored location to the new location
		if (!move_uploaded_file($dataArr['tmp_name'], $uploadfile)) {
			$this->error = "Cannot upload the file '".$dataArr['name']."'"; //Show error if any.
			if(!file_exists($this->imageUploadDir)) {
				$this->error .= " : Folder don't exist.";
			} elseif(!is_writable($this->imageUploadDir)) {
				$this->error .= " : Folder not writable.";
			} elseif(!is_writable($uploadfile)) {
				$this->error .= " : File not writable.";
			}
		} else {
			if(!$dataArr['size']) { //Check if the file is made
				@unlink($uploadfile);//Delete the Empty file
				$this->error = "Empty file found - please use a valid file."; //Show the error message
			}
			else{
				chmod($uploadfile,0777);//Make it universally writable.
				//Resizing the image
				if($this->resize==1 ||$this->resize==2){
					if(!$this->smartResizeImage($uploadfile,$this->masterImageWidth,$this->masterImageHeight,true))
					$this->error .= 'Could not resize original image to ' . $this->masterImageWidth . 'x' . $this->masterImageHeight;
				}
				if ($this->resize == 3){
					list($width, $height, $type, $attr) = getimagesize($uploadfile);
					if ($width > $this->maxImageWidth){
						if(!$this->smartResizeImage($uploadfile,$this->maxImageWidth,0,true))
							$this->error .= 'Could not resize original image to ' . $this->maxImageWidth;
					}	
				}
				/*if($this->resize == 0 || $this->resize == 2 || $this->resize == 3){
					if(!$this->smartResizeImage($uploadfile,$this->thumbWidth,$this->thumbHeight,true,$thumb_uploadfile))
						$this->error .= 'Could not resize original image to ' . $this->thumbWidth . 'x' . $this->thumbHeight . ' ( Image ' . "[$cmdStatus] )";
				}*/
			}
		}
		if($this->error)
			$this->getOut();
		else {
			$this->setVars();
			return $this->fileName;
		}		
	}
	
	//smartResizeImage function used by uploadImage() function.  
	protected function smartResizeImage( $file, $width = 0, $height = 0, $proportional = false, $output = 'file')
	{
		//echo $file;
		if ( $height <= 0 && $width <= 0 ) {
			return false;
		}


		$info = getimagesize($file);
		$image = '';


		$final_width = 0;
		$final_height = 0;
		list($width_old, $height_old) = $info;

		if (
		$proportional) {
			if ($width == 0) $factor = $height/$height_old;
			elseif ($height == 0) $factor = $width/$width_old;
			else $factor = min ( $width / $width_old, $height / $height_old);


			$final_width = round ($width_old * $factor);
			$final_height = round ($height_old * $factor);

		}
		else {

			$final_width = ( $width <= 0 ) ? $width_old : $width;
			$final_height = ( $height <= 0 ) ? $height_old : $height;
		}

		switch (
		$info[2] ) {
			case IMAGETYPE_GIF:
				$image = imagecreatefromgif($file);
				break;
			case IMAGETYPE_JPEG:
				$image = imagecreatefromjpeg($file);
				break;
			case IMAGETYPE_PNG:
				$image = imagecreatefrompng($file);
				break;
			default:
				return false;
		}

		$image_resized = imagecreatetruecolor( $final_width, $final_height );

		if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
			$trnprt_indx = imagecolortransparent($image);

			// If we have a specific transparent color
			if ($trnprt_indx >= 0) {

				// Get the original image's transparent color's RGB values
				$trnprt_color    = imagecolorsforindex($image, $trnprt_indx);

				// Allocate the same color in the new image resource
				$trnprt_indx    = imagecolorallocate($image_resized, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);

				// Completely fill the background of the new image with allocated color.
				imagefill($image_resized, 0, 0, $trnprt_indx);

				// Set the background color for new image to transparent
				imagecolortransparent($image_resized, $trnprt_indx);


			}
			// Always make a transparent background color for PNGs that don't have one allocated already
			elseif ($info[2] == IMAGETYPE_PNG) {

				// Turn off transparency blending (temporarily)
				imagealphablending($image_resized, false);

				// Create a new transparent color for image
				$color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);

				// Completely fill the background of the new image with allocated color.
				imagefill($image_resized, 0, 0, $color);

				// Restore transparency blending
				imagesavealpha($image_resized, true);
			}
		}

		//echo $image_resized.' AND '.$image;
		imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $final_width, $final_height, $width_old, $height_old);

		/*if ( $delete_original ) {
			if ( $use_linux_commands )
			exec('rm '.$file);
			else
			@unlink($file);
		}*/

		switch ( strtolower($output) ) {
			case 'browser':
				$mime = image_type_to_mime_type($info[2]);
				header("Content-type: $mime");
				$output = NULL;
				break;
			case 'file':
				$output = $file;
				break;
			case 'return':
				return $image_resized;
				break;
			default:
				break;
		}

		switch (
		$info[2] ) {
			case IMAGETYPE_GIF:
				imagegif($image_resized, $output);
				break;
			case IMAGETYPE_JPEG:
				imagejpeg($image_resized, $output);
				break;
			case IMAGETYPE_PNG:
				imagepng($image_resized, $output);
				break;
			default:
				return false;
		}

		return
		true;
	}
	
	//if any upload error use this function. 
	protected function getOut(){
		$this->Session->setFlash(__($this->error, true));
		$this->setVars();
		$this->redirect('http://'.$_SERVER['HTTP_HOST'].$this->referer(array('controller'=>'admin', 'action' => 'index')));
	}

	////////////////////////////////////////////////////////////////
	//croping functions//
	
	//get image height. 
	public function getHeight($imagePath) {
		$sizes = getimagesize($imagePath);
		$height = $sizes[1];
		return $height;
	}
	
	//get image width. 
	public function getWidth($imagePath) {
		$sizes = getimagesize($imagePath);
		$width = $sizes[0];
		return $width;
	}
	
	public function cropImage($imagePath, $cropPath, $size, $x1, $y1, $x2, $y2, $w, $h){
		switch ($size){
			case 'thumb':
			$scale = $this->thumbWidth/$w;
			break;
			
			case 'medium':
			$scale = $this->mediumImageWidth/$w;
			break;
			
			case 'large':
			$scale = $this->largeImageWidth/$w;
			break;
		}
		$cropped = $this->resizeThumbnailImage($imagePath, $cropPath, $w, $h, $x1, $y1, $scale);
		return $cropped;
	}
	
	//ResizeImage function used by cropImage function. 
	protected function resizeThumbnailImage($imagePath, $thumbPath, $width, $height, $start_width, $start_height, $scale){
		$newImageWidth = ceil($width * $scale);
		$newImageHeight = ceil($height * $scale);
		$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
		$ext = strtolower(substr(basename($imagePath), strrpos(basename($imagePath), ".") + 1));
		if($ext == "png"){
			$source = imagecreatefrompng($imagePath);
		}elseif($ext == "jpg" || $ext == "jpeg"){
			$source = imagecreatefromjpeg($imagePath);
		}elseif($ext == "gif"){
			$source = imagecreatefromgif($imagePath);
		}
		imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
		if($ext == "png"){
			imagepng($newImage,$thumbPath,0);
		}elseif($ext == "jpg" || $ext == "jpeg"){
			imagejpeg($newImage,$thumbPath,90);
		}elseif($ext == "gif"){
			imagegif($newImage,$thumbPath);
		}
		chmod($thumbPath, 0777);
		return $thumbPath;
	}
		
}
?>