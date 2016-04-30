<div class="specializations index">
	<?php echo $this->element('backend/search_view',array('currentModel' => 'Specialization', 'currentField' => 'title'));?>
	<h2><?php __('Specializations');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<?php /*<th><?php echo $this->Paginator->sort('body');?></th>
			<th><?php echo $this->Paginator->sort('meta_keywords');?></th>
			<th><?php echo $this->Paginator->sort('meta_description');?></th>*/?>
			<?php /*<th><?php echo $this->Paginator->sort('artist_id');?></th>*/?>
			<?php /*<th><?php echo $this->Paginator->sort('specialization_type');?></th>*/?>
			<th><?php echo $this->Paginator->sort('weight');?></th>
			<th><?php echo $this->Paginator->sort('approved');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($specializations as $specialization):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $specialization['Specialization']['id']; ?>&nbsp;</td>
		<td><?php echo $specialization['Specialization']['title']; ?>&nbsp;</td>
		<?php /*<td><?php echo $specialization['Specialization']['body']; ?>&nbsp;</td>
		<td><?php echo $specialization['Specialization']['meta_keywords']; ?>&nbsp;</td>
		<td><?php echo $specialization['Specialization']['meta_description']; ?>&nbsp;</td>*/?>
		<?php /*<td>
			<?php echo $this->Html->link($specialization['Artist']['name'], array('controller' => 'artists', 'action' => 'view', $specialization['Artist']['id'])); ?>
		</td>*/?>
		<?php /*<td><?php echo $specialization['Specialization']['specialization_type']; ?>&nbsp;</td>*/?>
		<td><?php echo $specialization['Specialization']['weight']; ?>&nbsp;</td>
		<td><?php if($specialization['Specialization']['approved'] == 1) echo 'Yes';
		elseif($specialization['Specialization']['approved'] == 0) echo 'No';?>&nbsp;</td>	
		<td><?php echo $specialization['Specialization']['created']; ?>&nbsp;</td>
		<td><?php echo $specialization['Specialization']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $specialization['Specialization']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $specialization['Specialization']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $specialization['Specialization']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $specialization['Specialization']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Specialization', true), array('action' => 'add')); ?></li>
		<li><?php //echo $this->Html->link(__('List Artists', true), array('controller' => 'artists', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Artist', true), array('controller' => 'artists', 'action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Specializations', true), array('controller' => 'specializations', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Parent Specialization', true), array('controller' => 'specializations', 'action' => 'add')); ?> </li>
	</ul>
</div>