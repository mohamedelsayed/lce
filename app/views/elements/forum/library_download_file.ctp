<?php $title = '';
if($item['Library']['title'] != ''){
	$title = $item['Library']['title'];
}
$file_link = '';
$file_ext = '';
if($item['Library']['file'] != ''){
	$file_link = BASE_URL."/app/webroot/files/upload/".$item['Library']['file'];
	$path_exploded = explode('.', $item['Library']['file']);
	$file_ext = end($path_exploded);	
}elseif($item['Library']['google_drive_url'] != ''){
	$file_link = $item['Library']['google_drive_url'];	
	$file_ext = 'google-drive';
}
$file_class = $file_ext.'-file';
if($file_link != ''){?>
	<div class="mm_top">
		<div class="common-file-post <?php echo $file_class;?>">
			<a target="_blank" href="<?php echo $file_link;?>" ><?php echo $title;?></a>
		</div>		
	</div>
<?php }?>