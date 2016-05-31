<div class="nevent_orders index">
	<h2><?php __('Events Checkouts');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>
			<?php /*<th><?php echo $this->Paginator->sort('biography');?></th>
			<th><?php echo $this->Paginator->sort('image');?></th>
			<th><?php echo $this->Paginator->sort('mail');?></th>
			<th><?php echo $this->Paginator->sort('linkedin');?></th>*/?>
			<th><?php echo $this->Paginator->sort('event_id');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<?php /*<th><?php echo $this->Paginator->sort('updated');?></th>*/?>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($nevent_orders as $nevent_order):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $nevent_order['NeventOrder']['id']; ?>&nbsp;</td>
		<td><?php echo $nevent_order['NeventOrder']['name']; ?>&nbsp;</td>
		<td><?php echo $nevent_order['NeventOrder']['email']; ?>&nbsp;</td>
		<?php /*<td><?php echo $nevent_order['NeventOrder']['biography']; ?>&nbsp;</td>
		<td><?php echo $nevent_order['NeventOrder']['image']; ?>&nbsp;</td>
		<td><?php echo $nevent_order['NeventOrder']['mail']; ?>&nbsp;</td>
		<td><?php echo $nevent_order['NeventOrder']['linkedin']; ?>&nbsp;</td>*/?>
		<td><?php echo $nevent_order['Nevent']['title']; ?>&nbsp;</td>
		<td><?php echo $nevent_order['NeventOrder']['created']; ?>&nbsp;</td>
		<?php /*<td><?php echo $nevent_order['NeventOrder']['updated']; ?>&nbsp;</td>*/?>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $nevent_order['NeventOrder']['id'])); ?>
			<?php //echo $this->Html->link(__('Edit', true), array('action' => 'edit', $nevent_order['NeventOrder']['id'])); ?>
			<?php //echo $this->Html->link(__('Delete', true), array('action' => 'delete', $nevent_order['NeventOrder']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $nevent_order['NeventOrder']['id'])); ?>
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
<?php /*<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php //echo $this->Html->link(__('New NeventOrder', true), array('action' => 'add')); ?></li>
	</ul>
</div>*/?>