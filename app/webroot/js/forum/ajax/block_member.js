/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.lifecoachingegypt.com
 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */
jQuery(document).ready(function(){
	jQuery("body").on("click", ".blockunblockbutton", function(){
		if(common_block_unblock_click_flag == 0){
			common_block_unblock_click_flag = 1;
		 	var other_member_id = $(this).attr("othermemberid");
		 	var block_flag = $(this).attr("blockflag");
		 	var other_member_fullname = $(this).attr("othermemberfullname");
		 	if(block_flag == 1){
		 	var answer = confirm('Are you sure you want to block '+other_member_fullname+'?');
			 	if(answer){
			 		block_unblock(other_member_id, block_flag, other_member_fullname);
		 		}else{
		 			common_block_unblock_click_flag = 0;
	 			}
 			}else{
 				block_unblock(other_member_id, block_flag, other_member_fullname);
 			}		 	
	 	}
	});	
});
function block_unblock(other_member_id, block_flag, other_member_fullname){
	var block_member_wrapper = $('.block_member_wrapper'+other_member_id);
	$.ajax({
 		type: "POST",
        url: siteUrl+'/blocked_members/block_unblock',
		data: {other_member_id:other_member_id, block_flag:block_flag, other_member_fullname:other_member_fullname},
        beforeSend: function() {
        	//add_agreements_status.addClass("ajaxloading");
        	//add_agreements_status.show();
        },
        success: function(response) {
			//add_agreements_status.removeClass("ajaxloading");
			//add_agreements_status.hide();	
			var data = JSON.parse(response);	
			if(data.status === "success"){	
				block_member_wrapper.html(data.html);
			}
			common_block_unblock_click_flag = 0;
		},
		error: function(x, t, m) {
			common_block_unblock_click_flag = 0;
        }
    });	  
}