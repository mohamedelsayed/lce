<?php if(!empty($video)){?>
	<script type="text/javascript">
    	$(document).ready(function(){
			updateVideoHits('<?php echo $video['id'];?>', '<?php echo $base_url;?>');
		});
    </script>
	<?php    
	if($this->action == 'edit')$delete = true; else $delete = false;
	//$imagePath = ($video['image']!='')?$base_url.'/app/webroot/img/upload/'.$video['image']:$base_url.'/app/webroot/img/backend/no_image.jpeg';
	$imagePath = $base_url.'/app/webroot/img/upload/'.$video['image'];
	if($video['image'] == '' ){
		$imagePath = $base_url.'/app/webroot/img/backend/no_image.jpeg/';			
	}
	$videoPath = $base_url.'/app/webroot/files/upload/'.$video['file'];
	$src = $base_url.'/app/webroot/files/flv_player/player.swf';
	$skinPath = $base_url.'/app/webroot/files/flv_player/skins/fs40/fs40.xml'; 
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
			if(isset($controller))	{
				echo $this->Html->link(__('Delete video', true), array('controller' => $controller.'/deleteVideo/'.$video['id']), null, __('Are you sure you want to delete this video?', true));
			}else{
				//echo __("Can't Del", true);
			}
		echo '</div>';
	}		
}else{
	echo __('No Video', true);
} 	 