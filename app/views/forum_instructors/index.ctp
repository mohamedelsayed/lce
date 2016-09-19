<div class="instructors index">
	<div class="add_action_button"><?php echo $this->Html->link(__('Add Instructor', true), array('action' => 'add')); ?></div>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('position');?></th>
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
	foreach ($instructors as $instructor):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $instructor['Instructor']['id']; ?>&nbsp;</td>
		<td><?php echo $instructor['Instructor']['name']; ?>&nbsp;</td>
		<td><?php echo $instructor['Instructor']['position']; ?>&nbsp;</td>
		<?php /*<td><?php echo $instructor['Instructor']['biography']; ?>&nbsp;</td>
		<td><?php echo $instructor['Instructor']['image']; ?>&nbsp;</td>
		<td><?php echo $instructor['Instructor']['mail']; ?>&nbsp;</td>
		<td><?php echo $instructor['Instructor']['linkedin']; ?>&nbsp;</td>*/?>
		<td><?php echo $instructor['Instructor']['weight']; ?>&nbsp;</td>
		<td><?php echo $instructor['Instructor']['created']; ?>&nbsp;</td>
		<td><?php echo $instructor['Instructor']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $instructor['Instructor']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $instructor['Instructor']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $instructor['Instructor']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $instructor['Instructor']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Instructor', true), array('action' => 'add')); ?></li>
	</ul>
</div>