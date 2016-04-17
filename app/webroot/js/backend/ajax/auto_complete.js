function autoComplete(obj, url){
	$.ajax({
		//type: 'POST',
		url: siteUrl+url,
		//data:{'section_id':$(this).val()},
		beforeSend: function(){
			//alert('before');
		},
		success:function(htmlResult){
			//alert('success');
			obj.after(htmlResult);
		}
	});
}
