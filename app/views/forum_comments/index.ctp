<div class="comments index">
	<h2><?php __('Comments');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('comment');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('approved');?></th>
			<th><?php echo $this->Paginator->sort('member_id');?></th>
			<th><?php echo $this->Paginator->sort('post_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($comments as $comment):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $comment['ForumComment']['id']; ?>&nbsp;</td>
		<td><?php echo $comment['ForumComment']['comment']; ?>&nbsp;</td>
		<td><?php echo $comment['ForumComment']['created']; ?>&nbsp;</td>
		<td><?php echo $comment['ForumComment']['approved']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($comment['Member']['fullname'], array('controller' => 'members', 'action' => 'view', $comment['Member']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($comment['Post']['title'], array('controller' => 'posts', 'action' => 'view', $comment['Post']['id'])); ?>
		</td>
		<td class="actions">
			<?php if($comment['ForumComment']['approved'] == 0){
				echo $this->Html->link(__('Approve', true), array('action' => 'approve', $comment['ForumComment']['id'], 1), null, sprintf(__('Are you sure you want to approve # %s?', true), $comment['ForumComment']['id']));
			}elseif($comment['ForumComment']['approved'] == 1){
				echo $this->Html->link(__('Un-approve', true), array('action' => 'approve', $comment['ForumComment']['id'], 0), null, sprintf(__('Are you sure you want to un-approve # %s?', true), $comment['ForumComment']['id']));
			}?>
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $comment['ForumComment']['id'])); ?>
			<?php //echo $this->Html->link(__('Edit', true), array('action' => 'edit', $comment['ForumComment']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $comment['ForumComment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $comment['ForumComment']['id'])); ?>
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
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>