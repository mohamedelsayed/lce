/*function playVideo(id, title, video, image, width, height, siteUrl, del){
	var src = siteUrl+'/app/webroot/files/flv_player/player.swf';
	var videoPath = siteUrl+'/app/webroot/files/upload/'+video;
	var imagePath = siteUrl+'/app/webroot/img/upload/'+image;
	var skinPath = siteUrl+'/app/webroot/files/flv_player/skins/fs40/fs40.xml';
	var titleDiv = "<div>"+title+"</div>";
	var object = "<object><embed type='application/x-shockwave-flash' allowscriptaccess='always' wmode='transparent' allowfullscreen='true' width='"+width+"' height='"+height+"' src='"+src+"' flashvars='file="+videoPath+"&image="+imagePath+"&skin="+skinPath+"' /></object>";
	if(del == 1){
		var url = siteUrl+"/videos/deleteVideo/"+id;
		var deleteDiv = "<div class = 'delete' onclick='if(confirm(\"Are you sure you want to delete this video?\"))window.location =\""+url+"\";'>Delete Video</div>";
	}else
		var deleteDiv = '';
	$("#playerDiv").html(titleDiv+object+deleteDiv);
	updateVideoHits(id, siteUrl);
	return false;
};
function playTube(id, title, src, width, height, siteUrl, del){
	var titleDiv = "<div>"+title+"</div>";
	var iframe = '<iframe title="YouTube video player" src="'+src+'" width="'+width+'" height="'+height+'" frameborder="0" allowtransparency="true" allowfullscreen="true"></iframe>';
	if(del == 1){
		var url = siteUrl+"/videos/deleteVideo/"+id;
		var deleteDiv = "<div class = 'delete' onclick='if(confirm(\"Are you sure you want to delete this video?\"))window.location =\""+url+"\";'>Delete Video</div>";
	}else
		var deleteDiv = '';
	$("#playerDiv").html(titleDiv+iframe+deleteDiv);
	updateVideoHits(id, siteUrl);
	return false;
};*/
function updateVideoHits(videoId, siteUrl){
	$.ajax({
		//type: 'POST',
		//data: $('#CommentDisplayForm').serialize(),	
		url: siteUrl+'/main/updateVideoHits/'+videoId,
		beforeSend: function(){
			//alert('beforeSend');
		},
		success:function(result){
			//alert(result);
		}
	});
}