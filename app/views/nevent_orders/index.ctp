<div class="nevent_orders index">
	<h2>
		<?php echo "Search:";
		$currentModel = 'NeventOrder';?>
	</h2>
	<div style="width: 350px;">
		<?php echo $this->Form->create($currentModel, array('action' => 'index/'.$type, 'id' => 'NeventOrderIndexForm'));
		echo $this->Form->input($currentModel.'.name');
		echo $this->Form->input($currentModel.'.email');
		if($type_flag == 0){
			echo $this->Form->input($currentModel.'.event_id', array('options' => $events));
		}
		echo $this->Form->end(__('Search', true));
		?>
	</div>
	<h2><?php echo ucfirst($type).' '.'Checkouts';?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>
			<?php if($type_flag == 0){?>
				<th><?php echo $this->Paginator->sort('event_id');?></th>
			<?php }?>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($nevent_orders as $nevent_order):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $nevent_order['NeventOrder']['id']; ?>&nbsp;</td>
		<td><?php echo $nevent_order['NeventOrder']['name']; ?>&nbsp;</td>
		<td><?php echo $nevent_order['NeventOrder']['email']; ?>&nbsp;</td>
		<?php if($type_flag == 0){?>
			<td><?php echo $nevent_order['Nevent']['title']; ?>&nbsp;</td>
		<?php }?>
		<td><?php echo $nevent_order['NeventOrder']['created']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $nevent_order['NeventOrder']['id'])); ?>
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
		<li>
			<a style="cursor: pointer;" class="export_data" datahref="<?php echo $base_url.'/nevent_orders/index/'.$type.'/export';?>">Export to Excel</a>
		</li>
	</ul>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery("body").on("click",".export_data", function(){
		var datahref = jQuery(this).attr('datahref');
		var old_action = jQuery('#NeventOrderIndexForm').attr('action');
		jQuery('#NeventOrderIndexForm').attr('action', datahref);
		jQuery('#NeventOrderIndexForm').submit();
		jQuery('#NeventOrderIndexForm').attr('action', old_action);
	});
});	
</script>