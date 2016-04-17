function sendForm(siteUrl){
	$.ajax({
		type: 'POST',
		data: $('#newsletterForm').serialize(),	
		url: siteUrl+'/home/newsletter',
		beforeSend: function(){
			$('#newsletter_Result').hide();
			$('#newsletter_ajaxLoading').show();	
		},
		success:function(result){
			$('#newsletter_ajaxLoading').hide();
			$('#newsletter_Result').html(result).show();			
		}
	});
}