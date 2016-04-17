/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.lifecoachingegypt.com
 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */
jQuery(document).ready(function(){
	jQuery("body").on("click", ".agreedisagreebutton", function(){
		if(common_agree_disagree_click_flag == 0){
			if(!($(this).hasClass(inactiveagreedisagreebuttonclass))){
				common_agree_disagree_click_flag = 1;
			 	var item_id = $(this).attr("itemid");
			 	var item_type = $(this).attr("itemtype");
			 	var agree_flag = $(this).attr("agreeflag");
			 	var identifiertype = $(this).attr("identifiertype");
			 	agree_disagree(item_id, item_type, agree_flag, member_id, identifiertype);
			}
	 	}
	});
	jQuery("body").on("mouseenter", ".agreedisagreehover", function(){
		var item_id = $(this).attr("itemid");
	 	var item_type = $(this).attr("itemtype");
	 	var agree_flag = $(this).attr("agreeflag");
	 	var identifiertype = $(this).attr("identifiertype");
	 	get_agree_disagree_members(item_id, item_type, agree_flag, identifiertype);
	});
	jQuery("body").on("mouseleave", ".agreedisagreehover", function(){
		var identifiertype = $(this).attr("identifiertype");
		var add_agreements_result = $('#add_agreements_result'+identifiertype);  
		add_agreements_result.hide();
	});		
});
function agree_disagree(item_id, item_type, agree_flag, member_id, identifiertype){
	var add_agreements_status = $('#add_agreements_status'+identifiertype);
	var agreebutton = $('#agreebutton'+identifiertype);
	var disagreebutton = $('#disagreebutton'+identifiertype);	
	var count_agree_number = $('#count_agree_number'+identifiertype);	
	var count_disagree_number = $('#count_disagree_number'+identifiertype);		
	$.ajax({
 		type: "POST",
        url: siteUrl+'/agreements/agree_disagree',
		data: {item_id:item_id, item_type:item_type, agree_flag:agree_flag, member_id:member_id},
        beforeSend: function() {
        	//add_agreements_status.addClass("ajaxloading");
        	//add_agreements_status.show();
        },
        success: function(response) {
			//add_agreements_status.removeClass("ajaxloading");
			//add_agreements_status.hide();	
			var data = JSON.parse(response);	
			if(data.status === "success"){	
				if(data.flag == 0){
					agreebutton.removeClass(inactiveagreedisagreebuttonclass);
					disagreebutton.addClass(inactiveagreedisagreebuttonclass);
					count_agree_number.html(data.count_agree);
					count_disagree_number.html(data.count_disagree);										
				}else if(data.flag == 1){
					agreebutton.addClass(inactiveagreedisagreebuttonclass);
					disagreebutton.removeClass(inactiveagreedisagreebuttonclass);					
					count_agree_number.html(data.count_agree);
					count_disagree_number.html(data.count_disagree);							
				}			
			}
			common_agree_disagree_click_flag = 0;
		},
		error: function(x, t, m) {
			common_agree_disagree_click_flag = 0;
        }
    });	  
}
function get_agree_disagree_members(item_id, item_type, agree_flag, identifiertype){
	var add_agreements_status = $('#add_agreements_status'+identifiertype);
	var add_agreements_result = $('#add_agreements_result'+identifiertype);  
	$.ajax({
 		type: "POST",
        url: siteUrl+'/agreements/get_agree_disagree_members',
		data: {item_id:item_id, item_type:item_type, agree_flag:agree_flag},
        beforeSend: function() {
        	//add_agreements_status.addClass("ajaxloading");
        	//add_agreements_status.show();
        },
        success: function(response) {
			//add_agreements_status.removeClass("ajaxloading");
			//add_agreements_status.hide();	
			var data = JSON.parse(response);	
			if(data.status === "success"){	
				if(data.html != ''){
					add_agreements_result.html(data.html);					
					add_agreements_result.show();
				}	
			}
		},
    });	
}