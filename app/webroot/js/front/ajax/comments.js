function addComment(siteUrl){
	$.ajax({
		type: 'POST',
		data: $('#CommentItemForm').serialize(),	
		url: siteUrl+'/article/addComment',
		beforeSend: function(){
			$('#commnetResult').hide();
			$('#ajaxLoading').show();	
		},
		success:function(result){
			$('#commnetResult').html(result);
			$('#ajaxLoading').hide();
			$('#commnetResult').show();
		}
	});
}