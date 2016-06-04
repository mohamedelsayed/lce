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
            <span class="checkout_popup_title">CHECKOUT</span>
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
	            	<input type="submit" class="form_checkout_submit" value="CHECKOUT" />
	            </div>	            
	            <input type="hidden" id="checkout_event_id" name="event_id" value="0">
	        </form>
	    </div>	    	
    </div>
    <div class="mesage-pop-bg"></div>
</div>