<?php
if(!empty($video)){?>
	<script type="text/javascript">
		<?php /*$(document).ready(function(){
			updateVideoHits('<?php echo $video['id'];?>', '<?php echo $base_url;?>');
		});*/?>
	</script>
	<?php 
	if($this->action == 'edit')$delete = true; else $delete = false;
	echo '<div>'.$video['title'].'</div>';
?>
	<iframe title="YouTube video player" width="<?php echo $width;?>" height="<?php echo $height;?>" src="<?php echo $video['url'];?>" frameborder="0" allowfullscreen></iframe>
<?php
	if($delete){			
		echo '<div class = "delete">';	
			if(isset($controller))	
				echo $this->Html->link(__('Delete video', true), array('controller' => $controller.'/deleteVideo/'.$video['id']), null, __('Are you sure you want to delete this video?', true));
			else 
				echo __("Can't Del", true);
		echo '</div>';
	} 
}
else echo __('No Video URL', true);	 
?>