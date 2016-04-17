<script type="text/javascript">
	$(document).ready(function() {
		$(".lightbox").lightBox('<?php echo $this->Session->read('Setting.url'); ?>');
	});
</script>
<?php
	if(!empty($image)){
		echo $this->Html->css('lightbox/jquery.lightbox', null, array('inline'=>false));
		echo $this->Javascript->link('lightbox/jquery.lightbox.js', false);
		
		if(!isset($delete)){
			if($this->action == 'edit')
				$delete = true; 
			else 
				$delete = false;
		}
		$width = $height = null;
		$imgStyle = "max-width: ".$this->Session->read('Setting.thumb_width').";max-height: ". $this->Session->read('Setting.thumb_height').";";
		if($image['image']!=''){	
			$size = (isset($size))?$size.'_':'thumb_';
			$imagePath = 'upload/'.$image['image'];
			if($size == "master_"){
				$thumbPath = $imagePath;
			}else{	
				$thumbPath = 'upload/'.$size.$image['image'];
				$width  = $this->Session->read('Setting.'.$size.'width');
				$height = $this->Session->read('Setting.'.$size.'height');
			}
		}
		else{
			$thumbPath = 'backend/thumb_no_image.jpeg';
			$imagePath = 'backend/no_image.jpeg';
			$delete = false;
		}
		echo $this->Html->link(
			$this->Html->image($thumbPath, array('title'=> __('Click to enlarge', true), 'border' => '0', 'width'=>$width, 'height'=>$height)), 
			$this->Session->read('Setting.url').'/img/'.$imagePath,
			array('target' => '_blank', 'escape' => false, 'class'=>'lightbox', 'title'=>isset($image['caption'])?$image['caption']:'', 'rel'=>'group1'));
		if($delete){			
			echo '<div class = "delete">';
			$controller = isset($controller)?$controller:strtolower($this->name);
			$fieldName = isset($fieldName)?$fieldName:'';	
			echo $this->Html->link(__('Delete', true), array('controller' => $controller.'/deleteImage/'.$image['id'].'/'.$fieldName), null, __('Are you sure you want to delete this image?', true));
			echo '&nbsp;|&nbsp;';
			echo $this->Html->link(__('Crop', true), array('controller' => 'images', 'action'=>'view', $image['image'].'/thumb'));		
			echo '</div>';
		}	
	}
	else echo __('No image', true);	 
?>