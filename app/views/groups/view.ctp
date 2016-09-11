<div class="groups view">
<h2><?php  __('Group');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $group['Group']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $group['Group']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Weight'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $group['Group']['weight']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
		<?php if($group['Group']['approved'] == 1) echo 'Yes';
		elseif($group['Group']['approved'] == 0) echo 'No';?>&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $group['Group']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $group['Group']['updated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Group', true), array('action' => 'edit', $group['Group']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Group', true), array('action' => 'delete', $group['Group']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $group['Group']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Members');?></h3>
	<?php if (!empty($group['Member'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Full Name'); ?></th>
		<?php /*<th><?php __('Teaser'); ?></th>
		<th><?php __('Body'); ?></th>
		<th><?php __('Member Type'); ?></th>
		<th><?php __('Viewed'); ?></th>*/?>
		<th><?php __('Email'); ?></th>
		<th><?php __('Mobile'); ?></th>
		<th><?php __('Approved'); ?></th>
		<?php /*<th><?php __('Artist Id'); ?></th>
		<th><?php __('Meta Keywords'); ?></th>
		<th><?php __('Meta Description'); ?></th>*/?>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($group['Member'] as $member):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $member['id'];?></td>
			<td><?php echo $member['fullname'];?></td>
			<?php /*<td><?php echo $member['teaser'];?></td>
			<td><?php echo $member['body'];?></td>
			<td><?php echo $member['member_type'];?></td>
			<td><?php echo $member['viewed'];?></td>*/?>
			<td><?php echo $member['email'];?></td>
			<td><?php echo $member['mobile'];?></td>
			<td>
				<?php if($member['approved'] == 1) echo 'Yes';
				elseif($member['approved'] == 0) echo 'No';?>&nbsp;
			</td>
			<?php /*<td><?php echo $member['artist_id'];?></td>
			<td><?php echo $member['meta_keywords'];?></td>
			<td><?php echo $member['meta_description'];?></td>*/?>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'members', 'action' => 'view', $member['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'members', 'action' => 'edit', $member['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'members', 'action' => 'delete', $member['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $member['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Member', true), array('controller' => 'members', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>