function sendFormContact(siteUrl){
	$.ajax({
		type: 'POST',
		data: $('#ContactusForm').serialize(),	
		url: siteUrl+'/texts/contactusForm/ajax',
		async: false,
		beforeSend: function(){
			$('#contactus_Result2').hide();
			$('#contactus_ajaxLoading').show();	
		},
		success:function(result){
			$('#contactus_ajaxLoading').hide();
			$('#contactus_Resultdiv').html(result).show();	
			$('.bottom_grop_top').find('form')[0].reset();
			opennorequestpopup();
		}
	});
}
