jQuery(document).ready(function(){
	var btnUpload = jQuery('#uploadvideo');
	var status = jQuery('#uploadvideostatus');
	jQuery("body").on("click", "#uploadvideo", function(){
		jQuery('#uploadvideoinput').click();
	});
	jQuery("body").on("change", "#uploadvideoinput", function(){
		var file_data = jQuery('#uploadvideoinput').prop('files')[0];   
	    var form_data = new FormData();                  
	    form_data.append('file', file_data);
	    var ext = file_data.name.split('.').pop();
	    var error = false;
	    if (! (ext && /^(flv)$/.test(ext))){ 
	    	status.text('Only FLV files are allowed');
	    	error = true;
	    }
	    if(!error){
		    jQuery.ajax({
		    	url: siteUrl+'/forum/uploadfile',  
		    	dataType: 'text',
		    	cache: false,
		    	contentType: false,
		    	processData: false,
		    	data: form_data, 
		    	type: 'post',
		    	 beforeSend: function() {
		    	 	jQuery("#uploadvideo").hide();
					status.text('');
					status.addClass("ajaxloading");
				},
		    	success: function(response){
		    		var data = JSON.parse(response);				
					status.removeClass("ajaxloading");
					if(data.status === "success"){				
						jQuery("#uploadvideopath").val(data.file_path);
						var video_item = draw_video_item(data.file_path);
						jQuery("#uploadvideostatus").html(video_item);					
					} else{
						jQuery("#uploadvideo").show();
						jQuery("#uploadvideostatus").html('<div class="video-upload-item error">'+data.file_name+'</div>');
					}		    	
				}
			});
		}
	});
	jQuery("body").on("click", ".removeuploadvideobtn", function(){
	 	var path = jQuery(this).attr("path");
	 	var obj = jQuery(this);
	 	if(path != ''){
		 	jQuery.ajax({
		 		type: "POST",
		        url: siteUrl+'/forum/removefile',
				data: {path:path},
		        beforeSend: function(){
		    	},
		        success: function(response){	
		        	var data = JSON.parse(response);
		        	if(data.status === "success"){
		        		jQuery("#uploadvideopath").val("");
		        		jQuery("#uploadvideostatus").html('');
		        		jQuery("#uploadvideo").show();
		        	}
				}
			});
		}else{
			jQuery("#uploadvideopath").val("");
			jQuery("#uploadvideostatus").html('');
			jQuery("#uploadvideo").show();
		}
	});
});
function draw_video_item(video_path){
	var removebtn = '<div class="removeuploadvideobtn last" path="'+video+'">X</div>';
	var video = siteUrl+'/'+filesPath+video_path;
	var video_tag = "<object><embed type='application/x-shockwave-flash' src='"+flv_player_src+"' width='100%' height='100%' allowscriptaccess='always' allowfullscreen='true' 	wmode='transparent' flashvars='file="+video+"&image="+flv_player_imagePath+"&skin="+flv_player_skinPath+"' onload='myfunction()' /></object>";
	var data = '<div class="video-upload-item"><div class="flv-video">'+video_tag+'</div>'+removebtn+'</div>';			
	return data;  
}