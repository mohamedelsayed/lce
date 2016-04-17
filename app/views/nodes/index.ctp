<div class="nodes index">
	<?php echo $this->element('backend/search_view',array('currentModel' => 'Node', 'currentField' => 'title'));?>
	<h2><?php __('Nodes');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<?php /*<th><?php echo $this->Paginator->sort('teaser');?></th>
			<th><?php echo $this->Paginator->sort('body');?></th>
			<th><?php echo $this->Paginator->sort('node_type');?></th>
			<th><?php echo $this->Paginator->sort('viewed');?></th>*/?>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>
			<th><?php echo $this->Paginator->sort('approved');?></th>	
			<th><?php echo $this->Paginator->sort('weight');?></th>		
			<?php /*<th><?php echo $this->Paginator->sort('artist_id');?></th>*/?>
			<th><?php echo $this->Paginator->sort('cat_id');?></th>
			<?php /*<th><?php echo $this->Paginator->sort('meta_keywords');?></th>
			<th><?php echo $this->Paginator->sort('meta_description');?></th>*/?>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($nodes as $node):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $node['Node']['id']; ?>&nbsp;</td>
		<td><?php echo $node['Node']['title']; ?>&nbsp;</td>
		<?php /*<td><?php echo $node['Node']['teaser']; ?>&nbsp;</td>
		<td><?php echo $node['Node']['body']; ?>&nbsp;</td>
		<td><?php echo $node['Node']['node_type']; ?>&nbsp;</td>
		<td><?php echo $node['Node']['viewed']; ?>&nbsp;</td>*/?>
		<td><?php echo $node['Node']['created']; ?>&nbsp;</td>
		<td><?php echo $node['Node']['updated']; ?>&nbsp;</td>
		<td><?php if($node['Node']['approved'] == 1) echo 'Yes';
		elseif($node['Node']['approved'] == 0) echo 'No';?>&nbsp;</td>	
		<td><?php echo $node['Node']['weight']; ?>&nbsp;</td>	
		<?php /*<td>
			<?php echo $this->Html->link($node['Artist']['name'], array('controller' => 'artists', 'action' => 'view', $node['Artist']['id'])); ?>
		</td>*/?>
		<td>
			<?php echo $this->Html->link($node['Cat']['title'], array('controller' => 'cats', 'action' => 'view', $node['Cat']['id'])); ?>
		</td>
		<?php /*<td><?php echo $node['Node']['meta_keywords']; ?>&nbsp;</td>
		<td><?php echo $node['Node']['meta_description']; ?>&nbsp;</td>*/?>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $node['Node']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $node['Node']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $node['Node']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $node['Node']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Node', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Cats', true), array('controller' => 'cats', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cat', true), array('controller' => 'cats', 'action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Artists', true), array('controller' => 'artists', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Artist', true), array('controller' => 'artists', 'action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Gals', true), array('controller' => 'gals', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Gal', true), array('controller' => 'gals', 'action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Videos', true), array('controller' => 'videos', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Video', true), array('controller' => 'videos', 'action' => 'add')); ?> </li>
	</ul>
</div>