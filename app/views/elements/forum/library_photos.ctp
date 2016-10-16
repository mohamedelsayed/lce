<div class="home_slider_wapper">
	<ul class="bxslider">
	    <?php foreach ($sections_items as $k => $item) {
	    	if($item['Library']['title'] != ''){
				$title = $item['Library']['title'];
			}
			$file_link = '';
			$google_drive_url = '';
			if($item['Library']['file'] != ''){
				$file_link = BASE_URL."/app/webroot/files/upload/".$item['Library']['file'];
			}elseif($item['Library']['google_drive_url'] != ''){
				$google_drive_url = $item['Library']['google_drive_url'];	
			}
			if($file_link != ''){
				$html = '<img alt="'.$title.'" class="embed_google_image" src="'.$file_link.'" />';
	    	}elseif($google_drive_url != ''){
	    		$html = $this->element('forum/embed_google_image', array('file' => $google_drive_url));				                            		
			}?>
	        <li>
	        	<?php echo $html;?>
	        </li>
	    <?php }?>
	</ul>
    <div id="bx-pager">
    	<?php $i = 0;
    	foreach ($sections_items as $k => $item) {
    		if($item['Library']['title'] != ''){
				$title = $item['Library']['title'];
			}
			$file_link = '';
			$google_drive_url = '';
			if($item['Library']['file'] != ''){
				$file_link = BASE_URL."/app/webroot/files/upload/".$item['Library']['file'];
			}elseif($item['Library']['google_drive_url'] != ''){
				$google_drive_url = $item['Library']['google_drive_url'];	
			}
			if($file_link != ''){
				$html = '<img alt="'.$title.'" class="embed_google_image" src="'.$file_link.'" />';
	    	}elseif($google_drive_url != ''){
	    		$html = $this->element('forum/embed_google_image', array('file' => $google_drive_url));				                            		
			}?>
			<div class="slider_image_in">
	            <a data-slide-index="<?php echo $i++;?>" style="cursor: pointer;">
	            	<?php echo $html;?>
	        	</a>
        	</div>
    	<?php }?>
	</div>
</div>
<script type="text/javascript">
jQuery('.bxslider').bxSlider({
	adaptiveHeight: true,
  	mode: 'horizontal',
  	auto: true,
  	autoControls: true,
  	pagerCustom: '#bx-pager',
});
</script>
<style type="text/css">
	.bx-controls{
		display: none;
	}
</style>