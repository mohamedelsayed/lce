function placeArticles(siteUrl){
	$.ajax({
		   type: 'POST',
		   url: siteUrl+'/articles/placeArticles',
		   data:$('form').serialize(),
		   beforeSend: function(){
		   		$('#ajaxResult').hide();
				$('#loader').show();
		   },
		   success:function(html){
			    $('#loader').hide();
			    $('#ajaxResult').html(html);
			    $('#ajaxResult').show();
		   }
	});
}
