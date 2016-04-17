<div class="gals view">
<h2><?php  __('Gal');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $gal['Gal']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Caption'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $gal['Gal']['caption']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Image'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $gal['Gal']['image']; ?>
			&nbsp;
		</dd>
		
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Gal', true), array('action' => 'edit', $gal['Gal']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Gal', true), array('action' => 'delete', $gal['Gal']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $gal['Gal']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Gals', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Gal', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
