<div class="nodes view">
<h2><?php  __('Node');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $node['Node']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $node['Node']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Teaser'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $node['Node']['teaser']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Body'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $node['Node']['body']; ?>
			&nbsp;
		</dd>
		<?php /*<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Node Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $node['Node']['node_type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Viewed'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $node['Node']['viewed']; ?>
			&nbsp;
		</dd>*/?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $node['Node']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $node['Node']['updated']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php if($node['Node']['approved'] == 1) echo 'Yes';
			elseif($node['Node']['approved'] == 0) echo 'No';?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Weight'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $node['Node']['weight']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cat'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($node['Cat']['title'], array('controller' => 'cats', 'action' => 'view', $node['Cat']['id'])); ?>
			&nbsp;
		</dd>
		<?php /*<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Artist'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($node['Artist']['name'], array('controller' => 'artists', 'action' => 'view', $node['Artist']['id'])); ?>
			&nbsp;
		</dd>*/?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Meta Keywords'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $node['Node']['meta_keywords']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Meta Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $node['Node']['meta_description']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Node', true), array('action' => 'edit', $node['Node']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Node', true), array('action' => 'delete', $node['Node']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $node['Node']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Nodes', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Node', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cats', true), array('controller' => 'cats', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cat', true), array('controller' => 'cats', 'action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Artists', true), array('controller' => 'artists', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Artist', true), array('controller' => 'artists', 'action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Gals', true), array('controller' => 'gals', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Gal', true), array('controller' => 'gals', 'action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Videos', true), array('controller' => 'videos', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Video', true), array('controller' => 'videos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php if (!empty($node['Gal'])){?>
<div class="related">
	<h3><?php __('Related Images');?></h3>
	<?php echo $this->element('backend/images_gallery_view', array('gallery' => $node['Gal']));?>
	<?php /*if (!empty($node['Gal'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Caption'); ?></th>
		<th><?php __('Image'); ?></th>
		<th><?php __('Node Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($node['Gal'] as $gal):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $gal['id'];?></td>
			<td><?php echo $gal['caption'];?></td>
			<td><?php echo $gal['image'];?></td>
			<td><?php echo $gal['node_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'gals', 'action' => 'view', $gal['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'gals', 'action' => 'edit', $gal['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'gals', 'action' => 'delete', $gal['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $gal['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php //echo $this->Html->link(__('New Gal', true), array('controller' => 'gals', 'action' => 'add'));?> </li>
		</ul>
	</div>*/?>
</div>
<?php }?>
<?php /*if(!empty($node['Video'])){?>
<div class="related">
	<h3><?php __('Related Videos');?></h3>
	<?php echo $this->element('backend/videos_gallery_view_new', array('gallery' => $node['Video']));?>
	<?php /*if (!empty($node['Video'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Image'); ?></th>
		<th><?php __('File'); ?></th>
		<th><?php __('Url'); ?></th>
		<th><?php __('Hits'); ?></th>
		<th><?php __('Node Id'); ?></th>
		<th><?php __('Header'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($node['Video'] as $video):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $video['id'];?></td>
			<td><?php echo $video['title'];?></td>
			<td><?php echo $video['image'];?></td>
			<td><?php echo $video['file'];?></td>
			<td><?php echo $video['url'];?></td>
			<td><?php echo $video['hits'];?></td>
			<td><?php echo $video['node_id'];?></td>
			<td><?php echo $video['header'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'videos', 'action' => 'view', $video['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'videos', 'action' => 'edit', $video['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'videos', 'action' => 'delete', $video['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $video['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
	<div class="actions">
		<ul>
			<li><?php //echo $this->Html->link(__('New Video', true), array('controller' => 'videos', 'action' => 'add'));?> </li>
		</ul>
	</div>*//*?>
</div>
<?php }?>
<?php if(!empty($node['Attachment'])){?>
<div class="related">
	<h3><?php __('Related Pdf Files');?></h3>
	<?php echo $this->element('backend/attachments_view', array('attachments' =>$node['Attachment'])); ?>
</div>
<?php }*/?>