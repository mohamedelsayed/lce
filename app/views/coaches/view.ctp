<div class="coaches view">
<h2><?php  __('Coach');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $coach['Coach']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $coach['Coach']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Statement'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $coach['Coach']['statement']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Biography'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $coach['Coach']['biography']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Image'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->element('backend/image_view', array('image'=>array('id'=>$coach['Coach']['id'], 'image'=>$coach['Coach']['image']), 'size'=>'master'));?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Gender'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $gender_options[$coach['Coach']['gender']];?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $coach['Coach']['email']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('facebook'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $coach['Coach']['facebook']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Linkedin'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $coach['Coach']['linkedin']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Video File'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php if($coach['Coach']['video_file'] != ''){
				echo $this->element('backend/video_player_view', array('video' => array('file' => $coach['Coach']['video_file'], 'image' => '', 'title' => ''), 'width' => 300, 'height' => 250));
			}?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Mobile'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $coach['Coach']['mobile']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Specializations'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<ul id="specializations_result" class="autocomplete_ul_result specializations_result">
				<?php foreach ($specializations as $key => $value) {
					if(in_array($key, $saved_specializations)){?>
						<li class="itemli" id="sitemli<?php echo $key;?>"><h5><?php echo $value;?></h5>
					<?php }?>
				<?php }?>
			</ul>
		</dd>	
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Geographies'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<ul id="geographys_result" class="autocomplete_ul_result geographys_result">
				<?php foreach ($geographys as $key => $value) {
					if(in_array($key, $saved_geographys)){?>
						<li class="itemli" id="sitemli<?php echo $key;?>"><h5><?php echo $value;?></h5>
					<?php }?>
				<?php }?>
			</ul>
		</dd>		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Remote Coaching'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
		<?php if($coach['Coach']['remote_coaching'] == 1) echo 'Yes';
		elseif($coach['Coach']['remote_coaching'] == 0) echo 'No';?>&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
		<?php if($coach['Coach']['approved'] == 1) echo 'Yes';
		elseif($coach['Coach']['approved'] == 0) echo 'No';?>&nbsp;
		</dd>		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Weight'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $coach['Coach']['weight']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $coach['Coach']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $coach['Coach']['updated']; ?>
			&nbsp;
		</dd>		
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Coach', true), array('action' => 'edit', $coach['Coach']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Coach', true), array('action' => 'delete', $coach['Coach']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $coach['Coach']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Coaches', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Coach', true), array('action' => 'add')); ?> </li>
	</ul>
</div>