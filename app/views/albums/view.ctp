<div class="articles view">
<h2><?php  __('Album');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $album['Album']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $album['Album']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Meta Keywords'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $album['Album']['meta_keywords']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Meta Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $album['Album']['meta_description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Header'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $album['Album']['header']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $album['Album']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $album['Album']['updated']; ?>
			&nbsp;
		</dd>		
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Album', true), array('action' => 'edit', $album['Album']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Album', true), array('action' => 'delete', $album['Album']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $album['Album']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Albums', true), array('action' => 'index')); ?> </li>
	</ul>
</div>
<?php /*<div class="related">
	<h3><?php __('Related Gallery');?></h3>
	<?php echo $this->element('backend/images_gallery_view', array('gallery' => $album['Gal']));?>
</div>*/?>
<div class="related">
	<h3><?php __('Related Audios');?></h3>
	<?php echo $this->element('backend/audios_gallery_view', array('gallery' => $album['Audio'])); ?>
</div>
<div class="related">
	<h3><?php __('Related Videos');?></h3>
	<?php echo $this->element('backend/videos_gallery_view', array('gallery' => $album['Video'])); ?>
</div>