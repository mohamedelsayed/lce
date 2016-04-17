<div class="slideshows index">
	<h2><?php __('Logos');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('url');?></th>
			<?php /*<th><?php echo $this->Paginator->sort('target');?></th>*/?>
			<th><?php echo $this->Paginator->sort('approved');?></th>
			<th><?php echo $this->Paginator->sort('weight');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($logos as $logo):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $logo['Logo']['id']; ?>&nbsp;</td>
		<td><?php echo $logo['Logo']['title']; ?>&nbsp;</td>
		<td><?php echo $logo['Logo']['url']; ?>&nbsp;</td>
		<?php /*<td><?php echo $logo['Logo']['target']; ?>&nbsp;</td>*/?>
		<td><?php echo $logo['Logo']['approved']; ?>&nbsp;</td>
		<td><?php echo $logo['Logo']['weight']; ?>&nbsp;</td>
		<td><?php echo $logo['Logo']['created']; ?>&nbsp;</td>
		<td><?php echo $logo['Logo']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $logo['Logo']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $logo['Logo']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $logo['Logo']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $logo['Logo']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Logo', true), array('action' => 'add')); ?></li>
	</ul>
</div>