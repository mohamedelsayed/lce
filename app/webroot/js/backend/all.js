//menu and tabs
$(document).ready(function () {
	$('LI.drawer UL:not(:first)').hide(); // hide all ULs inside LI.drawer except the first one	
	$('H2.any').click(function () {
		// hide all the drawer contents
		$('LI.drawer UL:visible').slideUp().prev().removeClass('open');
		// show the associated drawer content to 'this' (this is the current H2 element)
		// since the drawer content is the next element after the clicked H2, we find
		// it and show it using this:
		$(this).addClass('open').next().slideDown();
	});		
	// setup ul.tabs to work as tabs for each div directly under div.panes
	//$("ul.tabs").tabs($("div.panes > div"));	
	// setup ul.tabs to work as tabs for each div directly under div.panes
	//$("ul.tabs2").tabs($("div.panes2 > div"));	  
	$('ul.tabs li').click(function(){
		var tab_id = $(this).attr('data-tab');
		$('ul.tabs li').removeClass('current');
		$('.tabdiv').hide();
		$(this).addClass('current');
		$("#"+tab_id).show();
	});
});
$(document).ready(function () {
	$("#CoachStatement").on("change paste keyup", function(e) {
		elsayed_coach_limit_textarea_characters($(this), 'statement_remain');
	});
	$("#CoachBiography").on("change paste keyup", function(e) {
		elsayed_coach_limit_textarea_characters($(this), 'biography_remain');
	});
});
function elsayed_coach_limit_textarea_characters (obj, remain_id) {
	var limit = obj.attr('maxLength');
	var tval = obj.val();
    var tlength = tval.length;
    var remain = parseInt(limit - tlength);
    if (remain <= 0){
    	obj.val((tval).substring(0, limit));
	}
	$('#'+remain_id).text('Characters remaining: '+ parseInt(limit - obj.val().length));
}