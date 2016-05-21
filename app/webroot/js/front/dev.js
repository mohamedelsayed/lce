/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.lifecoachingegypt.com
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
$(document).ready(function(){
    $('#month_select_id').on('change', function(){
        reload_page_with_new_data();      
    });
    $('#year_select_id').on('change', function(){
        reload_page_with_new_data();      
    });
});    
function reload_page_with_new_data(){
	var month_val = $('#month_select_id').val();      
    var year_val = $('#year_select_id').val();     
    var new_url = base_url+'/all-events?year='+year_val+'&month='+month_val;
    window.location.href = new_url;
}