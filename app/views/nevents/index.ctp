<div class="nevents index">
	<h2><?php __('Events');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<?php /*<th><?php echo $this->Paginator->sort('biography');?></th>
			<th><?php echo $this->Paginator->sort('image');?></th>
			<th><?php echo $this->Paginator->sort('mail');?></th>
			<th><?php echo $this->Paginator->sort('linkedin');?></th>*/?>
			<th><?php echo $this->Paginator->sort('weight');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($nevents as $nevent):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $nevent['Nevent']['id']; ?>&nbsp;</td>
		<td><?php echo $nevent['Nevent']['title']; ?>&nbsp;</td>
		<?php /*<td><?php echo $nevent['Nevent']['biography']; ?>&nbsp;</td>
		<td><?php echo $nevent['Nevent']['image']; ?>&nbsp;</td>
		<td><?php echo $nevent['Nevent']['mail']; ?>&nbsp;</td>
		<td><?php echo $nevent['Nevent']['linkedin']; ?>&nbsp;</td>*/?>
		<td><?php echo $nevent['Nevent']['weight']; ?>&nbsp;</td>
		<td><?php echo $nevent['Nevent']['created']; ?>&nbsp;</td>
		<td><?php echo $nevent['Nevent']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $nevent['Nevent']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $nevent['Nevent']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $nevent['Nevent']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $nevent['Nevent']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Event', true), array('action' => 'add')); ?></li>
	</ul>
</div>