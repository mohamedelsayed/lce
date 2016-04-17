<div class="newsletters view">
<h2><?php  __('Newsletter');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $newsletter['Newsletter']['id']; ?>
			&nbsp;
		</dd>
		<?php /*<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('To'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php if($newsletter['Newsletter']['user_id'] == 0)
			echo "All Subscribers";
			else
			echo $newsletter['User']['name'];?>
			&nbsp;
</dd>*/?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('From Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $newsletter['Newsletter']['from_name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('From Email'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $newsletter['Newsletter']['from_email']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Subject'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $newsletter['Newsletter']['subject']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Body'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $newsletter['Newsletter']['body'];?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $newsletter['Newsletter']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $newsletter['Newsletter']['updated']; ?>
			&nbsp;
		</dd>
		<?php /*<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Use Signature'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $newsletter['Newsletter']['use_signature']; ?>
			&nbsp;
		</dd>*/?>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Newsletter', true), array('action' => 'edit', $newsletter['Newsletter']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Newsletter', true), array('action' => 'delete', $newsletter['Newsletter']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $newsletter['Newsletter']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Newsletters', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Newsletter', true), array('action' => 'add')); ?> </li>
	</ul>
</div>