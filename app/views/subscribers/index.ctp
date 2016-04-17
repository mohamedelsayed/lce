<div class="articles index">
	<h2><?php //echo "Subscribers Of:";?></h2>
    <div style="width: 350px;">
    <?php
    //pr($this->data['Subscriber']);
	echo $this->Form->create('Subscriber', array('action'=>'filter'));
	//if($this->Session->read('userInfo.User.login_as') == 1)
	//echo $this->Form->input('Subscriber.user_id', array('empty'=>'All'));
	echo $this->Form->input('Subscriber.name');
	echo $this->Form->input('Subscriber.email');
	echo $this->Form->end(__('Filter', true));
	?>
    </div>
    <table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>			
			<?php /*<th><?php echo $this->Paginator->sort('user_id');?></th>*/?>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($subscribers as $subscriber):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $subscriber['Subscriber']['id']; ?>&nbsp;</td>
		<td><?php echo $subscriber['Subscriber']['name']; ?>&nbsp;</td>
		<td><?php echo $subscriber['Subscriber']['email']; ?>&nbsp;</td>
		<?php /*<td>
			<?php echo $subscriber['User']['name'];?>
		</td>*/?>
		<td><?php echo $subscriber['Subscriber']['created']; ?>&nbsp;</td>
		<td><?php echo $subscriber['Subscriber']['updated']; ?>&nbsp;</td>
			<?php //echo $this->Html->link($subscriber['User']['name'], array('controller' => 'users', 'action' => 'view', $subscriber['User']['id'])); ?>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $subscriber['Subscriber']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $subscriber['Subscriber']['id'])); ?>			
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $subscriber['Subscriber']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $subscriber['Subscriber']['id'])); ?>			
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array('format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)));
	?></p>
	<div class="paging">
		<?php echo $this->Paginator->first('<< ' . __('first', true), array(), null, array('class'=>'disabled'));?> 
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?> | 
		<?php echo $this->Paginator->numbers();?> | 
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
		<?php echo $this->Paginator->last(__('last', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
	<div class="limit" style="margin-top: 15px;">
		<?php
		//make url like articles/index/page:1/sort:title/direction:asc/limit:80
		//pr($this->params['named']);
		$url = $this->params['url']['url'];
		if(isset($this->params['named']['limit']))
			$url = str_replace("/limit:".$this->params['named']['limit'],"",$url);
		if($url == 'subscribers' || $url == 'subscribers/')
				$url = $url.'/index';	
		?>
		Select Records Per Page: &lt;
		<?php echo $this->Html->link(20,  array('controller' => $url.'/limit:20')); ?> | 
		<?php echo $this->Html->link(50,  array('controller' => $url.'/limit:50')); ?> | 
		<?php echo $this->Html->link(100,  array('controller' => $url.'/limit:100')); ?> |
		<?php echo $this->Html->link(200, array('controller' => $url.'/limit:200')); ?> |
		<?php echo $this->Html->link(1000, array('controller' => $url.'/limit:1000')); ?>
		&gt;
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Subscriber', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Import Subscribers', true), array('action' => 'subscribers_import')); ?></li>
		<li><?php echo $this->Html->link(__('Delete Subscribers', true), array('action' => 'subscribers_delete')); ?></li>
	</ul>
</div>
<style type="text/css">
form .required label:after {
    color: #FFFFFF;
    content: "*";
    display: inline;
}
form .required{
	font-weight: normal;
}
</style>