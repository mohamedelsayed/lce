<?php echo $this->Javascript->link('forum/ajax/upload_image', false);
echo $this->Javascript->link('forum/ajax/upload_video', false);
echo $this->Javascript->link('forum/ajax/upload_attachement', false);?>
<div class="cats form">
<?php echo $this->Form->create('Post', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Edit Post'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title', array("label" => 'Title'));
		echo $this->Form->input('Post.body', array('class'=>'ckeditor'));?>
		<div class="input file">
			<input class="hiddeninputbutton" id="uploadimageinput" type="file" name="uploadimageinput" />
			<input id="uploadimagepath" name="data[Post][image]" value="<?php echo $this->data['Post']['image'];?>" type="hidden" />
			<div id="uploadimagestatus" class="uploadstatus"></div>
			<?php if($this->data['Post']['image'] == ''){?>
				<button type="button" id="uploadimage" class="uploadimage">Upload Image</button>
			<?php }else{?>
				<button type="button" id="uploadimage" class="uploadimage hiddenbutton">Upload Image</button>
				<script type="text/javascript">
				jQuery(document).ready(function(){
					var image_item = draw_image_item('<?php echo $this->data['Post']['image'];?>');
					jQuery("#uploadimagestatus").html(image_item);
				});
				</script>
			<?php }?>
		</div>
		<div class="input file">
			<input class="hiddeninputbutton" id="uploadvideoinput" type="file" name="uploadvideoinput" />
			<input id="uploadvideopath" name="data[Post][video]" value="<?php echo $this->data['Post']['video'];?>" type="hidden" />
			<div id="uploadvideostatus" class="uploadstatus"></div>
			<?php if($this->data['Post']['video'] == ''){?>
				<button type="button" id="uploadvideo" class="uploadvideo">Upload Video</button>
			<?php }else{?>
				<button type="button" id="uploadvideo" class="uploadvideo hiddenbutton">Upload Video</button>
				<script type="text/javascript">
				jQuery(document).ready(function(){
					var video_item = draw_video_item('<?php echo $this->data['Post']['video'];?>');
					jQuery("#uploadvideostatus").html(video_item);
				});
				</script>
			<?php }?>
		</div>
		<div class="input file">
			<input class="hiddeninputbutton" id="uploadattachementinput" type="file" name="uploadattachementinput" />
			<input id="uploadattachementpath" name="data[Post][attachement]" value="<?php echo $this->data['Post']['attachement'];?>" type="hidden" />
			<div id="uploadattachementstatus" class="uploadstatus"></div>
			<?php if($this->data['Post']['attachement'] == ''){?>
				<button type="button" id="uploadattachement" class="uploadattachement">Upload Attachement</button>
			<?php }else{?>
				<button type="button" id="uploadattachement" class="uploadattachement hiddenbutton">Upload Attachement</button>
				<script type="text/javascript">
				jQuery(document).ready(function(){
					var attachement_item = draw_attachement_item('<?php echo $this->data['Post']['attachement'];?>');
					jQuery("#uploadattachementstatus").html(attachement_item);
				});
				</script>
			<?php }?>
		</div>
		<?php echo $this->Form->input('category_id',array('empty'=>''));
		if($isAdmin == 1){
			echo $this->Form->input('approved');	
		}else{
			echo $this->Form->input('approved', array('type' => 'hidden', 'value' => 1));			
		}		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>