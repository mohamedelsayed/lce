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
	            	<div class="left_tickets">
		            	<label>Tickets</label>
		                <input onkeypress="return validate_tickets_number_keyup(event);" id="popup_form_tickets_number" class="form_text" type="text" name="tickets_number" value="1" />    
	                </div>
		            <div class="event_popup_ticket_price_all_popup">
		            	<div class="event_popup_ticket_price_all_in_popup">Total Price: </div>
		            	<div class="total_ticket_price_currency_popup">
			            	<div class="total_ticket_price"></div>
			            	<div class="currency_popup"><?php echo $currency;?></div>
		            	</div>
	            	</div>
            	</div>
	            <div class="form_item terms_and_conditions">
	            	<input type="checkbox" name="terms_and_conditions" id="popup_form_terms_and_conditions" />
	            	I agree to the <a target="_blank" href="<?php echo $base_url.'/terms-and-conditions';?>">Terms and Conditions.</a>
	            </div>
	            <div class="form_item">
	            	<input type="submit" class="form_checkout_submit" value="CHECKOUT" />
	            </div>	   
	            <div class="checkout_hint">Please make sure that cookies are enabled on your browser and that your anti-virus allows online payment</div>         
	            <input type="hidden" id="checkout_event_id" name="event_id" value="0">
	        </form>
	    </div>	    	
    </div>
    <div class="mesage-pop-bg"></div>
</div>
<div id="mesagepopboxcontacteventpopoup" class="mesage-pop" >
    <div class="mesagecontent">
    	<h4>
            <span class="contactevent_popup_title">Inquire about event</span>
            <div class="closepopoup">X</div>
        </h4>
        <div class="contactevent_popuppopoupbody">
        	<div class="contactevent_hint"></div>
        	<form id="contactevent_popup_form" action="<?php echo $base_url;?>" method="post" accept-charset="UTF-8" enctype="multipart/form-data" onsubmit="return validate_contactevent_form(jQuery(this));">
	            <div class="form_item">
	                <input id="contactevent_popup_form_first_name" class="form_text" type="text" name="first_name" placeholder="First Name" />    
	            </div>
	            <div class="form_item">
	                <input id="contactevent_popup_form_last_name" class="form_text" type="text" name="last_name" placeholder="Last Name" />    
	            </div>
	            <div class="form_item">
	                <input id="contactevent_popup_form_email" class="form_text" type="text" name="email" placeholder="Email" />    
	            </div>
	            <div class="form_item">
	                <input id="contactevent_popup_form_mobile" class="form_text" type="text" name="mobile_number" placeholder="Mobile Number" />    
	            </div>
	            <div class="form_item">
	            	<textarea id="contactevent_popup_form_message" class="form_text" name="message" placeholder="Message" ></textarea>
	            </div>
	            <div class="contactevent_status"></div>
	            <div class="form_item">
	            	<input type="submit" class="form_contactevent_submit" value="Submit" />
	            </div>	            
	            <input type="hidden" id="contactevent_event_id" name="event_id" value="0">
	        </form>
	    </div>	    	
    </div>
    <div class="mesage-pop-bg"></div>
</div>