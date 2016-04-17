<div class="events view">
	<?php $member_id = 0;
	if(isset($userInfoFront['id'])){
		$member_id = $userInfoFront['id'];
	}
	if(($event['Event']['member_id'] == $member_id) || $isAdmin == 1){?>
		<div class="cancel_button">
			<?php echo $this->Html->link(__('Cancel Event', true), array('action' => 'delete', $event['Event']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $event['Event']['id'])); ?>
		</div>
	<?php }?>
<?php /*<h2><?php  __('Event');?></h2>*/?>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<?php /*<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $event['Event']['id']; ?>
			&nbsp;
	</dd>*/?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $event['Event']['title']; ?>
			&nbsp;
		</dd>		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $event['Event']['date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Timing'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $event['Event']['timing']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Location'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $event['Event']['location']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Agenda'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $event['Event']['agenda']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Member'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($event['Member']['fullname'], array('controller' => 'members', 'action' => 'view', $event['Member']['id']));?>
			&nbsp;
		</dd>
		<?php /*<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php if($event['Event']['approved'] == 1) echo 'Yes';
			elseif($event['Event']['approved'] == 0) echo 'No';?>
			&nbsp;
		</dd>?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $event['Event']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $event['Event']['updated']; ?>
			&nbsp;
		</dd>*/?>
		<dt class="willyoucome">
		Will you come?
	</dt>
	<dd>
		<?php if($attendEventFlag == -1){?>
			<a href="<?php echo $this->Session->read('Setting.url').'/events/willcome/'.$event['Event']['id'].'/1';?>"><?php echo $willyoucome_options[1];?></a> | 
			<a href="<?php echo $this->Session->read('Setting.url').'/events/willcome/'.$event['Event']['id'].'/2';?>"><?php echo $willyoucome_options[2];?></a> | 
			<a href="<?php echo $this->Session->read('Setting.url').'/events/willcome/'.$event['Event']['id'].'/0';?>"><?php echo $willyoucome_options[0];?></a>	
		<?php }else{
			echo $willyoucome_options[$attendEventFlag];			
		}?>
	</dd>
	</dl>
	<?php 
	$attendEvents1 = '';
	$attendEvents2 = '';
	$attendEvents0 = '';
	if(!empty($attendEvents)){
		foreach ($attendEvents as $key => $value) {
			if($value['AttendEvent']['attend_flag'] == 1){
				$attendEvents1 .= $this->Html->link($value['Member']['fullname'], array('controller' => 'members', 'action' => 'view', $value['Member']['id'])).', ';				
			}
			if($value['AttendEvent']['attend_flag'] == 2){
				$attendEvents2 .= $this->Html->link($value['Member']['fullname'], array('controller' => 'members', 'action' => 'view', $value['Member']['id'])).', ';				
			}
			if($value['AttendEvent']['attend_flag'] == 0){
				$attendEvents0 .= $this->Html->link($value['Member']['fullname'], array('controller' => 'members', 'action' => 'view', $value['Member']['id'])).', ';				
			}			
		}
	}
	$attendEvents1 = trim($attendEvents1);
	$attendEvents1 = trim($attendEvents1, ',');
	$attendEvents2 = trim($attendEvents2);
	$attendEvents2 = trim($attendEvents2, ',');
	$attendEvents0 = trim($attendEvents0);
	$attendEvents0 = trim($attendEvents0, ',');
	?>	
	<div>
		<h3>Who is coming:</h3>
		<table>
			<tr>
				<td><?php echo $willyoucome_options[1];?></td>
				<td><?php echo $willyoucome_options[2];?></td>
				<td><?php echo $willyoucome_options[0];?></td>
			</tr>
			<tr>
				<td>
					<?php echo $attendEvents1;?>					
				</td>
				<td>
					<?php echo $attendEvents2;?>					
				</td>
				<td>
					<?php echo $attendEvents0;?>					
				</td>
			</tr>
		</table>
	</div>
</div>