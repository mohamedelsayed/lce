<div id="mesagepopboxinstructorpopoup" class="mesage-pop" >
    <div id="mesagecontent"></div>
    <div class="mesage-pop-bg"></div>
</div>
<div id="mesagepopboxeventpopoup" class="mesage-pop" >
    <div id="mesagecontent"></div>
    <div class="mesage-pop-bg"></div>
</div>
<script type="text/javascript">
function open_instructor_popup(content){
    jQuery("#mesagepopboxinstructorpopoup #mesagecontent").html(content); 
    jQuery("#mesagepopboxinstructorpopoup").addClass("alert"); 
    jQuery("#mesagepopboxinstructorpopoup").show();
    jQuery('body').addClass("mobile-menu-opend");       
}
function close_instructor_popup(){
    jQuery("#mesagepopboxinstructorpopoup").hide(); 
    jQuery("#mesagepopboxinstructorpopoup #mesagecontent").html('');
    jQuery("#mesagepopboxinstructorpopoup").removeClass("alert");
    jQuery('body').removeClass("mobile-menu-opend");          
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
function open_event_popup(content){
    jQuery("#mesagepopboxeventpopoup #mesagecontent").html(content); 
    jQuery("#mesagepopboxeventpopoup").addClass("alert"); 
    jQuery("#mesagepopboxeventpopoup").show();
    jQuery('body').addClass("mobile-menu-opend");       
}
function close_event_popup(){
    jQuery("#mesagepopboxeventpopoup").hide(); 
    jQuery("#mesagepopboxeventpopoup #mesagecontent").html('');
    jQuery("#mesagepopboxeventpopoup").removeClass("alert");
    jQuery('body').removeClass("mobile-menu-opend");          
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
jQuery(document).ready(function() {
	jQuery("#mesagepopboxinstructorpopoup").on("click",".closeinstructorpopoup", function(){
        close_instructor_popup();            
    });
    jQuery("#mesagepopboxeventpopoup").on("click",".closeeventpopoup", function(){
        close_event_popup();            
    });
    jQuery('.mesage-pop-bg').click(function(){
    	close_instructor_popup();
        close_event_popup();
    });
});
</script>