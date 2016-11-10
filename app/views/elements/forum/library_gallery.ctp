<?php if(!empty($library['Gal'])){?>
	<div class="home_slider_wapper">
		<ul class="bxslider">
            <?php $j = 0;
			$limit = 2;
			//$rest_images = array();
            foreach ($library['Gal'] as $key => $value) {
            	$image = $value['url'];
            	if($j++ >= $limit){
            		$file_link = get_google_image_link($image);
            		//$rest_images[] = $file_link; ?>
            		<input id="rest_images_<?php echo $j;?>" type="hidden" data-img="<?php echo $file_link;?>" data-j="<?php echo $j;?>">
            	<?php }else{?>
	                <li>
	                	<?php echo $this->element('forum/embed_google_image', array('file' => $image));?>
	                </li>
	            <?php }?>
            <?php }?>
        </ul>
        <div id="bx-pager">
        	<?php $i = 0;
        	$j = 0;
        	foreach ($library['Gal'] as $key => $value) {
        		if($j++ >= $limit){
            		break;
            	} 
                $image = $value['url'];?>
                <a data-slide-index="<?php echo $i++;?>" style="cursor: pointer;">
                	<?php echo $this->element('forum/embed_google_image', array('file' => $image));?>
            	</a>
        	<?php }?>
        	<a class="load_more_images">load more</a>
		</div>
    </div>      
<?php }?>
<?php //$rest_images_json = json_encode($rest_images);?>   
<script type="text/javascript">
<?php /*var rest_images = '<?php echo $rest_images_json;?>';*/?>
var j = <?php echo $j;?>;
var limit = <?php echo $limit;?>;
var slider = jQuery('.bxslider').bxSlider({
	//adaptiveHeight: true,
  	mode: 'horizontal',
  	auto: true,
  	autoControls: true,
  	pagerCustom: '#bx-pager',
  	//minSlides: 5,
  	//maxSlides: 5,
  	//slideWidth:100
});
jQuery(document).ready(function(){
	jQuery("body").on("click",".load_more_images", function(e){
		e.preventDefault();
		for (i = j; i < j+limit; i++) { 
			var obj = jQuery('#rest_images_'+i);
			//console.log(i);
			var data_img = obj.data('img');
			var data_j = obj.data('j');
			//console.log(data_img);
			//console.log(data_j);
  			jQuery('.bxslider').append('<li><img class="embed_google_image" src="'+data_img+'"></li>');
  			jQuery('<a data-slide-index="'+data_j+'" style="cursor: pointer;"><img class="embed_google_image" src="'+data_img+'"></a>').insertBefore('.load_more_images');
  		}
  		slider.reloadSlider({
  			mode: 'horizontal',
		  	auto: true,
		  	autoControls: true,
		  	pagerCustom: '#bx-pager',
  		});
  		j = j + limit;
	});
});
</script>
<style type="text/css">
.bx-controls{
	display: none;
}
.bx-wrapper img{
	max-height: 400px;
	width: auto;
	margin-left: auto;
	margin-right: auto;
}
ul.bxslider{
	margin: 0px;
	padding: 0px;
}
</style>