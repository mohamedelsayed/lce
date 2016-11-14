<?php $image_loading_src = BASE_URL.'/img/forum/loading_album.gif';
if(!empty($library['Gal'])){?>
	<div class="home_slider_wapper">
		<ul class="bxslider">
            <?php $j = 0;
			$limit = 1;
			foreach ($library['Gal'] as $key => $value) {
            	$image = $value['url'];
				$file_link = get_google_image_link($image);
				$additional_attributes = '';
				$additional_class = '';
            	if($j >= $limit){?>
            		<?php $additional_attributes = ' data-src="'.$file_link.'" ';
					$additional_class = ' rest_images_'.$j;
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
        <a class="prev_arrow_div">
        	<?php echo $this->Html->Image('forum/prev_arrow.jpg', array('border'=>'0'));?>
        </a>
        <div class="thumb_wapper_out">
	        <div id="bx-pager" class="bx_pager">
	        	<?php $i = 0;
	        	$j = 0;
				$count = count($library['Gal']);
	        	foreach ($library['Gal'] as $key => $value) {
	        		$image = $value['url'];
	            	$file_link = get_google_image_link($image);
					$additional_class = '';
	            	if($j >= $limit){                        		
	            		$file_link = DEFAULT_IMAGE;
						$additional_class = ' rest_images_thumb'.$j;
	            	}else{
	            		$k = $j + 1;
	            	}
					$j++; ?>
	                <a data-slide-index="<?php echo $i++;?>" style="cursor: pointer;">
	                	<?php if($file_link != ''){?>
							<img class="embed_google_image <?php echo $additional_class;?>" src="<?php echo $file_link;?>" />
						<?php }?>
	            	</a>
	        	<?php }?>
        	</div>
		</div>
		<a class="next_arrow_div">
			<?php echo $this->Html->Image('forum/next_arrow.jpg', array('border'=>'0'));?>
		</a>
    </div>      
<?php }?>
<?php $thumbs_div_width = $count * 170;?>
<script type="text/javascript">
var j = <?php echo $k;?>;
var thumbs_div_width = <?php echo $thumbs_div_width;?>;
var thumbs_div_width_minus = -thumbs_div_width;
var image_loading_src = '<?php echo $image_loading_src;?>';
var slider = jQuery('.bxslider').bxSlider({
	//adaptiveHeight: true,
	controls: true,
  	mode: 'horizontal',
  	auto: true,
  	autoControls: true,
  	pagerCustom: '#bx-pager',
  	speed: 8000,
  	//minSlides: 5,
  	//maxSlides: 5,
  	//slideWidth:100,
});
jQuery(document).ready(function(){
	custom_load_image(j); 
	var slide_thumb = jQuery(".bx_pager");
	var tolerance = 300;
	jQuery("body").on("click", ".next_arrow_div", function () {		
		var left = slide_thumb.css('left');
		var left = left.replace('px','');
		if(left == 'auto'){
			left = 0;
		}
		var new_left = left - tolerance;
		//console.log(left);
		//console.log(new_left);
		if(new_left >= thumbs_div_width_minus && new_left <= 0){
			slide_thumb.animate({left: new_left+'px'}, {queue: false, duration: 500});
		}
    });
    jQuery("body").on("click", ".prev_arrow_div", function () {
    	var left = slide_thumb.css('left');
		var left = left.replace('px','');
		if(left == 'auto'){
			left = 0;
		}
		var new_left = parseInt(left) + tolerance;
		//console.log(left);
		//console.log(new_left);
		if(new_left >= thumbs_div_width_minus && new_left <= 0){
			slide_thumb.animate({left: new_left+'px'}, {queue: false, duration: 500});
		}
    });
});
function custom_load_image(k){
	var obj = jQuery('.rest_images_'+k);
	if (obj.length) {		
		var src = obj.data('src');
		obj.attr('src', src);
		jQuery('.rest_images_thumb'+k).attr('src', image_loading_src);		
		//if(k < 5){	
		obj.bind('load', function() {
			jQuery('.rest_images_thumb'+k).attr('src', src);
			j = k + 1;
			custom_load_image(j) 			
		});
		//}
	}
}
</script>
<style type="text/css">
.bx-controls{
	display: block;
}
.bx-wrapper img{
	max-height: 400px;
	min-height: 400px;
	width: auto;
	margin-left: auto;
	margin-right: auto;
}
ul.bxslider{
	margin: 0px;
	padding: 0px;
}
h2{
	margin: 0;
	margin-bottom: 5px;
	padding: 0px;
}
.prev_arrow_div, .next_arrow_div{
	width: 10%;
	height: 100px;
	float: left;
	cursor: pointer;
}
.prev_arrow_div img, .next_arrow_div img{
	height: 100%;
}
#bx-pager{
	width: <?php echo $thumbs_div_width;?>px;
	float: left;
	overflow: auto;
	position: relative;
}
.bx_pager a{
	display: inline;
    float: left;
    margin-right: 10px;
    width: 160px;
}
.thumb_wapper_out{
	width: 80%;
	float: left;
	overflow: hidden;
}
</style>