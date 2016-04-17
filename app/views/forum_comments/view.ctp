<div class="comments view">
<h2><?php  __('Comment');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $comment['ForumComment']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Member'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $comment['Member']['fullname']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Comment'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", "<div class=\"lcevideo\"><iframe width=\"300\" height=\"250\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe></div>", $comment['ForumComment']['comment']);?>
			<?php //echo $comment['ForumComment']['comment']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $comment['ForumComment']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Approved'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $comment['ForumComment']['approved']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Member'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($comment['Member']['fullname'], array('controller' => 'members', 'action' => 'view', $comment['Member']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Post'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($comment['Post']['title'], array('controller' => 'posts', 'action' => 'view', $comment['Post']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Image'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php if($comment['ForumComment']['image'] != ''){?>
				<div class="comment_image_new">
					<img src="<?php echo $this->Session->read('Setting.url').DS.'img'.DS.'upload'.DS.$comment['ForumComment']['image'];?>" alt=""/>
				</div>
			<?php }?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Video'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php if($comment['ForumComment']['video'] != ''){
				echo $this->element('forum/video_player_view',  array('video' => $comment['ForumComment']['video'], 'width'=>300, 'height'=>250));
			}?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Attachement'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php if($comment['ForumComment']['attachement'] != ''){
				$file_name_exploded = explode('.', $comment['ForumComment']['attachement']);
		        $file_ext = $file_name_exploded[count($file_name_exploded) - 1];
		        $file_link = $this->Session->read('Setting.url').DS.'files'.DS.'upload'.DS.$comment['ForumComment']['attachement'];?>
				<div class="<?php echo $file_ext . '-file'; ?>">
					<a target="_blank" href="<?php echo $file_link;?>"><?php echo $comment['ForumComment']['attachement'];?></a>
				</div>
			<?php }?>
			&nbsp;
		</dd>
	</dl>
</div>