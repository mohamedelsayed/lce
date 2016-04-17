<?php
	if(!empty($video)){?>
    	<script type="text/javascript">
        	$(document).ready(function(){
				updateVideoHits('<?=$video['id'];?>', '<?=$this->Session->read('Setting.url');?>');
			});
        </script>
		<?php    
		if($this->action == 'edit')$delete = true; else $delete = false;
		//$imagePath = ($video['image']!='')?$this->Session->read('Setting.url').'/app/webroot/img/upload/'.$video['image']:$this->Session->read('Setting.url').'/app/webroot/img/backend/no_image.jpeg';
		$imagePath = $this->Session->read('Setting.url').'/app/webroot/img/upload/'.$video['image'];
		$videoPath = $this->Session->read('Setting.url').'/app/webroot/files/upload/'.$video['file'];
		$src = $this->Session->read('Setting.url').'/app/webroot/files/flv_player/player.swf';
		$skinPath = $this->Session->read('Setting.url').'/app/webroot/files/flv_player/skins/fs40/fs40.xml'; 
		echo '<div>'.$video['title'].'</div>';		
		echo "<object>
				<embed
					type='application/x-shockwave-flash'
					src='$src' 
					width='$width' 
					height='$height'
					allowscriptaccess='always' 
					allowfullscreen='true'
					wmode='transparent'
					flashvars='file=$videoPath&image=$imagePath&skin=$skinPath' 
					onload='myfunction()'
				/>
			  </object>";
		if($delete){			
			echo '<div class = "delete">';	
				if(isset($controller))	
					echo $this->Html->link(__('Delete video', true), array('controller' => $controller.'/deleteVideo/'.$video['id']), null, __('Are you sure you want to delete this video?', true));
				else 
					echo __("Can't Del", true);
			echo '</div>';
		}		
	}
	else{
		echo __('No Video', true);
	} 	 
?>