<script src="<?php echo $base_url;?>/album_slider/sliderengine/amazingslider.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>/album_slider/sliderengine/amazingslider-1.css">
<script src="<?php echo $base_url;?>/album_slider/sliderengine/initslider-1.js"></script>        
<?php if(!empty($library['Gal'])){
	$j = 0;
	$limit = 2;
	$k = 0;?>
	<div class="home_slider_wapper">
		<div class="slide_galary">
            <div id="amazingslider-wrapper-1" style="display:block;position:relative;max-width:1200px;margin:0px auto 130px;">
                <div id="amazingslider-1" style="display:block;position:relative;margin:0 auto;">
                    <ul class="amazingslider-slides" style="display:none;">
                    	<?php $j = 0;
                    	foreach ($library['Gal'] as $key => $value) {
			            	$image = $value['url'];
							$file_link = get_google_image_link($image);
							$additional_attributes = '';
							$additional_class = '';
			            	if($j >= $limit){?>
			            		<?php $additional_attributes = ' data-src="'.$file_link.'" ';
								$additional_class = 'rest_images_'.$j;
								$file_link = DEFAULT_IMAGE;
							}
							$j++;?>
			                <li>
			                	<?php if($file_link != ''){?>
									<img <?php echo $additional_attributes;?> class="embed_google_image <?php echo $additional_class;?>" src="<?php echo $file_link;?>" />
								<?php }?>
			                </li>			                
		                <?php }?>
                    </ul>
                    <ul class="amazingslider-thumbnails" style="display:none;">
                        <?php $j = 0;
                        foreach ($library['Gal'] as $key => $value) {
                        	$image = $value['url'];
                        	$file_link = get_google_image_link($image);
                        	if($j++ >= $limit){                        		
                        		$file_link = DEFAULT_IMAGE;
			            	}else{
			            		$k = $j;
			            	} ?>
                            <li>
                            	<?php if($file_link != ''){?>
									<img class="embed_google_image rest_images_thumb<?php echo $j;?>" src="<?php echo $file_link;?>" />
								<?php }?>
                            </li>                            
                        <?php }?>                        
                    </ul>                    
                </div>
            </div>
            <?php /*<div class="load_more_images_div">
            	<img class="load_more_images" src="<?php echo $base_url.'/img/forum/more_with_arrow.png';?>" />                        
            </div>*/?>
        </div>        	
    </div>      
<?php }else{?>
    <div class="no-data-found">No data found.</div>
<?php }?>
<script type="text/javascript">
var j = <?php echo $k;?>;
var limit = <?php echo $limit;?>;
jQuery(document).ready(function(){
	/*jQuery("body").on("click",".load_more_images", function(e){
		e.preventDefault();
		for (i = j; i < j+limit; i++) { 
			var obj = jQuery('#rest_images_'+i);
			var data_img = obj.data('img');
			var data_j = obj.data('j');
			if(data_img == 'undefined'){
				jQuery('.load_more_images').hide();
			}else{
	  			jQuery('.amazingslider-slides').append('<li><img class="embed_google_image" src="'+data_img+'"></li>');
	  			jQuery('.amazingslider-thumbnails').append('<li><img class="embed_google_image" src="'+data_img+'"></li>');
	  			obj.remove();
	  		}
  		j = j + limit;
	});*/
    hideamazingsliderdiv();
    custom_load_image(j); 			
});
function custom_load_image(k){
	console.log(k);
	var obj = jQuery('.rest_images_'+k);
	if (obj.length) {		
		var src = obj.data('src');
		obj.attr('src', src);
		jQuery('.rest_images_thumb'+k).attr('src', src);
		console.log(j);
		console.log(src);
		obj.bind('load', function() {
			//console.log('done');
			j = k + 1;
			custom_load_image(j) 			
		});
	}
}
function hideamazingsliderdiv () {
    jQuery('a').each(function(){ 
		var hrefcode = 'http://amazingslider.com';
        var hrefdata = this.href;
        if(this.href.indexOf(hrefcode) !== -1){
            $(this).parent('div').hide();            
        }
    });
}
</script>
<style type="text/css">
h2{
	margin: 0;
	margin-bottom: 5px;
	padding: 0px;
}
.amazingslider-img-elem-1{
	height: 450px !important;
	width: auto !important;
	margin: auto;
	/*top:150px !important;*/
	margin-left: auto !important;
	margin-right: auto !important;
	display:block !important;
    margin:auto !important;
    position: inherit !important;
    position: absolute !important;
    margin: auto !important;
    top: 0 !important;
    left: 0 !important;
    right: 0 !important;
    bottom: 0 !important;
}
</style>