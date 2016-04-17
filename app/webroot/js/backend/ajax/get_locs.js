function getLocs(obj, modelName, empty){
	var resultDiv = obj.parent().next();
	var cityId = 0;
	if(obj.val()!='')
		cityId = obj.val();
	$.ajax({
		   //type: 'POST',
		   url: siteUrl+'/locs/getCityLocs/'+cityId+'/'+modelName+'/'+empty,
		   //data:{'section_id':$(this).val()},
		   beforeSend: function(){
		   		resultDiv.hide();
				$('#loader').show();
		   },
		   success:function(html){
			    $('#loader').hide();
			    resultDiv.html(html);
			    //$('#'+modelName+'CatId').unwrap();
			    resultDiv.show();
		   }
	});
}
