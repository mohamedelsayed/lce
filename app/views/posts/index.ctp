<div class="posts index">
	<?php //echo $this->element('forum/search_view',array('currentModel' => 'Post', 'currentField' => 'title'));?>
	<?php /*<h2><?php __('Posts');?></h2>*/?>
	<div class="add_action_button"><?php echo $this->Html->link(__('Add Post', true), array('action' => 'add')); ?></div>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('category_id');?></th>
			<th><?php echo $this->Paginator->sort('member_id');?></th>
			<th><?php echo $this->Paginator->sort('approved');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($posts as $post):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $post['Post']['id']; ?>&nbsp;</td>
		<td><?php echo $post['Post']['title']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($post['Category']['title'], array('controller' => 'categories', 'action' => 'view', $post['Category']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($post['Member']['fullname'], array('controller' => 'members', 'action' => 'view', $post['Member']['id'])); ?>
		</td>
		<td><?php echo $post['Post']['approved']; ?>&nbsp;</td>
		<td><?php echo $post['Post']['created']; ?>&nbsp;</td>
		<td><?php echo $post['Post']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $post['Post']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $post['Post']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $post['Post']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $post['Post']['id'])); ?>
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
<?php /*<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Post', true), array('action' => 'add')); ?></li>
		<li><?php //echo $this->Html->link(__('List Artists', true), array('controller' => 'artists', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Artist', true), array('controller' => 'artists', 'action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Posts', true), array('controller' => 'posts', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Parent Post', true), array('controller' => 'posts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Nodes', true), array('controller' => 'nodes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Node', true), array('controller' => 'nodes', 'action' => 'add')); ?> </li>
	</ul>
</div>*/?>