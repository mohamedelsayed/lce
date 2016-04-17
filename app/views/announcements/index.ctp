<div class="announcements index">
	<?php //echo $this->element('forum/search_view',array('currentModel' => 'Announcement', 'currentField' => 'title'));?>
	<?php /*<h2><?php __('Announcements');?></h2>*/?>
	<div class="add_action_button"><?php echo $this->Html->link(__('Add Announcement', true), array('action' => 'add')); ?></div>
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
	foreach ($announcements as $announcement):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $announcement['Announcement']['id']; ?>&nbsp;</td>
		<td><?php echo $announcement['Announcement']['title']; ?>&nbsp;</td>
		<td><?php echo $announcement['Announcement']['weight']; ?>&nbsp;</td>
		<td><?php echo $announcement['Announcement']['approved']; ?>&nbsp;</td>
		<td><?php echo $announcement['Announcement']['created']; ?>&nbsp;</td>
		<td><?php echo $announcement['Announcement']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Send', true), array('action' => 'sendannouncement', $announcement['Announcement']['id'])); ?>
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $announcement['Announcement']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $announcement['Announcement']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $announcement['Announcement']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $announcement['Announcement']['id'])); ?>
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