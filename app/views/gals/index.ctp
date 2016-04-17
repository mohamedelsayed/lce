<!--DRAG DROP SCRIPTS AND CSS-->
<?php 
echo $this->Html->css('dragdrop/lists', null, array('inline' => false));   
echo $this->Javascript->link('dragdrop/core', 	false); 
echo $this->Javascript->link('dragdrop/events', false);
echo $this->Javascript->link('dragdrop/css', false);
echo $this->Javascript->link('dragdrop/coordinates', false);
echo $this->Javascript->link('dragdrop/drag', false);
echo $this->Javascript->link('dragdrop/dragsort', false);
echo $this->Javascript->link('dragdrop/cookies', false);
echo $this->Javascript->link('dragdrop/main', false);
?>
<!--END DRAG DROP SCRIPTS AND CSS-->

<? //print_r(substr($this->params['url']['url'], 11));?>
<div class="gals index">
	<h2><?php __('Images');?></h2>
	<?php echo $this->Form->create('Gal', array('url'=>substr($this->params['url']['url'], 5)));?>
    <table width="850px" cellpadding="0" cellspacing="0" style="margin-bottom:0px;">
    	<tr>
			<th width="10%" style="padding:0px;"><?php echo $this->Paginator->sort('id');?></th>			
			<th width="40%" style="padding:0px;"><?php echo $this->Paginator->sort('caption');?></th>
			<th width="40%" style="padding:0px;"><?php echo $this->Paginator->sort('image');?></th>
			<?php /*<th width="10%" style="padding:0px;"><?php echo $this->Paginator->sort('article_id');?></th>*/?>			
			<th style="padding:0px;"><?php __('Actions');?></th>
	</tr>
    </table>
	<table width="850px" cellpadding="0" cellspacing="0">
    	<tr>
    		<td style="border-bottom:none; padding:0px;" >
       			<ul id="phonetic1" class="boxy">
	<?php
	$i = 0;
	foreach ($gals as $gal):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
    <li style="width:870px;">
                    	<input type="hidden" name="data[Gal][ids][]" value="<?php echo $gal['Gal']['id'];?>">
                        <table cellpadding="0" cellspacing="0"  style="margin-bottom:0px;">
	<tr<?php echo $class;?>>
		<td width="10%" style="padding:6px 0"><?php echo $gal['Gal']['id']; ?>&nbsp;</td>
		<td width="40%" style="padding:6px 0 "><?php echo $gal['Gal']['caption']; ?>&nbsp;</td>
		<td width="40%" style="padding:6px 0"><?php echo $gal['Gal']['image']; ?>&nbsp;</td>
		<?php /*<td  width="10%" style="padding:6px 0"><?php echo $gal['Gal']['article_id']; ?>&nbsp;</td>*/?>		
		<td class="actions" style="padding:6px 0;">
			<?php //echo $this->Html->link(__('View', true), array('action' => 'view', $gal['Gal']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $gal['Gal']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $gal['Gal']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $gal['Gal']['id'])); ?>
		</td>
	</tr>
    </table>
                    </li>
<?php endforeach; ?>
</ul>	
    		</td>
    	</tr>
	</table>
  <?  echo $this->Form->end(__('Save positions', true));?>
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
		<li><?php //echo $this->Html->link(__('New Gal', true), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__('Back to '.ucfirst($this->Session->read('back_model')), true), array('controller'=> strtolower($this->Session->read('back_model')).'s','action' => 'edit',$this->Session->read('back_id'))); ?></li>
       
	</ul>
</div>