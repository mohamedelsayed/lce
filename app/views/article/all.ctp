<div class="t_p_con">
	<?php /*<div class="top_con_2">Blog</div>*/?>
	<div class="top_con_3">Latest Posts</div>
	<?php if(!empty($articles)){?>
		<?php foreach ($articles as $key => $article) {
			$article_link = $this->Session->read('Setting.url').'/article/item/'.$article['Article']['id'];
			$image = '';
			if(isset($article['Gal'])){
				$image = $this->Session->read('Setting.url').'/img/upload/'.$article['Gal'][0]['image'];
			}
			$title = '';
			if($article['Article']['title'] != ''){
				$title = $article['Article']['title'];
			}
			$header = '';
			if($article['Article']['header'] != ''){
				$header = $article['Article']['header'];
			}
			$body = '';
			if($article['Article']['body'] != ''){
				$body = $article['Article']['body'];
			}
			$comments_count = count($article['Comment']);
			$article_cut_string_inner = $this->Session->read('Setting.article_cut_string_inner');?>
			<div class="con_con">
				<a href="<?php echo $article_link;?>" title="<?php echo $title;?>">
					<div class="mm_top"><?php echo $title;?></div>
				</a>
		    </div>
		    <div class="con_con article_date_div">
		    	<div class="mm_out">
		    		<img src="<?php echo $this->Session->read('Setting.url').'/img/front/';?>m_o.jpg"/>		    			
	    		</div>
	    		<div class="mm_tt">
	    			<?php echo $this->element('front/english_date_view', array('date' => $article['Article']['date']));?>
    			</div>
    			<div class="mm_out">
    				<img src="<?php echo $this->Session->read('Setting.url').'/img/front/';?>m_o_2.jpg"/>
				</div>
				<div class="mm_tt"><?php echo $article['Article']['creator'];?></div>
				<div class="mm_out">
					<img src="<?php echo $this->Session->read('Setting.url').'/img/front/';?>m_o_3.jpg"/>
				</div>
				<div class="mm_tt"><?php echo $comments_count;?> Comments</div>
			</div>			
			<div class="con_con article_tags_div">
				<?php if($article['Article']['tags'] != ''){
					$tags = explode(",", $article['Article']['tags']);?>
					<div class="mm_out">
						<img src="<?php echo $this->Session->read('Setting.url').'/img/front/';?>m_o_4.jpg"/>
					</div>
					<?php foreach ($tags as $key => $tag) {?>			
						<div class="nology">
							<a href="<?php echo $this->Session->read('Setting.url').'/article/all/'.trim($tag);?>"><?php echo $tag;?></a>
						</div>
					<?php }?>
				<?php }?>
			</div>
			<?php /*<div class="con_con">
				<?php if(isset($article['Gal'][0])){?>
					<div class="mtm_t article_image">
						<a href="<?php echo $article_link;?>" title="<?php echo $title;?>">
							<img src="<?php echo $image;?>" alt="<?php echo $title;?>"/>
						</a>
					</div>
				<?php }?>
			</div>*/?>
			<div class="con_con article_image_new_div">
				<?php if(isset($article['Gal'][0])){?>
					<div class="mtm_t article_image_new">
						<a href="<?php echo $article_link;?>" title="<?php echo $title;?>">
							<img src="<?php echo $image;?>" alt="<?php echo $title;?>"/>
						</a>
					</div>
				<?php }?>
			</div>
			<div class="con_con headerlistitem">
				<div class="bot_tom">
					<?php echo $this->element('front'.DS.'string_format_view',array('str'=> $body,'type'=> 'wordsCut', 'val' => $article_cut_string_inner));?>
					<?php //echo $header;?>
				</div>
				<a href="<?php echo $article_link;?>" title="<?php echo $title;?>">
					<div class="no_See">See More ></div>
				</a>
			</div>
        <?php }?>
    <?php }else{?>
    	<div class="no-data-found">No data found.</div>
	<?php }?>
	<?php echo $this->element('front/paging_view');?>
</div>
<?php echo $this->element('front/right_view');?>