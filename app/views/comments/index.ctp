<div class="comments index">
	<h2><?php __('Comments');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('body');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('approved');?></th>
			<?php /*<th><?php echo $this->Paginator->sort('member_id');?></th>*/?>
			<th><?php echo $this->Paginator->sort('article_id');?></th>
			<?php /*<th><?php echo $this->Paginator->sort('advice_id');?></th>*/?>
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
		<td><?php echo $comment['Comment']['id']; ?>&nbsp;</td>
		<td><?php echo $comment['Comment']['name']; ?>&nbsp;</td>
		<td><?php echo $comment['Comment']['body']; ?>&nbsp;</td>
		<td><?php echo $comment['Comment']['created']; ?>&nbsp;</td>
		<td><?php echo $comment['Comment']['approved']; ?>&nbsp;</td>
		<?php /*<td>
			<?php echo $this->Html->link($comment['Member']['name'], array('controller' => 'members', 'action' => 'view', $comment['Member']['id'])); ?>
		</td>*/?>
		<td>
			<?php echo $this->Html->link($comment['Article']['title'], array('controller' => 'articles', 'action' => 'view', $comment['Article']['id'])); ?>
		</td>
		<?php /*<td>
			<?php echo $this->Html->link($comment['Advice']['question'], array('controller' => 'advices', 'action' => 'view', $comment['Advice']['id'])); ?>
		</td>*/?>
		<td class="actions">
			<?php if($comment['Comment']['approved'] == 0){
				echo $this->Html->link(__('Approve', true), array('action' => 'approve', $comment['Comment']['id'], 1), null, sprintf(__('Are you sure you want to approve # %s?', true), $comment['Comment']['id']));
			}elseif($comment['Comment']['approved'] == 1){
				echo $this->Html->link(__('Un-approve', true), array('action' => 'approve', $comment['Comment']['id'], 0), null, sprintf(__('Are you sure you want to un-approve # %s?', true), $comment['Comment']['id']));
			}?>
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $comment['Comment']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $comment['Comment']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $comment['Comment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $comment['Comment']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Comment', true), array('action' => 'add')); ?></li>
		<li><?php //echo $this->Html->link(__('List Members', true), array('controller' => 'members', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Member', true), array('controller' => 'members', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Articles', true), array('controller' => 'articles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Article', true), array('controller' => 'articles', 'action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Advices', true), array('controller' => 'advices', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Advice', true), array('controller' => 'advices', 'action' => 'add')); ?> </li>
	</ul>
</div>