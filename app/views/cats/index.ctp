<div class="cats index">
	<?php echo $this->element('backend/search_view',array('currentModel' => 'Cat', 'currentField' => 'title'));?>
	<h2><?php __('Cats');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<?php /*<th><?php echo $this->Paginator->sort('body');?></th>
			<th><?php echo $this->Paginator->sort('meta_keywords');?></th>
			<th><?php echo $this->Paginator->sort('meta_description');?></th>*/?>
			<?php /*<th><?php echo $this->Paginator->sort('artist_id');?></th>*/?>
			<?php /*<th><?php echo $this->Paginator->sort('cat_type');?></th>*/?>
			<th><?php echo $this->Paginator->sort('parent_id');?></th>
			<th><?php echo $this->Paginator->sort('weight');?></th>
			<th><?php echo $this->Paginator->sort('approved');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($cats as $cat):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $cat['Cat']['id']; ?>&nbsp;</td>
		<td><?php echo $cat['Cat']['title']; ?>&nbsp;</td>
		<?php /*<td><?php echo $cat['Cat']['body']; ?>&nbsp;</td>
		<td><?php echo $cat['Cat']['meta_keywords']; ?>&nbsp;</td>
		<td><?php echo $cat['Cat']['meta_description']; ?>&nbsp;</td>*/?>
		<?php /*<td>
			<?php echo $this->Html->link($cat['Artist']['name'], array('controller' => 'artists', 'action' => 'view', $cat['Artist']['id'])); ?>
		</td>*/?>
		<?php /*<td><?php echo $cat['Cat']['cat_type']; ?>&nbsp;</td>*/?>
		<td>
			<?php echo $this->Html->link($cat['ParentCat']['title'], array('controller' => 'cats', 'action' => 'view', $cat['ParentCat']['id'])); ?>
		</td>
		<td><?php echo $cat['Cat']['weight']; ?>&nbsp;</td>
		<td><?php echo $cat['Cat']['approved']; ?>&nbsp;</td>
		<td><?php echo $cat['Cat']['created']; ?>&nbsp;</td>
		<td><?php echo $cat['Cat']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $cat['Cat']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $cat['Cat']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $cat['Cat']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $cat['Cat']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Cat', true), array('action' => 'add')); ?></li>
		<li><?php //echo $this->Html->link(__('List Artists', true), array('controller' => 'artists', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Artist', true), array('controller' => 'artists', 'action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Cats', true), array('controller' => 'cats', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Parent Cat', true), array('controller' => 'cats', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Nodes', true), array('controller' => 'nodes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Node', true), array('controller' => 'nodes', 'action' => 'add')); ?> </li>
	</ul>
</div>