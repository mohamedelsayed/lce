<div class="libraries index">
	<?php //echo $this->element('forum/search_view',array('currentModel' => 'Library', 'currentField' => 'title'));?>
	<?php /*<h2><?php __('Libraries');?></h2>*/?>
	<div class="add_action_button"><?php echo $this->Html->link(__('Add Library', true), array('action' => 'add')); ?></div>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<?php /*<th><?php echo $this->Paginator->sort('parent_id');?></th>*/?>
			<th><?php echo $this->Paginator->sort('weight');?></th>
			<th><?php echo $this->Paginator->sort('approved');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($libraries as $library):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $library['Library']['id']; ?>&nbsp;</td>
		<td><?php echo $library['Library']['title']; ?>&nbsp;</td>
		<?php /*<td>
			<?php echo $this->Html->link($library['ParentLibrary']['title'], array('controller' => 'libraries', 'action' => 'view', $library['ParentLibrary']['id'])); ?>
		</td>*/?>
		<td><?php echo $library['Library']['weight']; ?>&nbsp;</td>
		<td>
			<?php if($library['Library']['approved'] == 1) echo 'Yes';
			elseif($library['Library']['approved'] == 0) echo 'No';?>
		</td>
		<td><?php echo $library['Library']['created']; ?>&nbsp;</td>
		<td><?php echo $library['Library']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $library['Library']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $library['Library']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $library['Library']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $library['Library']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p class="paginatorcounter">
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