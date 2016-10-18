<div class="members index">
	<?php /*<h2><?php __('Members');?></h2>*/?>
	<div class="add_action_button"><?php echo $this->Html->link(__('Add Contact', true), array('action' => 'add')); ?></div>
	<?php $key = '';
	if(isset($_GET['key'])){
		$key = $_GET['key'];
	}?>
	<div class="filter_form">
		<?php echo $this->Form->create('Member', array('url' => $actual_link, 'type' => 'get'));
		echo $this->Form->input('Member'.'.'.'key', array('label' => '', 'value' => $key));
		echo $this->Form->end(__('Search', true));?>
	</div>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('fullname');?></th>
			<th><?php echo $this->Paginator->sort('username');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>
			<th><?php echo $this->Paginator->sort('role');?></th>
			<th><?php echo $this->Paginator->sort('approved');?></th>
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
				<td>
					<?php if($member['Member']['approved'] == 1) echo 'Yes';
					elseif($member['Member']['approved'] == 0) echo 'No';?>
				</td>
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