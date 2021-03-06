/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.lifecoachingegypt.com
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
jQuery(document).ready(function(){
	jQuery("body").on("click",".closepopoup, .mesage-pop-bg", function(){
    	close_instructor_popup();      	
    });
    jQuery("body").on("click", ".removeuploadfilebtn", function () {
    	var y = confirm('Are you sure you want to delete this file?');
        if(y){
        	var id = jQuery(this).attr('data-file-id');
        	window.location.href = base_url+"/libraries/deleteFile/"+id;        	
        	//jQuery(this).closest('div.common-file-post').remove();
        }
    });
});
function open_event(id){
	window.location.href = base_url+"/events/view/"+id;	    
}
function open_event_front(id){
	window.location.href = base_url+"/events/view/0/nevent_id:"+id;	    
}
function open_instructor_popup(content){
	jQuery("#mesagepopboxinstructorpopoup .mesagecontent").html(content);      
    jQuery("#mesagepopboxinstructorpopoup").show();     
}
function close_instructor_popup(){
	jQuery("#mesagepopboxinstructorpopoup").hide(); 
    jQuery("#mesagepopboxinstructorpopoup .mesagecontent").html('');      
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