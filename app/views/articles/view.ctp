<div class="articles view">
<h2><?php  __('Article');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $article['Article']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $article['Article']['title']; ?>
			&nbsp;
		</dd>
		<?php /*<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title Ar'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $article['Article']['title_ar']; ?>
			&nbsp;
		</dd>*/?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Meta Keywords'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $article['Article']['meta_keywords']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Meta Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $article['Article']['meta_description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $article['Article']['date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Header'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $article['Article']['header']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Body'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Form->input('Article.body', array('class'=>'ckeditor'));
			//echo $this->Fck->fckeditor(array('Article', 'body'), $this->Html->base, $article['Article']['body']);?>
			&nbsp;
		</dd>
		<?php /*<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Body Ar'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Fck->fckeditor(array('Article', 'body_ar'), $this->Html->base, $article['Article']['body_ar']);?>
			&nbsp;
		</dd>*/?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $article['Article']['created']; ?>
			&nbsp;
		</dd>
		<?php /*<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $article['Article']['updated']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Hits'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $article['Article']['hits']; ?>
			&nbsp;
		</dd>*/?>
		<?php /*<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shared'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $article['Article']['shared']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Like'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $article['Article']['like']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Home'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $article['Article']['home']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Subject'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($article['Subject']['title'], array('controller' => 'subjects', 'action' => 'view', $article['Subject']['id'])); ?>
			&nbsp;
		</dd>*/?>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Article', true), array('action' => 'edit', $article['Article']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Article', true), array('action' => 'delete', $article['Article']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $article['Article']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Articles', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Article', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Comments', true), array('controller' => 'comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Comment', true), array('controller' => 'comments', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Gallery');?></h3>
	<?php echo $this->element('backend/images_gallery_view', array('gallery' => $article['Gal']));?>
</div>
<?php /*<div class="related">
	<h3><?php __('Related Vedios');?></h3>
	<?php echo $this->element('backend/videos_gallery_view', array('gallery' => $article['Video']));?>
</div>*/?>
<div class="related">
	<h3><?php __('Related Comments');?></h3>
	<?php if (!empty($article['Comment'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<?php /*<th><?php __('Title'); ?></th>*/?>
		<th><?php __('Body'); ?></th>
		<th><?php __('Created'); ?></th>
		<?php /*<th><?php __('Member Id'); ?></th>*/?>
		<th><?php __('Article Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($article['Comment'] as $comment):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $comment['id'];?></td>
			<?php /*<td><?php echo $comment['title'];?></td>*/?>
			<td><?php echo $comment['body'];?></td>
			<td><?php echo $comment['created'];?></td>
			<?php /*<td><?php //echo $comment['member_id'];?></td>*/?>
			<td><?php echo $comment['article_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'comments', 'action' => 'view', $comment['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'comments', 'action' => 'edit', $comment['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'comments', 'action' => 'delete', $comment['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $comment['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Comment', true), array('controller' => 'comments', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>