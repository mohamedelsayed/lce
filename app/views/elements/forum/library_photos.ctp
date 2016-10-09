<script src="<?php echo $base_url;?>/sliderengine/amazingslider.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>/sliderengine/amazingslider-1.css">
<script src="<?php echo $base_url;?>/sliderengine/initslider-1.js"></script> 
<div class="slide_galary">
    <div id="amazingslider-wrapper-1" style="display:block;position:relative;max-width:1200px;margin:0px auto 150px;">
        <div id="amazingslider-1" style="display:block;position:relative;margin:0 auto;">
            <ul class="amazingslider-slides" style="display:none;">
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
            <ul class="amazingslider-thumbnails" style="display:none;">
                <?php foreach ($sections_items as $key => $item) {
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
        </div>
    </div>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
    hideamazingsliderdiv();
});
function hideamazingsliderdiv () {
    jQuery('a').each(function(){ 
    	var hrefcode = 'http://amazingslider.com';
        var hrefdata = this.href;
        if(this.href.indexOf(hrefcode) !== -1){
            jQuery(this).parent('div').hide();            
        }
    });
}
</script>