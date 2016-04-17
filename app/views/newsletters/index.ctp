<div class="articles index">
	<h2><?php //echo "Newsletters Of:";?></h2>
    <div style="width: 350px;">
    <?php
    //pr($this->data['Newsletter']);
	echo $this->Form->create('Newsletter', array('action'=>'filter'));
	//if($this->Session->read('userInfo.User.login_as') == 1)
	//echo $this->Form->input('Newsletter.user_id', array('empty'=>'All Subscribers'));
	echo $this->Form->input('Newsletter.subject');
	echo $this->Form->end(__('Filter', true));
	?>
    </div>
    <table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('subject');?></th>		
			<?php /*<th><?php echo $this->Paginator->sort('To','user_id');?></th>*/?>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($newsletters as $newsletter):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $newsletter['Newsletter']['id']; ?>&nbsp;</td>
		<td><?php echo $newsletter['Newsletter']['subject']; ?>&nbsp;</td>
		<?php /*<td>
			<?php if($newsletter['Newsletter']['user_id'] == 0)
			echo "All Subscribers";
			else
			echo $newsletter['User']['name'];?>
		</td>*/?>
		<td><?php echo $newsletter['Newsletter']['created']; ?>&nbsp;</td>
		<td><?php echo $newsletter['Newsletter']['updated']; ?>&nbsp;</td>
			<?php //echo $this->Html->link($newsletter['User']['name'], array('controller' => 'users', 'action' => 'view', $newsletter['User']['id'])); ?>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $newsletter['Newsletter']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $newsletter['Newsletter']['id'])); ?>	
			<?php echo $this->Html->link(__('Send', true), array('action' => 'addToQueue', $newsletter['Newsletter']['id']), null, sprintf(__('Are you sure you want to Send # %s?', true), $newsletter['Newsletter']['id'])); ?>		
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $newsletter['Newsletter']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $newsletter['Newsletter']['id'])); ?>			
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
		if($url == 'newsletters' || $url == 'newsletters/')
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
		<li><?php echo $this->Html->link(__('New Newsletter', true), array('action' => 'add')); ?></li>
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