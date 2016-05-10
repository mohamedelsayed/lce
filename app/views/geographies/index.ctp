<div class="geographys index">
	<?php echo $this->element('backend/search_view',array('currentModel' => 'Geography', 'currentField' => 'title'));?>
	<h2><?php __('Geographies');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<?php /*<th><?php echo $this->Paginator->sort('body');?></th>
			<th><?php echo $this->Paginator->sort('meta_keywords');?></th>
			<th><?php echo $this->Paginator->sort('meta_description');?></th>*/?>
			<?php /*<th><?php echo $this->Paginator->sort('artist_id');?></th>*/?>
			<?php /*<th><?php echo $this->Paginator->sort('geography_type');?></th>*/?>
			<th><?php echo $this->Paginator->sort('weight');?></th>
			<th><?php echo $this->Paginator->sort('approved');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($geographys as $geography):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $geography['Geography']['id']; ?>&nbsp;</td>
		<td><?php echo $geography['Geography']['title']; ?>&nbsp;</td>
		<?php /*<td><?php echo $geography['Geography']['body']; ?>&nbsp;</td>
		<td><?php echo $geography['Geography']['meta_keywords']; ?>&nbsp;</td>
		<td><?php echo $geography['Geography']['meta_description']; ?>&nbsp;</td>*/?>
		<?php /*<td>
			<?php echo $this->Html->link($geography['Artist']['name'], array('controller' => 'artists', 'action' => 'view', $geography['Artist']['id'])); ?>
		</td>*/?>
		<?php /*<td><?php echo $geography['Geography']['geography_type']; ?>&nbsp;</td>*/?>
		<td><?php echo $geography['Geography']['weight']; ?>&nbsp;</td>
		<td><?php if($geography['Geography']['approved'] == 1) echo 'Yes';
		elseif($geography['Geography']['approved'] == 0) echo 'No';?>&nbsp;</td>	
		<td><?php echo $geography['Geography']['created']; ?>&nbsp;</td>
		<td><?php echo $geography['Geography']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $geography['Geography']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $geography['Geography']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $geography['Geography']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $geography['Geography']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Geography', true), array('action' => 'add')); ?></li>
		<li><?php //echo $this->Html->link(__('List Artists', true), array('controller' => 'artists', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Artist', true), array('controller' => 'artists', 'action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Geographys', true), array('controller' => 'geographys', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Parent Geography', true), array('controller' => 'geographys', 'action' => 'add')); ?> </li>
	</ul>
</div>