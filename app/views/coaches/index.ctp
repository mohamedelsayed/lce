<div class="coaches index">
	<h2><?php __('Coaches');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<?php /*<th><?php echo $this->Paginator->sort('position');?></th>
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
	foreach ($coaches as $coach):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $coach['Coach']['id']; ?>&nbsp;</td>
		<td><?php echo $coach['Coach']['name']; ?>&nbsp;</td>
		<?php /*<td><?php echo $coach['Coach']['position']; ?>&nbsp;</td>
		<?php /*<td><?php echo $coach['Coach']['biography']; ?>&nbsp;</td>
		<td><?php echo $coach['Coach']['image']; ?>&nbsp;</td>
		<td><?php echo $coach['Coach']['mail']; ?>&nbsp;</td>
		<td><?php echo $coach['Coach']['linkedin']; ?>&nbsp;</td>*/?>
		<td><?php echo $coach['Coach']['weight']; ?>&nbsp;</td>
		<td><?php echo $coach['Coach']['created']; ?>&nbsp;</td>
		<td><?php echo $coach['Coach']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $coach['Coach']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $coach['Coach']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $coach['Coach']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $coach['Coach']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Coach', true), array('action' => 'add')); ?></li>
	</ul>
</div>