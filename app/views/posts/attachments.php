<div class="input file">
    <?php /*<label for="attachementsfiles">Attachement:</label>*/?>
    <input class="hiddeninputbutton" type="file" id="attachementsfiles" multiple="multiple" name="attachements[]">
    <button type="button" id="uploadattachement" class="uploadattachement">Upload Attachement</button>
    <div id="ajaxLoading"></div>
    <div class="attachementsfilesmessage"></div> 
    <div class="attachements_wrapper uploadstatus"><?php echo $attachements_div;?></div>       
</div>

<script type="text/javascript">
var base_url = siteUrl;
jQuery(document).ready(function(){
	jQuery("body").on("click", "#uploadattachement", function(){
		jQuery('#attachementsfiles').click();
	});	
	jQuery('#attachementsfiles').on('change',function(){
		var status = jQuery('.attachementsfilesmessage');
		var error = false;
		jQuery(".attachementsfilesmessage").html("");
		var my_files = this.files;
        var index;        
        for (index = 0; index < my_files.length; ++index) {
        	var file_data = my_files[index];
            var name = file_data.name;
            var ext = name.substr(name.lastIndexOf('.') + 1);  
            var form_data = new FormData();
            form_data.append('file', file_data);
            var ext = ext.toLowerCase();
            if (! (ext && /^(pdf|doc|docx|xls|xlsx|ppt|pptx|jpg|png|jpeg|gif)$/.test(ext))){
				status.text('Only PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, JPG, PNG, GIF files are allowed');
				error = true;
			}
			if(!error){ 
		    	jQuery.ajax({
		    		url: base_url+'/forum/upload_file',
	                type: 'POST',
	                data: form_data,
	                //async: false,
	                cache: false,
	                contentType: false,
	                processData: false,
	                beforeSend: function(){
                    jQuery('#ajaxLoading').show(); 
                	},
                	success:function(result){    
                		jQuery('#ajaxLoading').hide();
                    	jQuery('.attachements_wrapper').append(result);
                	}
				});            
        	}
		}
		jQuery('#attachementsfiles').val('');
    });
    jQuery("body").on("click", ".removeuploadattachementbtn", function () {
    	var y = confirm('Are you sure you want to delete this attachement?');
        if(y){
            jQuery(this).closest('div.common-file-post').remove();
        }
    });
});
</script>
<style type="text/css">
#ajaxLoading{
    display:none;   
    width: 80px;
    height:15px;
    background-image: url(<?php echo $base_url.'/img/front/tloading.gif'?>);
    background-repeat: no-repeat;
    clear: left;
    margin-top: 10px;
}
.attachement_wrap .caption, .attachement_wrap .cover, .attachement_wrap .delete{
    float: left;
    width: 50%;
    clear: none;
}
.attachement_wrap .img_item{
    float: left;
    width: 35%;    
    clear: none;
}
.attachement_wrap .delete{
    margin-left: 10px;
}
.attachement_wrap{
    float: none;
    width:100%;
    max-height:250px;
    overflow: hidden;
}
</style>