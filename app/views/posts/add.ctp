<?php echo $this->Javascript->link('forum/ajax/upload_image', false);
echo $this->Javascript->link('forum/ajax/upload_video', false);
echo $this->Javascript->link('forum/ajax/upload_attachement', false);?>
<div class="posts form">
	<?php echo $this->Form->create('Post', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Add Post'); ?></legend>
		<?php
		echo $this->Form->input('title', array("label" => 'Title'));
		echo $this->Form->input('Post.body', array('class'=>'ckeditor'));?>
		<div class="input file">
			<input class="hiddeninputbutton" id="uploadimageinput" type="file" name="uploadimageinput" />
			<input id="uploadimagepath" name="data[Post][image]" value="" type="hidden" />
			<div id="uploadimagestatus" class="uploadstatus"></div>
			<button type="button" id="uploadimage" class="uploadimage">Upload Image</button>
		</div>
		<div class="input file">
			<input class="hiddeninputbutton" id="uploadvideoinput" type="file" name="uploadvideoinput" />
			<input id="uploadvideopath" name="data[Post][video]" value="" type="hidden" />
			<div id="uploadvideostatus" class="uploadstatus"></div>
			<button type="button" id="uploadvideo" class="uploadvideo">Upload Video</button>
		</div>
		<div class="input file">
			<input class="hiddeninputbutton" id="uploadattachementinput" type="file" name="uploadattachementinput" />
			<input id="uploadattachementpath" name="data[Post][attachement]" value="" type="hidden" />
			<div id="uploadattachementstatus" class="uploadstatus"></div>
			<button type="button" id="uploadattachement" class="uploadattachement">Upload Attachement</button>
		</div>
		<?php echo $this->Form->input('category_id',array('empty'=>''));
		if($isAdmin == 1){
			echo $this->Form->input('approved');	
		}else{
			echo $this->Form->input('approved', array('type' => 'hidden', 'value' => 1));			
		}
		echo $this->Form->input('member_id', array('type' => 'hidden', 'value' => $userInfoFront['id']));?>
	</fieldset>
	<?php echo $this->Form->end(__('Submit', true));?>
</div>