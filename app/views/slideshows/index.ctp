<div class="slideshows index">
	<h2><?php __('Slideshows');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('image');?></th>
			<?php/*	<th><?php echo $this->Paginator->sort('link');?></th>*/?>
			<?php /*<th><?php echo $this->Paginator->sort('target');?></th>*/?>
			<th><?php echo $this->Paginator->sort('approved');?></th>
			<th><?php echo $this->Paginator->sort('weight');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($slideshows as $slideshow):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $slideshow['Slideshow']['id']; ?>&nbsp;</td>
		<td><?php echo $slideshow['Slideshow']['image']; ?>&nbsp;</td>
		<?php /*<td><?php echo $slideshow['Slideshow']['link']; ?>&nbsp;</td>
		<?php /*<td><?php echo $slideshow['Slideshow']['target']; ?>&nbsp;</td>*/?>
		<td><?php echo $slideshow['Slideshow']['approved']; ?>&nbsp;</td>
		<td><?php echo $slideshow['Slideshow']['weight']; ?>&nbsp;</td>
		<td><?php echo $slideshow['Slideshow']['created']; ?>&nbsp;</td>
		<td><?php echo $slideshow['Slideshow']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $slideshow['Slideshow']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $slideshow['Slideshow']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $slideshow['Slideshow']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $slideshow['Slideshow']['id'])); ?>
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
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Slideshow', true), array('action' => 'add')); ?></li>
	</ul>
</div>