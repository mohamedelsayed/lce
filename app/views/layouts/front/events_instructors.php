<div id="mesagepopboxinstructorpopoup" class="mesage-pop" >
    <div class="mesagecontent"></div>
    <div class="mesage-pop-bg"></div>
</div>
<div id="mesagepopboxeventpopoup" class="mesage-pop" >
    <div class="mesagecontent"></div>
    <div class="mesage-pop-bg"></div>
</div>
<div id="mesagepopboxcheckoutpopoup" class="mesage-pop" >
    <div class="mesagecontent">
    	<h4>
            <span class="checkout_popup_title">Checkout</span>
            <div class="closepopoup">X</div>
        </h4>
        <div class="checkout_popuppopoupbody">
        	<form id="checkout_popup_form" action="<?php echo $base_url.'/vpc_php_serverhost_do';?>" method="post" accept-charset="UTF-8" enctype="multipart/form-data" onsubmit="return validate_checkout_form(jQuery(this));">
	            <div class="form_item">
	                <input id="popup_form_name" class="form_text" type="text" name="name" placeholder="Name" />    
	            </div>
	            <div class="form_item">
	                <input id="popup_form_email" class="form_text" type="text" name="email" placeholder="Email" />    
	            </div>
	            <div class="form_item">
	                <input id="popup_form_mobile_number" class="form_text" type="text" name="mobile_number" placeholder="Mobile Number" />    
	            </div>
	            <div class="form_item">
	            	<input type="checkbox" name="terms_and_conditions" id="popup_form_terms_and_conditions" /> 
	            	I agree to the Terms and Conditions.
	            </div>
	            <div class="form_item">
	            	<input type="submit" class="form_checkout_submit" value="Checkout" />
	            </div>
	            
	            <input type="hidden" id="checkout_event_id" name="event_id" value="0">
	        </form>
	    </div>	    	
    </div>
    <div class="mesage-pop-bg"></div>
</div>
<script type="text/javascript">
function open_instructor_popup(content){
	jQuery("#mesagepopboxinstructorpopoup .mesagecontent").html(content);      
    jQuery("#mesagepopboxinstructorpopoup").show();     
}
function close_instructor_popup(){
	jQuery("#mesagepopboxinstructorpopoup").hide(); 
    jQuery("#mesagepopboxinstructorpopoup .mesagecontent").html('');      
}
function open_event_popup(content){
	jQuery("#mesagepopboxeventpopoup .mesagecontent").html(content);     
    jQuery("#mesagepopboxeventpopoup").show();
}
function close_event_popup(){
	jQuery("#mesagepopboxeventpopoup").hide(); 
    jQuery("#mesagepopboxeventpopoup .mesagecontent").html('');         
}
function open_checkout_event_form_popup(id){  
	jQuery('#checkout_event_id').val(id);
	jQuery("#mesagepopboxcheckoutpopoup").show();	
}
function close_checkout_event_form_popup(){
	jQuery("#mesagepopboxcheckoutpopoup").hide();        
	jQuery('#checkout_event_id').val(0);
}
function open_instructor(id){
    jQuery.ajax({
    	url: base_url+'/frontevents/get_instructor/'+id,
        type: 'GET',
        beforeSend: function() {
        	open_instructor_popup('<h4>Loading<div id="closeinstructorpopoup" class="closeinstructorpopoup closepopoup">X</div></h4><div class="instructor_loading ajax_loading"></div>');            
        },
        success: function(result) {
        	open_instructor_popup(result);            
        }
    }); 
}
function open_event(id){
    jQuery.ajax({
    	url: base_url+'/frontevents/get_event/'+id,
        type: 'GET',
        beforeSend: function() {
        	open_event_popup('<h4>Loading<div id="closeeventpopoup" class="closeeventpopoup closepopoup">X</div></h4><div class="event_loading ajax_loading"></div>');            
        },
        success: function(result) {
        	open_event_popup(result);            
        }
    }); 
}
function checkout_event(id){  
	close_event_popup();
	open_checkout_event_form_popup(id);	
}
function validate_checkout_form(obj) {		
	var form_id = obj.attr('id');
	validate_required_input(jQuery('#popup_form_name'));
	validate_email_input(jQuery('#popup_form_email'));	
	validate_numeric_input(jQuery('#popup_form_mobile_number'));
	validate_required_input_checkbox('popup_form_terms_and_conditions');
	var checkout_form_flag = 0;
	var focused = 0;
	jQuery('#'+form_id+' input').each(function(){
		if(jQuery(this).hasClass('error')){ 
			checkout_form_flag = 1;
			if(focused == 0){
	    		focused = 1;
		    	jQuery(this).focus();
		    }
		}
	});
	if(checkout_form_flag === 0){
		return true;
	}else{
		return false;
	}   	
}
function validate_required_input(obj){
	var val = obj.val();
	if (jQuery.trim(val).length !== 0){
		if(obj.hasClass('error')){
			obj.removeClass("error");			
		}
	}else{
		if(!(obj.hasClass('error'))){
			obj.addClass("error");			
		}			
	}
}
function validate_email_input(obj){
	var val = obj.val();
	if (isValidEmailAddress(val)){
		if(obj.hasClass('error')){
			obj.removeClass("error");			
		}
	}else{
		if(!(obj.hasClass('error'))){
			obj.addClass("error");			
		}			
	}
}
function validate_numeric_input(obj){
	var val = obj.val();
	if (isNumeric(val)){
		if(obj.hasClass('error')){
			obj.removeClass("error");			
		}
	}else{
		if(!(obj.hasClass('error'))){
			obj.addClass("error");			
		}			
	}
}
function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
};
function isNumeric(n) {
	return !isNaN(parseFloat(n)) && isFinite(n);
}
function validate_required_input_checkbox(obj){	
	var obj_in = jQuery('#'+obj);
	if(jQuery('#'+obj+':checked').length > 0){
		if(obj_in.hasClass('error')){
			obj_in.removeClass('error');			
		}
	}else{
		if(!(obj_in.hasClass('error'))){
			obj_in.addClass('error');			
		}			
	}  
}
jQuery(document).ready(function() {
    jQuery("body").on("click",".closepopoup, .mesage-pop-bg", function(){
    	close_instructor_popup(); 
    	close_event_popup();          
    	close_checkout_event_form_popup();  
    });
});
</script>