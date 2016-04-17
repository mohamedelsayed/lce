<div class="events index">
	<h2><?php __('Sending Queue');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('newsletter_id');?></th>
            <th><?php echo $this->Paginator->sort('status');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($queues as $queue):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $queue['Queue']['id']; ?>&nbsp;</td>
		<td><?php echo $queue['Newsletter']['subject']; ?>&nbsp;</td>
		<td>
			<?php if($queue['Queue']['status'] == 0) echo __('Pending');
			elseif($queue['Queue']['status'] == 1) echo __('Sending');
			elseif($queue['Queue']['status'] == 2) echo __('Sent');	?>&nbsp;
		</td>        
		<td class="actions">
			<?php //echo $this->Html->link(__('View', true), array('action' => 'view', $queue['Queue']['id'])); ?>
			<?php //echo $this->Html->link(__('Edit', true), array('action' => 'edit', $queue['Queue']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $queue['Queue']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $queue['Queue']['id'])); ?>
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
	<h3><?php //__('Actions'); ?></h3>
	<ul>
		<li><?php //echo $this->Html->link(__('New Queue', true), array('action' => 'add')); ?></li>
	</ul>
</div>