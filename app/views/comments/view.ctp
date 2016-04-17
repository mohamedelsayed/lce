<div class="comments view">
<h2><?php  __('Comment');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $comment['Comment']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $comment['Comment']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Body'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $comment['Comment']['body']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $comment['Comment']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $comment['Comment']['approved']; ?>
			&nbsp;
		</dd>
		<?php /*<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Member'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($comment['Member']['name'], array('controller' => 'members', 'action' => 'view', $comment['Member']['id'])); ?>
			&nbsp;
		</dd>*/?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Article'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($comment['Article']['title'], array('controller' => 'articles', 'action' => 'view', $comment['Article']['id'])); ?>
			&nbsp;
		</dd>
		<?php /*<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Advice'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($comment['Advice']['question'], array('controller' => 'advices', 'action' => 'view', $comment['Advice']['id'])); ?>
			&nbsp;
		</dd>*/?>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Comment', true), array('action' => 'edit', $comment['Comment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Comment', true), array('action' => 'delete', $comment['Comment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $comment['Comment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Comments', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Comment', true), array('action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Members', true), array('controller' => 'members', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Member', true), array('controller' => 'members', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Articles', true), array('controller' => 'articles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Article', true), array('controller' => 'articles', 'action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Advices', true), array('controller' => 'advices', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Advice', true), array('controller' => 'advices', 'action' => 'add')); ?> </li>
	</ul>
</div>