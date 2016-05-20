<div class="right_con article_right_inner">
	<?php if(!empty($recent_articles)){?>
		<div class="ri_top">Recent Blog Entries</div>
		<?php foreach ($recent_articles as $key => $recent_article) {
			$article_link = $base_url.'/article/item/'.$recent_article['Article']['id'];
			$image = '';
			if(isset($recent_article['Gal'])){
				//$image = $base_url.'/img/upload/thumb_'.$recent_article['Gal'][0]['image'];
				$image = $base_url.'/img/upload/'.$recent_article['Gal'][0]['image'];
			}
			$title = '';
			if($recent_article['Article']['title'] != ''){
				$title = $recent_article['Article']['title'];
			}
			$header = '';
			if($recent_article['Article']['header'] != ''){
				$header = $recent_article['Article']['header'];
			}?>		
			<div class="r_h_con">
				<div class="mm_out article_image_right">
					<a href="<?php echo $article_link;?>">
						<img src="<?php echo $image;?>"/>
					</a>		
				</div>
				<a href="<?php echo $article_link;?>">
					<div class="right_nology"><?php echo $title;?></div>
				</a>
			</div>
		<?php }?>
	<?php }?>
	<?php if(!empty($all_tags)){?>
		<div class="ri_top">Blog Tags</div>
		<?php foreach ($all_tags as $key => $all_tag) {
			$tag_link = $base_url.'/article/all/'.trim($all_tag);?>
			<div class="n_right">
				<a href="<?php echo $tag_link;?>">
					<img class="usic" src="<?php echo $base_url.'/img/front/';?>m_o_6.jpg"/>
					<?php echo $all_tag;?>
				</a>
			</div>
		<?php }?>
	<?php }?>
	<?php if($this->Session->read('Setting.facbook_link') != ''){?>
		<div class="facebook_box_div">		
			<div class="fb-like-box" data-href="<?php echo $this->Session->read('Setting.facbook_link');?>" data-height="500" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="false"></div>
		</div>
	<?php }?>
</div>