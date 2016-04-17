<?php 
if(!empty($attachments)){
	if($this->action == 'edit')$delete = true;
?>
<table cellpadding="0" cellspacing="0">
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>File</th>
        <th>Downloads</th>
        <th class="actions"><?php __('Actions');?></th>
    </tr>
    <?php
    $i = 0;
    foreach ($attachments as $attachment){
        $class = null;
        if ($i++ % 2 == 0) {
            $class = ' class="altrow"';
        }
    ?>
    <tr<?php echo $class;?>>
        <td><?php echo $attachment['id']; ?>&nbsp;</td>
        <td><?php echo $attachment['title']; ?>&nbsp;</td>
        <td><?php echo $attachment['file']; ?>&nbsp;</td>
        <td><?php echo $attachment['downloads']; ?>&nbsp;</td>
        <td class="actions">
            <?php
			echo $this->Html->link(
				'Download',
				$this->Session->read('Setting.url')."/app/webroot/files/upload/".$attachment['file'],
				array('target' => '_blank', 'title'=>'Download', 'escape' => false));
				if(isset($delete)){
					echo $this->Html->link(
						'Delete', 
						array('controller' => 'attachments/deleteAttachment/'.$attachment['id']),
						null,
						sprintf(__('Are you sure you want to delete #%s', true), $attachment['id']));
				}	
			?>
        </td>
    </tr>
    <?php } ?>
</table>
 <?php } else echo __('No Attachment Found.', true);?>               