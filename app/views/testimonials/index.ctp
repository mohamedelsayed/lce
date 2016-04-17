<div class="testimonials index">
	<h2><?php __('Testimonials');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('position');?></th>
			<?php /*<th><?php echo $this->Paginator->sort('body');?></th>
			<th><?php echo $this->Paginator->sort('image');?></th>*/?>
			<th><?php echo $this->Paginator->sort('approved');?></th>
			<th><?php echo $this->Paginator->sort('featured');?></th>
			<th><?php echo $this->Paginator->sort('weight');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($testimonials as $testimonial):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $testimonial['Testimonial']['id']; ?>&nbsp;</td>
		<td><?php echo $testimonial['Testimonial']['name']; ?>&nbsp;</td>
		<td><?php echo $testimonial['Testimonial']['position']; ?>&nbsp;</td>
		<?php /*<td><?php echo $testimonial['Testimonial']['body']; ?>&nbsp;</td>
		<td><?php echo $testimonial['Testimonial']['image']; ?>&nbsp;</td>*/?>
		<td><?php echo $testimonial['Testimonial']['approved']; ?>&nbsp;</td>
		<td><?php echo $testimonial['Testimonial']['featured']; ?>&nbsp;</td>
		<td><?php echo $testimonial['Testimonial']['weight']; ?>&nbsp;</td>
		<td><?php echo $testimonial['Testimonial']['created']; ?>&nbsp;</td>
		<td><?php echo $testimonial['Testimonial']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $testimonial['Testimonial']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $testimonial['Testimonial']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $testimonial['Testimonial']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $testimonial['Testimonial']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Testimonial', true), array('action' => 'add')); ?></li>
	</ul>
</div>