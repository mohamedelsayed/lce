jQuery(document).ready(function(){
	var btnUpload = jQuery('#uploadimage');
	var status = jQuery('#uploadimagestatus');
	jQuery("body").on("click", "#uploadimage", function(){
		jQuery('#uploadimageinput').click();
	});
	jQuery("body").on("change", "#uploadimageinput", function(){
		var file_data = jQuery('#uploadimageinput').prop('files')[0];   
	    var form_data = new FormData();                  
	    form_data.append('file', file_data);
	    var ext = file_data.name.split('.').pop();
	    var error = false;
	    if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
	    	status.text('Only JPG, PNG, GIF files are allowed');
	    	error = true;
	    }
	    if(!error){
		    jQuery.ajax({
		    	url: siteUrl+'/forum/uploadimage',  
		    	dataType: 'text',
		    	cache: false,
		    	contentType: false,
		    	processData: false,
		    	data: form_data, 
		    	type: 'post',
		    	 beforeSend: function() {
		    	 	jQuery("#uploadimage").hide();
					status.text('');
					status.addClass("ajaxloading");
				},
		    	success: function(response){
		    		var data = JSON.parse(response);				
					status.removeClass("ajaxloading");
					if(data.status === "success"){				
						jQuery("#uploadimagepath").val(data.file_path);
						var filename = data.file_name;
						var file_path = data.file_path;
						var file_ext = filename.split('.').pop();
						var image_item = draw_image_item(data.file_name);
						jQuery("#uploadimagestatus").html(image_item);
					} else{
						jQuery("#uploadimage").show();
						jQuery("#uploadimagestatus").html('<div class="image-upload-item error">'+data.file_name+'</div>');
					}		    	
				}
			});
		}
	});
	jQuery("body").on("click", ".removeuploadimagebtn", function(){
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
		        		jQuery("#uploadimagepath").val("");
		        		jQuery("#uploadimagestatus").html('');
		        		jQuery("#uploadimage").show();
		        	}
				}
			});
		}else{
			jQuery("#uploadimagepath").val("");
			jQuery("#uploadimagestatus").html('');
			jQuery("#uploadimage").show();
		}
	});
});
function draw_image_item(img_src){
	var removebtn = '<div class="removeuploadimagebtn last" path="'+img_src+'">X</div>';
	var data = '<div class="image-upload-item"><img src="'+siteUrl+'/'+imgPath+img_src+'" alt="'+img_src+'" />'+removebtn+'</div>';
	return data;  
}