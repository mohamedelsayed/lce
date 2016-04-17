<div class="members index">
	<?php /*<h2><?php __('Members');?></h2>*/?>
	<div class="add_action_button"><?php echo $this->Html->link(__('Add Member', true), array('action' => 'add')); ?></div>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('fullname');?></th>
			<th><?php echo $this->Paginator->sort('username');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>
			<th><?php echo $this->Paginator->sort('role');?></th>
			<th class="actions"><?php __('Actions');?></th>
		</tr>
		<?php
		$i = 0;
		foreach ($members as $member):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
			?>
			<tr<?php echo $class;?>>
				<td><?php echo $member['Member']['id']; ?>&nbsp;</td>
				<td><?php echo $member['Member']['fullname']; ?>&nbsp;</td>
				<td><?php echo $member['Member']['username']; ?>&nbsp;</td>
				<td><?php echo $member['Member']['email']; ?>&nbsp;</td>
				<td><?php echo $roles[$member['Member']['role']]; ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View', true), array('action' => 'view', $member['Member']['id'])); ?>
					<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $member['Member']['id'])); ?>
					<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $member['Member']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $member['Member']['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
	<p class="paginatorcounter">
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>
	<div class="paging">
	<?php echo $this->Paginator->first('<< ' . __('first', true), array(), null, array('class'=>'disabled'));?>
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
		<?php echo $this->Paginator->last(__('last', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<?php /*<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Member', true), array('action' => 'add')); ?></li>
	</ul>
</div>*/?>