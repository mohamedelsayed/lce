<div class="values index">
	<?php echo $this->element('backend/search_view',array('currentModel' => 'Value', 'currentField' => 'title'));?>
	<h2><?php __('Values');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('weight');?></th>
			<th><?php echo $this->Paginator->sort('approved');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($values as $value):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $value['Value']['id']; ?>&nbsp;</td>
		<td><?php echo $value['Value']['title']; ?>&nbsp;</td>
		<td><?php echo $value['Value']['weight'];?>&nbsp;</td>
		<td><?php if($value['Value']['approved'] == 1) echo 'Yes';
        elseif($value['Value']['approved'] == 0) echo 'No';?>&nbsp;</td> 
		<td><?php echo $value['Value']['created']; ?>&nbsp;</td>
		<td><?php echo $value['Value']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $value['Value']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $value['Value']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $value['Value']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $value['Value']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>
	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Value', true), array('action' => 'add')); ?></li>
	</ul>
</div>