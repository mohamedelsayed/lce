<div class="input text">
	<label for="Gallery">Gallery</label>
	<ul id="gallery_result" class="autocomplete_ul_result gallery_result">
		<?php foreach ($gallery as $key => $value) {
			if(in_array($key, $saved_gallery)){?>
				<li class="itemli" id="sitemli<?php echo $key;?>"><h5><?php echo $value;?></h5>
				<a userid="<?php echo $key;?>" class="removeuser removeusers">x</a></li>
			<?php }?>
		<?php }?>
	</ul>
	<input type="hidden" name="gallery_ids" id="gallery_ids" value="<?php echo $saved_gallery_text;?>" />
	<input type="text" id="" name="gallery_id">
</div>