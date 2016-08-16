/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.lifecoachingegypt.com
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
var ajax_list_coaches_run;
var coaches_page = 1;
var limit = 6;
var global_number_of_participants = 0;
var global_ticket_price = 0;
jQuery(document).ready(function(){
    jQuery('#month_select_id').on('change', function(){
        reload_page_with_new_data();      
    });
    jQuery('#year_select_id').on('change', function(){
        reload_page_with_new_data();      
    });
    jQuery('#coach_specialization').on('change', function(){
    	ajax_list_coaches(1);
	});
    jQuery('#coach_geography').on('change', function(){
    	ajax_list_coaches(1);
	});
	jQuery("#coach_name").on("change paste keyup", function() {
		ajax_list_coaches(1);
	});    
	jQuery("body").on("click",".closepopoup, .mesage-pop-bg", function(){
    	close_instructor_popup(); 
    	close_event_popup();          
    	close_checkout_event_form_popup();  
    	close_contact_me_popup();
    	close_coach_popup();
    	close_contact_event_popup();
    });
    jQuery("#contactme_popup_form").submit(function (event) {
		event.preventDefault();
	});
	jQuery("#contactevent_popup_form").submit(function (event) {
		event.preventDefault();
	});
	jQuery("#popup_form_tickets_number").on("change paste keyup", function() {
		validate_tickets_number();
	});
});
function reload_page_with_new_data(){
	var month_val = jQuery('#month_select_id').val();      
    var year_val = jQuery('#year_select_id').val();     
    var new_url = base_url+'/all-events?year='+year_val+'&month='+month_val;
    window.location.href = new_url;
}
function start_ajax_list_coaches () {
	var scroll_height = jQuery(window).scrollTop() + jQuery(window).height();
	var page_height = jQuery(document).height() - 250;
	if(scroll_height >= page_height){
		ajax_list_coaches(0);
   }
}
function ajax_list_coaches(type){
	var list_coaches_loadmore_button = jQuery('#list_coaches_loadmore_button');
	var list_coaches_div = jQuery('#list_coaches');
	var filter = '';
	var nextpage = coaches_page + 1;
	var page = coaches_page;
	var order_field = jQuery('#list_coaches_loadmore_button').attr('order_field');	
	var order_direction = jQuery('#list_coaches_loadmore_button').attr('order_direction');
	var order_field_in = jQuery('#list_coaches_loadmore_button').attr('order_field_in');	
	var order_direction_in = jQuery('#list_coaches_loadmore_button').attr('order_direction_in');
	var coach_specialization = jQuery('#coach_specialization').val();
	var coach_geography = jQuery('#coach_geography').val();
	var coach_name = jQuery('#coach_name').val();
	if(ajax_list_coaches_run) {
		ajax_list_coaches_run.abort();
	}
    ajax_list_coaches_run = jQuery.ajax({
    	type: "POST",
        url: base_url+'/frontcoaches/ajax_list_coaches',
        data: {
    		page: page, limit: limit, filter: filter, type: type, name: coach_name,
    		order_field: order_field, order_direction: order_direction,
    		order_field_in: order_field_in, order_direction_in: order_direction_in,
    		coach_specialization: coach_specialization, coach_geography: coach_geography        		
		},
        beforeSend: function() {
        	list_coaches_loadmore_button.addClass("ajaxloading");
        	jQuery('#list_coaches_loading_icon').addClass("ajaxloading");
        },
        success: function(result) {
        	result = jQuery.parseJSON(result);
        	var html = result.html;
        	var pagecount = result.page_count;
        	var nextpage = parseInt(result.nextpage);
    		coaches_page = nextpage;
        	list_coaches_loadmore_button.removeClass("ajaxloading");
        	jQuery('#list_coaches_loading_icon').removeClass("ajaxloading");
        	if(type == 0){        	        		
        		list_coaches_div.append(html);
        	}else{
        		list_coaches_div.html(html);
        	}        	
        	if (parseInt(nextpage) <= parseInt(pagecount)) {
        		list_coaches_loadmore_button.show();        		
            } else {
            	list_coaches_loadmore_button.hide();
        	}
    	}    	
	});	
}
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
	jQuery('.left_tickets').show();
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
        	result = jQuery.parseJSON(result);
        	var html = result.html;
        	var number_of_participants = result.number_of_participants;
        	global_number_of_participants = number_of_participants;
			var ticket_price = result.ticket_price;
			global_ticket_price = ticket_price;
			jQuery('.total_ticket_price').html(global_ticket_price);
        	open_event_popup(html);            
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
	validate_tickets_number();
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
function validate_contactme_form(obj) {		
	var form_id = obj.attr('id');	
	validate_required_input(jQuery('#contactme_popup_form_first_name'));
	validate_required_input(jQuery('#contactme_popup_form_last_name'));
	validate_email_input(jQuery('#contactme_popup_form_email'));
	validate_numeric_input(jQuery('#contactme_popup_form_mobile'));
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
		var formData = jQuery('#'+form_id).serialize();
		jQuery.ajax({
    	url: base_url+'/frontcoaches/send_coach_mail/',
        type: 'POST',
        data: formData,            
        beforeSend: function() {
        	jQuery('.form_contactme_submit').attr('disabled', 'disabled');
        },
        success: function(result) {
        	result = jQuery.parseJSON(result);
        	var html = result.html;
        	jQuery(".form_contactme_submit").removeAttr("disabled");
        	close_contact_me_popup();
        	open_coach_popup(html);
        }
    }); 
		//return true;
	}else{
		//return false;
	}   	
}
function contact_me(id){  
	open_contact_me_popup (id);
}
function open_contact_me_popup (id) {
	jQuery('#contactme_coach_id').val(id);
	jQuery("#mesagepopboxcontactmepopoup").show();	  
}
function close_contact_me_popup(){
	jQuery("#mesagepopboxcontactmepopoup").hide();        
	jQuery('#contactme_coach_id').val(0);
}
function open_coach_popup(content){
	jQuery("#mesagepopboxcoachpopoup .mesagecontent").html(content);      
    jQuery("#mesagepopboxcoachpopoup").show();     
}
function close_coach_popup(){
	jQuery("#mesagepopboxcoachpopoup").hide(); 
    jQuery("#mesagepopboxcoachpopoup .mesagecontent").html('');      
}
function validate_tickets_number () {
	var tickets_number_obj = jQuery('#popup_form_tickets_number');
	var val = tickets_number_obj.val();
	var checkout_installment_flag = jQuery('#checkout_installment_flag').val();
	if(checkout_installment_flag == 0){
		var error_flag = 0;
		jQuery('.total_ticket_price').html(0);
		if(val == 0){
			error_flag = 1;
		}else if(parseInt(val) > parseInt(global_number_of_participants)){
			tickets_number_obj.val(global_number_of_participants);
			//error_flag = 1;
			error_flag = 0;
		}else{		
			error_flag = 0;
		}
		var val = tickets_number_obj.val();
		jQuery('.total_ticket_price').html(val * global_ticket_price);
		if(error_flag == 1){
			if(!(tickets_number_obj.hasClass('error'))){
				tickets_number_obj.addClass("error");			
			}			
		}else{
			if(tickets_number_obj.hasClass('error')){
				tickets_number_obj.removeClass("error");			
			}	
		}
	}else{
		tickets_number_obj.removeClass("error");		
	}
}
function validate_tickets_number_keyup(e){ 
	var key = e.which || e.keyCode; 
	var flag = 0;	
	if(key == 8){
		flag = 1;		
	}
	if(e.charCode >= 48 && e.charCode <= 57){
		flag = 1;			
	}
    if(flag == 1){
    	return true;    	
    }else{
    	return false;
    }
}
function validate_contactevent_form(obj) {	
	jQuery('.contactevent_status').html('');	
	var form_id = obj.attr('id');	
	validate_required_input(jQuery('#contactevent_popup_form_first_name'));
	validate_required_input(jQuery('#contactevent_popup_form_last_name'));
	validate_email_input(jQuery('#contactevent_popup_form_email'));
	validate_numeric_input(jQuery('#contactevent_popup_form_mobile'));
	validate_required_input(jQuery('#contactevent_popup_form_message'));	
	var contactevent_form_flag = 0;
	var focused = 0;
	jQuery('#'+form_id+' input').each(function(){
		if(jQuery(this).hasClass('error')){ 
			contactevent_form_flag = 1;
			if(focused == 0){
	    		focused = 1;
		    	jQuery(this).focus();
		    }
		}
	});
	if(contactevent_form_flag === 0){		
		var formData = jQuery('#'+form_id).serialize();
		jQuery.ajax({
    	url: base_url+'/frontevents/send_event_mail/',
        type: 'POST',
        data: formData,            
        beforeSend: function() {        	
        	jQuery('.form_contactevent_submit').attr('disabled', 'disabled');
        },
        success: function(result) {
        	result = jQuery.parseJSON(result);
        	var html = result.html;
        	var error = result.error;
        	jQuery(".form_contactevent_submit").removeAttr("disabled");
        	jQuery('.contactevent_status').html(html);
        	jQuery('.contactevent_status').removeClass('contactevent_form_fail');
        	jQuery('.contactevent_status').removeClass('contactevent_form_success');
        	if(error == 0){
        		jQuery('.contactevent_status').addClass('contactevent_form_success');        		
        	}else{
        		jQuery('.contactevent_status').addClass('contactevent_form_fail');        		
        	}      
        	jQuery('#mesagepopboxcontacteventpopoup').find('form')[0].reset();
    	}
    }); 
		//return true;
	}else{
		//return false;
	}   	
}
function contact_event(id){  
	open_contact_event_popup(id);
}
function open_contact_event_popup (id) {
	jQuery('#contactevent_event_id').val(id);
	jQuery("#mesagepopboxcontacteventpopoup").show();	  
}
function close_contact_event_popup(){
	jQuery("#mesagepopboxcontacteventpopoup").hide();        
	jQuery('#contactevent_event_id').val(0);
}
function open_checkout_installment_form_popup(){  
	jQuery('.total_ticket_price').html(value_for_each_installment);
	jQuery('#checkout_installment_flag').val(1);
	jQuery("#mesagepopboxcheckoutpopoup").show();	
	jQuery('.left_tickets').hide();
}