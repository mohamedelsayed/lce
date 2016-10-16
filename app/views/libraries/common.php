<?php if($type1 != 4){?>
	<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery("body").on("change","#LibraryType2", function(){
			var type = jQuery(this).val(); 
	    	var youtube_url = jQuery('#LibraryYoutubeUrl');
	    	var google_drive_url = jQuery('#LibraryGoogleDriveUrl');
	    	if(type == 5){    		
	    		youtube_url.parent().show();
	    		google_drive_url.parent().hide();
	    	}else{
	    		youtube_url.parent().hide();
	    		google_drive_url.parent().show();    		
	    	}
	    });
	});
	jQuery(window).load(function(){
		jQuery("#LibraryType2").change();
	});	
	</script>
<?php }?>