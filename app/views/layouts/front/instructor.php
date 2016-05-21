<div id="mesagepopboxinstructorpopoup" class="mesage-pop" >
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
        	open_instructor_popup('<h4>Loading<div id="closeinstructorpopoup" class="closeinstructorpopoup">X</div></h4><div class="instructor_loading"></div>');            
        },
        success: function(result) {
        	open_instructor_popup(result);            
        }
    }); 
}
jQuery(document).ready(function() {
    jQuery("#mesagepopboxinstructorpopoup").on("click",".closeinstructorpopoup", function(){
        close_instructor_popup();            
    });
    jQuery('.mesage-pop-bg').click(function(){
        close_instructor_popup();
    });
});
</script>