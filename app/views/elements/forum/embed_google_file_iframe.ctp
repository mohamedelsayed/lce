<?php $file = str_replace('/edit', '/pub', $file);
$file = str_replace('/view', '/pub', $file);?>
<iframe class="embed_google_file_iframe" src="<?php echo $file.'?embedded=true';?>"></iframe>