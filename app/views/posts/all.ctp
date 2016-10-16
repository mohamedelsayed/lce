<div class="t_p_con index">
	<?php if(isset($category)){
		$category_title = $category['Category']['title'];?>
		<div class="category_title">
			<h2><?php echo $category_title;?></h2>
		</div>				
	<?php }?>
	<div class="add_action_button"><?php echo $this->Html->link(__('Add Topic', true), array('action' => 'add//type:'.$type)); ?></div>
	<?php if(!empty($posts)){?>
		<?php foreach ($posts as $key => $post) {
			$count_comments = count($post['ForumComment']);
			$post_link = $base_url.'/posts/view/'.$post['Post']['id'];
			$image = '';
			if($post['Post']['image'] != ''){
				$image = $base_url.'/img/upload/'.$post['Post']['image'];
			}
			$title = '';
			if($post['Post']['title'] != ''){
				$title = $post['Post']['title'];
			}
			$body = '';
			if($post['Post']['body'] != ''){
				$body = $post['Post']['body'];
			}?>
			<div class="con_con">
				<a href="<?php echo $post_link;?>" title="<?php echo $title;?>">
					<div class="mm_top">
						<?php echo $title;?>
						<span class="post_count_comments_list">(<?php echo $count_comments.' Comments';?>)</span>
					</div>					 
				</a>
		    </div>	
			<div class="con_con post_image_new_div">
				<?php if(isset($post['Post']['image'])){?>
					<div class="post_image_new">
						<a href="<?php echo $post_link;?>" title="<?php echo $title;?>">
							<img src="<?php echo $image;?>" alt="<?php echo $title;?>"/>
						</a>
					</div>
				<?php }?>
			</div>
        <?php }?>
    <?php }else{?>
    	<div class="no-data-found">No data found.</div>
	<?php }?>
	<?php echo $this->element('front/paging_view');?>
</div>