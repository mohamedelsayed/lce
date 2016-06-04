<div id="mesagepopboxcontactmepopoup" class="mesage-pop" >
    <div class="mesagecontent">
    	<h4>
            <span class="contactme_popup_title">Contact Me</span>
            <div class="closepopoup">X</div>
        </h4>
        <div class="contactme_popuppopoupbody">
        	<form id="contactme_popup_form" action="<?php echo $base_url;?>" method="post" accept-charset="UTF-8" enctype="multipart/form-data" onsubmit="return validate_contactme_form(jQuery(this));">
	            <div class="form_item">
	                <input id="contactme_popup_form_first_name" class="form_text" type="text" name="first_name" placeholder="First Name" />    
	            </div>
	            <div class="form_item">
	                <input id="contactme_popup_form_last_name" class="form_text" type="text" name="last_name" placeholder="Last Name" />    
	            </div>
	            <div class="form_item">
	                <input id="contactme_popup_form_email" class="form_text" type="text" name="email" placeholder="Email" />    
	            </div>
	            <div class="form_item">
	            	<textarea id="contactme_popup_form_message" class="form_text" name="message" placeholder="message" ></textarea>
	            </div>
	            <div class="form_item">
	            	<input type="submit" class="form_contactme_submit" value="Submit" />
	            </div>	            
	            <input type="hidden" id="contactme_coach_id" name="coach_id" value="0">
	        </form>
	    </div>	    	
    </div>
    <div class="mesage-pop-bg"></div>
</div>
<script type="text/javascript">
	function validate_contactme_form(obj) {		
	var form_id = obj.attr('id');
	validate_required_input(jQuery('#contactme_popup_form_first_name'));
	validate_required_input(jQuery('#contactme_popup_form_last_name'));
	validate_email_input(jQuery('#contactme_popup_form_email'));
	validate_required_input(jQuery('#contactme_popup_form_message'));	
	var contactme_form_flag = 0;
	var focused = 0;
	jQuery('#'+form_id+' input').each(function(){
		if(jQuery(this).hasClass('error')){ 
			contactme_form_flag = 1;
			if(focused == 0){
	    		focused = 1;
		    	jQuery(this).focus();
		    }
		}
	});
	if(contactme_form_flag === 0){
		return true;
	}else{
		return false;
	}   	
}
function contact_me(id){   
	jQuery('#contactme_coach_id').val(id);
	jQuery("#mesagepopboxcontactmepopoup").show();	
}
</script>