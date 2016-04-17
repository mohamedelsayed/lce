function getCats(obj, modelName, field, empty){
	var resultDiv = obj.parent().next();
	var artistId = 0;
	if(obj.val()!='')
		artistId = obj.val();
	$.ajax({
		   //type: 'POST',
		   url: siteUrl+'/cats/getArtistCats/'+artistId+'/'+modelName+'/'+field+'/'+empty,
		   //data:{'artist_id':$(this).val()},
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
