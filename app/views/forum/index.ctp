<?php if(isset($slideshows)){
	echo $this->element('forum'.DS.'home_slider',array('slideshows'=> $slideshows));
}
if(isset($posts)){
	echo $this->element('forum'.DS.'home_marquee',array('posts'=> $posts));	
}?>