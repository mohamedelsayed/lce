/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.lifecoachingegypt.com
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
var ajax_list_coaches_run;
var coaches_page = 1;
var limit = 2;
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
function start_ajax_list_coaches () {
	var scroll_height = jQuery(window).scrollTop() + jQuery(window).height();
	var page_height = jQuery(document).height() - 250;
	if(scroll_height >= page_height){
		//if(jQuery(window).scrollTop() + jQuery(window).height() == jQuery(document).height() - 100) {   
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
	if(ajax_list_coaches_run) {
		ajax_list_coaches_run.abort();
	}
    ajax_list_coaches_run = jQuery.ajax({
    	type: "POST",
        url: base_url + '/frontcoaches/ajax_list_coaches',
        data: {page: page, limit: limit, filter:filter, type:type, order_field:order_field, order_direction:order_direction},
        beforeSend: function() {
        	list_coaches_loadmore_button.addClass("ajaxloading");
        },
        success: function(result) {
        	result = jQuery.parseJSON(result);
        	var html = result.html;
        	var pagecount = result.page_count;
        	var nextpage = parseInt(result.nextpage);
    		coaches_page = nextpage;
        	list_coaches_loadmore_button.removeClass("ajaxloading");
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