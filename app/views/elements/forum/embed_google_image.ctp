<?php $file_exploded = explode('/', $file);
foreach ($file_exploded as $key => $value) {
	$file_id = '';
	if($value == 'd'){
		if(isset($file_exploded[$key+1])){
			$file_id = $file_exploded[$key+1];
			break;
		}
	}	
}
$file_link = '';
if($file_id != ''){
	$file_link = 'http://drive.google.com/uc?export=view&id='.$file_id;
}
if($file_link == ''){
	$file_exploded = explode('?', $file);
	if(isset($file_exploded[1])){
		parse_str($file_exploded[1]);
		if(isset($id)){
			$file_id = $id;
		}
	}	
}
$file_link = '';
if($file_id != ''){
	$file_link = 'http://drive.google.com/uc?export=view&id='.$file_id;
}?>
<?php if($file_link != ''){?>
	<img class="embed_google_image" src="<?php echo $file_link;?>" />
<?php }?>