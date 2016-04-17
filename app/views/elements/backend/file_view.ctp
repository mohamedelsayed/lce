<?php
if($fileName){
	if($this->action == 'edit')$delete = true; else $delete = false;
	echo $this->Html->link('Download: '.$fileName, 
						   $this->Session->read('Setting.url')."/app/webroot/files/upload/$fileName",
						   array('target' => '_blank', 'title'=>'Download', 'escape' => false));
	if($delete)					   
		echo '&nbsp;&nbsp;&nbsp;'.$this->Html->link(__('Delete File', true), array('action' => 'deleteFile', $id), null, __('Are you sure you want to delete this file?', true));
}
else echo __('No File Found.', true);	 
?>