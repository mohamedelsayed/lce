<div class="geographys view">
<h2><?php  __('Geography');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $geography['Geography']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $geography['Geography']['title']; ?>
			&nbsp;
		</dd>
		<?php /*<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Body'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $geography['Geography']['body']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Meta Keywords'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $geography['Geography']['meta_keywords']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Meta Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $geography['Geography']['meta_description']; ?>
			&nbsp;
		</dd>*/?>
		<?php /*<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Artist'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($geography['Artist']['name'], array('controller' => 'artists', 'action' => 'view', $geography['Artist']['id'])); ?>
			&nbsp;
		</dd>*//*?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Geography Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $geography['Geography']['geography_type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Parent Geography'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($geography['ParentGeography']['title'], array('controller' => 'geographys', 'action' => 'view', $geography['ParentGeography']['id'])); ?>
			&nbsp;
		</dd>*/?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Weight'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $geography['Geography']['weight']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
		<?php if($geography['Geography']['approved'] == 1) echo 'Yes';
		elseif($geography['Geography']['approved'] == 0) echo 'No';?>&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $geography['Geography']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $geography['Geography']['updated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Geography', true), array('action' => 'edit', $geography['Geography']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Geography', true), array('action' => 'delete', $geography['Geography']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $geography['Geography']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Geographys', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Geography', true), array('action' => 'add')); ?> </li>
		<?php /*<li><?php //echo $this->Html->link(__('List Artists', true), array('controller' => 'artists', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Artist', true), array('controller' => 'artists', 'action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Geographys', true), array('controller' => 'geographys', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Parent Geography', true), array('controller' => 'geographys', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Nodes', true), array('controller' => 'nodes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Node', true), array('controller' => 'nodes', 'action' => 'add')); ?> </li>*/?>
	</ul>
</div>
<?php /*<div class="related">
	<h3><?php __('Related Geographys');?></h3>
	<?php if (!empty($geography['ChildGeography'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<?php /*<th><?php __('Body'); ?></th>
		<th><?php __('Meta Keywords'); ?></th>
		<th><?php __('Meta Description'); ?></th>
		<th><?php __('Artist Id'); ?></th>
		<th><?php __('Geography Type'); ?></th>?>
		<th><?php __('Parent Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($geography['ChildGeography'] as $childGeography):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $childGeography['id'];?></td>
			<td><?php echo $childGeography['title'];?></td>
			<?php /*<td><?php echo $childGeography['body'];?></td>
			<td><?php echo $childGeography['meta_keywords'];?></td>
			<td><?php echo $childGeography['meta_description'];?></td>
			<td><?php echo $childGeography['artist_id'];?></td>
			<td><?php echo $childGeography['geography_type'];?></td>?>
			<td><?php echo $childGeography['parent_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'geographys', 'action' => 'view', $childGeography['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'geographys', 'action' => 'edit', $childGeography['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'geographys', 'action' => 'delete', $childGeography['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $childGeography['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Child Geography', true), array('controller' => 'geographys', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Nodes');?></h3>
	<?php if (!empty($geography['Node'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<?php /*<th><?php __('Teaser'); ?></th>
		<th><?php __('Body'); ?></th>
		<th><?php __('Node Type'); ?></th>
		<th><?php __('Viewed'); ?></th>?>
		<th><?php __('Created'); ?></th>
		<th><?php __('Updated'); ?></th>
		<th><?php __('Approved'); ?></th>
		<th><?php __('Geography Id'); ?></th>
		<?php /*<th><?php __('Artist Id'); ?></th>
		<th><?php __('Meta Keywords'); ?></th>
		<th><?php __('Meta Description'); ?></th>?>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($geography['Node'] as $node):
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
			<td><?php echo $node['viewed'];?></td>/?>
			<td><?php echo $node['created'];?></td>
			<td><?php echo $node['updated'];?></td>
			<td><?php echo $node['approved'];?></td>
			<td><?php echo $node['geography_id'];?></td>
			<?php /*<td><?php echo $node['artist_id'];?></td>
			<td><?php echo $node['meta_keywords'];?></td>
			<td><?php echo $node['meta_description'];?></td>/?>
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
</div>*/?>