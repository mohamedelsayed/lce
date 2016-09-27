jQuery(document).ready(function(){
	var btnUpload = jQuery('#uploadattachement');
	var status = jQuery('#uploadattachementstatus');
	jQuery("body").on("click", "#uploadattachement", function(){
		jQuery('#uploadattachementinput').click();
	});
	jQuery("body").on("change", "#uploadattachementinput", function(){
		var file_data = jQuery('#uploadattachementinput').prop('files')[0];   
	    var form_data = new FormData();                  
	    form_data.append('file', file_data);
	    var ext = file_data.name.split('.').pop();
	    var error = false;
	     if (! (ext && /^(pdf|doc|docx|xls|xlsx|ppt|pptx|jpg|png|jpeg|gif)$/.test(ext))){ 
            // extension is not allowed 
			status.text('Only PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, JPG, PNG, GIF files are allowed');
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
		    	 	jQuery("#uploadattachement").hide();
					status.text('');
					status.addClass("ajaxloading");
				},
		    	success: function(response){
		    		var data = JSON.parse(response);				
					status.removeClass("ajaxloading");
					if(data.status === "success"){				
						jQuery("#uploadattachementpath").val(data.file_path);
						var attachement_item = draw_attachement_item(data.file_path);
						jQuery("#uploadattachementstatus").html(attachement_item);
					} else{
						jQuery("#uploadattachement").show();
						jQuery("#uploadattachementstatus").html('<div class="error">Error</div>');
					}		    	
				}
			});
		}
	});
	jQuery("body").on("click", ".removeuploadattachementbtn", function(){
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
		        		jQuery("#uploadattachementpath").val("");
		        		jQuery("#uploadattachementstatus").html('');
		        		jQuery("#uploadattachement").show();
		        	}
				}
			});
		}else{
			jQuery("#uploadattachementpath").val("");
			jQuery("#uploadattachementstatus").html('');
			jQuery("#uploadattachement").show();
		}
	});
});
function draw_attachement_item(attachement_path){
	var removebtn = '<div class="removeuploadattachementbtn last" path="'+attachement_path+'">X</div>';
	var filename = attachement_path;
	var file_path = attachement_path;
	var file_ext = filename.split('.').pop();
	var file_class = file_ext+'-file';
	var file_link = siteUrl+'/'+filesPath+file_path;
	var data = '<div class="'+file_class+'"><a target="_blank" href="'+file_link+'" >'+filename+"</a>"+removebtn+'</div>';
	return data;  
}