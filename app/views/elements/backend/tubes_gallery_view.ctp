<?php 
if(!empty($gallery)){
	if($this->action == 'edit')$delete = true; else $delete = false;
?>
<div id="result">
<?php echo $this->element('backend/tube_view', array("src" =>$gallery[0]['url'], "width"=>400, "height"=>300));?>
</div>
<table cellpadding="0" cellspacing="0">
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Url</th>
        <th class="actions"><?php __('Actions');?></th>
    </tr>
    <?php
    $i = 0;
    foreach ($gallery as $record){
        $class = null;
        if ($i++ % 2 == 0) {
            $class = ' class="altrow"';
        }
    ?>
    <tr<?php echo $class;?>>
        <td><?php echo $record['id']; ?>&nbsp;</td>
        <td><b style="cursor:pointer" onclick="$('iframe').attr('src', '<?=$record['url'];?>')"><?php echo $record['title']; ?>&nbsp;</b></td>
        <td><b style="cursor:pointer" onclick="$('iframe').attr('src', '<?=$record['url'];?>')"><?php echo $record['url']; ?>&nbsp;</b></td>
        <td class="actions">
            <?php
            if($delete)
				echo $this->Html->link(__('Delete', true), array('controller' => 'tubes/deleteTube/'.$record['id']), null, __('Are you sure you want to delete this Tube?', true));
			
			?>
        </td>
    </tr>
    <?php } ?>
</table>
 <?php } else echo __('No Tubes Found.', true);?>               