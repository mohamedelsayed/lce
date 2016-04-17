<?php if(!empty($record)){
	$search = '#(.*?)(?:href="https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch?.*?v=))([\w\-]{10,12}).*#x';
	$replace = 'http://www.youtube.com/embed/$2';
	$embed_url = preg_replace($search, $replace, $record['url']);?>
	<iframe 
		width="<?php echo $this->Session->read('Setting.video_width');?>" 
		height="<?php echo $this->Session->read('Setting.video_height');?>"
		src="<?php echo $embed_url;?>">
	</iframe>
<?php }?>