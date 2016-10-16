<?php if(isset($slideshows)){
	echo $this->element('forum'.DS.'home'.DS.'slider',array('slideshows'=> $slideshows));
}
if(isset($posts)){
	echo $this->element('forum'.DS.'home'.DS.'marquee',array('posts'=> $posts));
}?>
<div class="home_bottom_items">
	<div class="home_bottom_left_items">
		<?php if(isset($welcome_note)){
			echo $this->element('forum'.DS.'home'.DS.'welcome_note',array('welcome_note'=> $welcome_note));	
		}?>
		<?php if(isset($recent_activities)){
			echo $this->element('forum'.DS.'home'.DS.'recent_activities',array('recent_activities'=> $recent_activities));
		}?>
	</div>
	<div class="home_bottom_right_items">
		<?php if(isset($happening_now)){
			echo $this->element('forum'.DS.'home'.DS.'happening_now',array('happening_now'=> $happening_now));
		}?>
		<?php echo $this->element('forum'.DS.'home'.DS.'calendar',array('event' => $event));?>
	</div>
</div>