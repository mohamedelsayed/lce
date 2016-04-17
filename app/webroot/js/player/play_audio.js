function playAudio(id, title, audio, width, height, siteUrl, del){
	var src = siteUrl+'/app/webroot/files/mp3_player/player.swf';
	var audioPath = siteUrl+'/app/webroot/files/upload/'+audio;
	var titleDiv = "<div>"+title+"</div>";
	var deleteDiv = '';
	var object = "<object type='application/x-shockwave-flash' 	data='"+src+"' width='"+width+"' height='"+height+"'><param name='movie' value='"+src+"' /><param name='FlashVars' value='mp3="+audioPath+"&showvolume=1&showstop=1' /></object>";
	if(del == 1){
		var url = siteUrl+"/audios/deleteAudio/"+id;
		var deleteDiv = "<div class = 'delete' onclick='if(confirm(\"Are you sure you want to delete this audio?\"))window.location =\""+url+"\";'>Delete Audio</div>";
	}else
		var deleteDiv = '';
	$("#playerDivaudio").html(titleDiv+object+deleteDiv);
	updateAudioHits(id, siteUrl);
	return false;
};