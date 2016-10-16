<div class="libraries form">
<?php echo $this->Form->create('Library', array('type'=>'file', 'url' => $actual_link));?>
	<fieldset>
 		<legend><?php __('Add Library'); ?></legend>
	<?php
		echo $this->Form->input('title', array("label" => 'Title'));
		if($type1 == 0){
			echo $this->Form->input('module', array('options' => $forum_modules_types));
			echo $this->Form->input('type3', array('options' => $forum_libraries_types3, "label" => 'Type'));
			echo $this->Form->input('type2', array('options' => $forum_libraries_types2, "label" => 'File Type'));			
		}else{
			echo $this->Form->input('module', array('value'=> 0, 'type' => 'hidden'));
			if($type1 == 2){		
				echo $this->Form->input('type2', array('value'=> 5, 'type' => 'hidden'));			
			}else{
				echo $this->Form->input('type2', array('value'=> 0, 'type' => 'hidden'));			
			}
		}
		if($type1 == 3){
			include_once 'images.php';
		}else{
			echo $this->Form->input('file', array('type'=>'file'));		
			echo $this->Form->input('youtube_url', array('type' => 'text'));
			echo $this->Form->input('google_drive_url', array('type' => 'text'));				
		}
		echo $this->Form->input('weight', array('default'=>0));
		echo $this->Form->input('approved');	
		echo $this->Form->input('type1', array('value'=> $type1, 'type' => 'hidden'));		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<?php include_once 'common.php';?>