<div class="posts view">
	<?php $member_id = 0;
	if(isset($userInfoFront['id'])){
		$member_id = $userInfoFront['id'];
	}	
	$type = $post['Post']['type'];	
	if(($post['Post']['member_id'] == $member_id) || $isAdmin == 1){?>
		<div class="cancel_button">
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $post['Post']['id'])); ?> | 
			<?php echo $this->Html->link(__('Cancel Topic', true), array('action' => 'delete', $post['Post']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $post['Post']['id'])); ?>
		</div>	
	<?php }?>
	<h2><?php echo $post['Post']['title'];?></h2>
	<div class="postCategory">
		<div class="postcategorytext">Category:</div>
		<div class="postcategorydata">
			<?php echo $this->Html->link($post['Category']['title'], array('controller' => 'posts', 'action' => 'all/'.$post['Category']['id'].'/type:'.$type));?>
		</div>
	</div>
	<div class="postauthor">
		<?php /*<div class="postauthortext">Author:</div>*/?>
		<?php $img_src = $base_url.DS.'img'.DS.'forum'.DS.'default_user_thumbnail.png';
		if($post['Member']['image'] != ''){
			$img_src = $base_url.DS.'img'.DS.'upload'.DS.$post['Member']['image'];
		}?>
		<div class="post_author_image">
			<img src="<?php echo $img_src;?>" alt="<?php echo $post['Member']['fullname'];?>"/>
		</div>
		<div class="postauthordata">
			<div class="postauthorname">
				<?php echo $this->Html->link($post['Member']['fullname'], array('controller' => 'members', 'action' => 'view', $post['Member']['id']));?>
			</div>
			<div class="postauthorblock">
				<?php //echo $this->element('forum/block_member', array('other_member_id' => $post['Member']['id'], 'other_member_fullname' => $post['Member']['fullname']));?>
			</div>
		</div>
	</div>	
	<div class="postbody">
		<?php $body = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", "<div class=\"lcevideo\"><iframe width=\"300\" height=\"250\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe></div>", $post['Post']['body']);
		$body = str_replace('</p>', ' </p>', $body);
		echo preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $body);?>	
	</div>
	<div class="postAttachments">
		<div>Attachements:</div>
		<?php echo $attachements_div;?>
	</div>
	<?php /*if($post['Post']['image'] != ''){?>
		<div class="post_image_new">
			<img src="<?php echo $base_url.DS.'img'.DS.'upload'.DS.$post['Post']['image'];?>" alt="<?php echo $post['Post']['title'];?>"/>
		</div>
	<?php }?>
	<?php if($post['Post']['video'] != ''){?>
		<div class="post_video_new">
			<?php echo $this->element('forum/video_player_view',  array('video' => $post['Post']['video'], 'width'=>300, 'height'=>250));?>
		</div>
	<?php }?>
	<?php if($post['Post']['attachement'] != ''){?>
		<div class="post_attachement_new">
			<?php $file_name_exploded = explode('.', $post['Post']['attachement']);
	        $file_ext = $file_name_exploded[count($file_name_exploded) - 1];
	        $file_link = $base_url.DS.'files'.DS.'upload'.DS.$post['Post']['attachement'];?>
			<div class="<?php echo $file_ext . '-file'; ?>">
				<a target="_blank" href="<?php echo $file_link;?>"><?php echo $post['Post']['attachement'];?></a>
			</div>
		</div>
	<?php }*/?>
	<?php //echo $this->element('forum/agreements', array('item_id' => $post['Post']['id'], 'item_type' => 0));?>
</div>
<?php include_once('comments.ctp');?>