<div class="cats view">
<h2><?php  __('Cat');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cat['Cat']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cat['Cat']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Body'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cat['Cat']['body']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Meta Keywords'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cat['Cat']['meta_keywords']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Meta Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cat['Cat']['meta_description']; ?>
			&nbsp;
		</dd>
		<?php /*<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Artist'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($cat['Artist']['name'], array('controller' => 'artists', 'action' => 'view', $cat['Artist']['id'])); ?>
			&nbsp;
		</dd>*/?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cat Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cat['Cat']['cat_type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Parent Cat'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($cat['ParentCat']['title'], array('controller' => 'cats', 'action' => 'view', $cat['ParentCat']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Weight'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cat['Cat']['weight']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
		<?php if($cat['Cat']['approved'] == 1) echo 'Yes';
		elseif($cat['Cat']['approved'] == 0) echo 'No';?>&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cat['Cat']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cat['Cat']['updated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Cat', true), array('action' => 'edit', $cat['Cat']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Cat', true), array('action' => 'delete', $cat['Cat']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $cat['Cat']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Cats', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cat', true), array('action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Artists', true), array('controller' => 'artists', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Artist', true), array('controller' => 'artists', 'action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Cats', true), array('controller' => 'cats', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Parent Cat', true), array('controller' => 'cats', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Nodes', true), array('controller' => 'nodes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Node', true), array('controller' => 'nodes', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Cats');?></h3>
	<?php if (!empty($cat['ChildCat'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<?php /*<th><?php __('Body'); ?></th>
		<th><?php __('Meta Keywords'); ?></th>
		<th><?php __('Meta Description'); ?></th>
		<th><?php __('Artist Id'); ?></th>
		<th><?php __('Cat Type'); ?></th>*/?>
		<th><?php __('Parent Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($cat['ChildCat'] as $childCat):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $childCat['id'];?></td>
			<td><?php echo $childCat['title'];?></td>
			<?php /*<td><?php echo $childCat['body'];?></td>
			<td><?php echo $childCat['meta_keywords'];?></td>
			<td><?php echo $childCat['meta_description'];?></td>
			<td><?php echo $childCat['artist_id'];?></td>
			<td><?php echo $childCat['cat_type'];?></td>*/?>
			<td><?php echo $childCat['parent_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'cats', 'action' => 'view', $childCat['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'cats', 'action' => 'edit', $childCat['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'cats', 'action' => 'delete', $childCat['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $childCat['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Child Cat', true), array('controller' => 'cats', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Nodes');?></h3>
	<?php if (!empty($cat['Node'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<?php /*<th><?php __('Teaser'); ?></th>
		<th><?php __('Body'); ?></th>
		<th><?php __('Node Type'); ?></th>
		<th><?php __('Viewed'); ?></th>*/?>
		<th><?php __('Created'); ?></th>
		<th><?php __('Updated'); ?></th>
		<th><?php __('Approved'); ?></th>
		<th><?php __('Cat Id'); ?></th>
		<?php /*<th><?php __('Artist Id'); ?></th>
		<th><?php __('Meta Keywords'); ?></th>
		<th><?php __('Meta Description'); ?></th>*/?>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($cat['Node'] as $node):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $node['id'];?></td>
			<td><?php echo $node['title'];?></td>
			<?php /*<td><?php echo $node['teaser'];?></td>
			<td><?php echo $node['body'];?></td>
			<td><?php echo $node['node_type'];?></td>
			<td><?php echo $node['viewed'];?></td>*/?>
			<td><?php echo $node['created'];?></td>
			<td><?php echo $node['updated'];?></td>
			<td><?php echo $node['approved'];?></td>
			<td><?php echo $node['cat_id'];?></td>
			<?php /*<td><?php echo $node['artist_id'];?></td>
			<td><?php echo $node['meta_keywords'];?></td>
			<td><?php echo $node['meta_description'];?></td>*/?>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'nodes', 'action' => 'view', $node['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'nodes', 'action' => 'edit', $node['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'nodes', 'action' => 'delete', $node['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $node['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Node', true), array('controller' => 'nodes', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>