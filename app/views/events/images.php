<div class="input text input_fields_wrap">
	<label for="Gallery">Gallery</label>
	<button class="add_field_button" style="float: none;margin: 10px;">Add More</button>
	<?php $i = 0;
	$remove_button_image = '<img class="remove_button_image" src="'.$base_url.'/img/forum/close_red.png"/>';
	$remove_button = '<a class="remove_field">'.$remove_button_image.'</a>';?>
	<div class="data_gal_url_input_form">
		<input type="text" name="data[Gal][][url]">
		<?php if($i++ > 0){
			echo $remove_button;
		}?>
	</div>	
</div>
<div>
	<?php $i = 0;
	$remove_button = '<a class="remove_field"><img src="'.$base_url.'/img/forum/close_red.png"/></a>';
	if($this->data['Gal']){
		foreach ($this->data['Gal'] as $key => $value) {
			$url = '';
			if(isset($value['url'])){
				$url = $value['url'];
			}
			if($url != ''){?>				
				<div class="data_gal_url_image_view">
					<?php echo $this->element('forum/embed_google_image', array('file' => $url));?>
					<a onclick="return confirm('Are you sure you want to delete this image?');" href="<?php echo $base_url.'/events/deleteImageGal/'.$value['id']?>"><?php echo $remove_button_image;?></a>
				</div>
			<?php }			
		}		
	}?>
</div>
<script type="text/javascript">
jQuery(document).ready(function() {
	var max_fields      = 100; //maximum input boxes allowed
    var wrapper         = jQuery(".input_fields_wrap"); //Fields wrapper
    var add_button      = jQuery(".add_field_button"); //Add button ID   
    var x = 1; //initlal text box count
    jQuery(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            jQuery(wrapper).append('<div class="data_gal_url_input_form"><input type="text" name="data[Gal][][url]"/><?php echo $remove_button;?></div>'); //add input box
        }
    });   
    jQuery(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); jQuery(this).parent('div').remove(); x--;
    })
});
</script>