<div class="specializations view">
<h2><?php  __('Specialization');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $specialization['Specialization']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $specialization['Specialization']['title']; ?>
			&nbsp;
		</dd>
		<?php /*<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Body'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $specialization['Specialization']['body']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Meta Keywords'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $specialization['Specialization']['meta_keywords']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Meta Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $specialization['Specialization']['meta_description']; ?>
			&nbsp;
		</dd>*/?>
		<?php /*<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Artist'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($specialization['Artist']['name'], array('controller' => 'artists', 'action' => 'view', $specialization['Artist']['id'])); ?>
			&nbsp;
		</dd>*//*?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Specialization Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $specialization['Specialization']['specialization_type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Parent Specialization'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($specialization['ParentSpecialization']['title'], array('controller' => 'specializations', 'action' => 'view', $specialization['ParentSpecialization']['id'])); ?>
			&nbsp;
		</dd>*/?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Weight'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $specialization['Specialization']['weight']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
		<?php if($specialization['Specialization']['approved'] == 1) echo 'Yes';
		elseif($specialization['Specialization']['approved'] == 0) echo 'No';?>&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $specialization['Specialization']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $specialization['Specialization']['updated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Specialization', true), array('action' => 'edit', $specialization['Specialization']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Specialization', true), array('action' => 'delete', $specialization['Specialization']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $specialization['Specialization']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Specializations', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Specialization', true), array('action' => 'add')); ?> </li>
		<?php /*<li><?php //echo $this->Html->link(__('List Artists', true), array('controller' => 'artists', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Artist', true), array('controller' => 'artists', 'action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Specializations', true), array('controller' => 'specializations', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Parent Specialization', true), array('controller' => 'specializations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Nodes', true), array('controller' => 'nodes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Node', true), array('controller' => 'nodes', 'action' => 'add')); ?> </li>*/?>
	</ul>
</div>
<?php /*<div class="related">
	<h3><?php __('Related Specializations');?></h3>
	<?php if (!empty($specialization['ChildSpecialization'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<?php /*<th><?php __('Body'); ?></th>
		<th><?php __('Meta Keywords'); ?></th>
		<th><?php __('Meta Description'); ?></th>
		<th><?php __('Artist Id'); ?></th>
		<th><?php __('Specialization Type'); ?></th>?>
		<th><?php __('Parent Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($specialization['ChildSpecialization'] as $childSpecialization):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $childSpecialization['id'];?></td>
			<td><?php echo $childSpecialization['title'];?></td>
			<?php /*<td><?php echo $childSpecialization['body'];?></td>
			<td><?php echo $childSpecialization['meta_keywords'];?></td>
			<td><?php echo $childSpecialization['meta_description'];?></td>
			<td><?php echo $childSpecialization['artist_id'];?></td>
			<td><?php echo $childSpecialization['specialization_type'];?></td>?>
			<td><?php echo $childSpecialization['parent_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'specializations', 'action' => 'view', $childSpecialization['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'specializations', 'action' => 'edit', $childSpecialization['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'specializations', 'action' => 'delete', $childSpecialization['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $childSpecialization['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Child Specialization', true), array('controller' => 'specializations', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Nodes');?></h3>
	<?php if (!empty($specialization['Node'])):?>
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
		<th><?php __('Specialization Id'); ?></th>
		<?php /*<th><?php __('Artist Id'); ?></th>
		<th><?php __('Meta Keywords'); ?></th>
		<th><?php __('Meta Description'); ?></th>?>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($specialization['Node'] as $node):
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
			<td><?php echo $node['specialization_id'];?></td>
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