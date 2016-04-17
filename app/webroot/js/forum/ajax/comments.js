function addComment(){
	$.ajax({
		type: 'POST',
		data: $('#ForumCommentViewForm').serialize(),	
		url: siteUrl+'/posts/addComment',
		beforeSend: function(){
			$('#commnetResult').hide();
			$('#ajaxLoading').show();	
		},
		success:function(response){
			$('#ajaxLoading').hide();
			var data = JSON.parse(response);	
			if(data.status === "success"){	
				$('#commnetResult').html('');
				$("#comment_messages").prepend(data.html);
				$("input[type=text], textarea").val("");
				$('.last').click();
			}else{
				$('#commnetResult').html(data.html);
				$('#commnetResult').show();
			}			
		}
	});
}