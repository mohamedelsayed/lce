<?php $width = 420;$height = 315;
$title = '';
if($item['Library']['title'] != ''){
	$title = $item['Library']['title'];
}
$file_link = '';
$youtube_url = '';
if($item['Library']['file'] != ''){
	$file_link = BASE_URL."/app/webroot/files/upload/".$item['Library']['file'];
}elseif($item['Library']['youtube_url'] != ''){
	$youtube_url = $item['Library']['youtube_url'];
}
if($file_link != ''){?>
	<div class="mm_top">
		<h6><?php echo $title;?></h6>
		<video class="library_video" width="<?php echo $width;?>" height="<?php echo $height;?>" controls>
			<source src="<?php echo $file_link;?>" type="video/mp4">
			Your browser does not support HTML5 video.
  		</video>
	</div>
<?php }?>
<?php if($youtube_url != ''){
	$ytarray=explode("/", $youtube_url);
	$ytendstring=end($ytarray);
	$ytendarray=explode("?v=", $ytendstring);
	$ytendstring=end($ytendarray);
	$ytendarray=explode("&", $ytendstring);
	$ytcode=$ytendarray[0];?>
	<div class="mm_top">	
		<h6><?php echo $title;?></h6>
		<?php echo "<iframe width=\"".$width."\" height=\"".$height."\" src=\"http://www.youtube.com/embed/$ytcode\" frameborder=\"0\" allowfullscreen></iframe>";?>	
	</div>
<?php }?>