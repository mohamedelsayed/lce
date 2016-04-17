<?php if($video != ''){
	//if($this->action == 'edit')$delete = true; else $delete = false;
	$imagePath = $settings['url'].'/app/webroot/img/backend/no_image.jpeg';
	//$imagePath = $settings['url'].'/app/webroot/img/upload/'.$video['image'];
	$videoPath = $settings['url'].'/app/webroot/files/upload/'.$video;
	$src = $settings['url'].'/app/webroot/files/flv_player/player.swf';
	$skinPath = $settings['url'].'/app/webroot/files/flv_player/skins/fs40/fs40.xml'; 
	//echo '<div>'.$video['title'].'</div>';		
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
}?>