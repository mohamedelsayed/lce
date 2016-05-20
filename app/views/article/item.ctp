<?php //print_r($article);
$article_link = $base_url.'/article/item/'.$article['Article']['id'];
$image = '';
if(isset($article['Gal'])){
	$image = $base_url.'/img/upload/'.$article['Gal'][0]['image'];
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
$comments_count = count($article['Comment']);?>
<div class="t_p_con">
	<?php /*<div class="top_con_2">Blog</div>*/?>
	<div class="top_con_3">Latest Posts</div>
	<div class="con_con">
        <div class="mm_top"><?php echo $title;?></div>
    </div>
    <div class="con_con article_date_div">
    	<div class="mm_out">
    		<img src="<?php echo $base_url.'/img/front/';?>m_o.jpg"/>		    			
		</div>
		<div class="mm_tt">
			<?php echo $this->element('front/english_date_view', array('date' => $article['Article']['date']));?>
		</div>
		<div class="mm_out">
			<img src="<?php echo $base_url.'/img/front/';?>m_o_2.jpg"/>
		</div>
		<div class="mm_tt"><?php echo $article['Article']['creator'];?></div>
		<div class="mm_out">
			<img src="<?php echo $base_url.'/img/front/';?>m_o_3.jpg"/>
		</div>
		<div class="mm_tt"><?php echo $comments_count;?> Comments</div>
	</div>	
	<div class="con_con article_tags_div">
		<?php if($article['Article']['tags'] != ''){
			$tags = explode(",", $article['Article']['tags']);?>
			<div class="mm_out">
				<img src="<?php echo $base_url.'/img/front/';?>m_o_4.jpg"/>
			</div>
			<?php foreach ($tags as $key => $tag) {?>			
				<div class="nology">
					<a href="<?php echo $base_url.'/article/all/'.trim($tag);?>"><?php echo $tag;?></a>
				</div>
			<?php }?>
		<?php }?>
	</div>
	<?php /*<div class="con_con">
		<?php if(isset($article['Gal'][0])){?>
			<div class="mtm_t article_image">
				<img src="<?php echo $image;?>" alt="<?php echo $title;?>"/>
			</div>
		<?php }?>
	</div>*/?>
	<div class="con_con article_image_new_div">
		<?php if(isset($article['Gal'][0])){?>
			<div class="mtm_t article_image_new">
				<img src="<?php echo $image;?>" alt="<?php echo $title;?>"/>
			</div>
		<?php }?>
	</div>
	<div class="con_con headerlistiteminner">
		<div class="bot_tom"><?php echo $body;?></div>
	</div>
	<div class="facebookcommentsdiv">
		<div class="fb-comments" data-href="<?php echo $article_link;?>" data-width="620" data-numposts="<?php echo $commentLimit;?>" data-colorscheme="light"></div>
	</div>
	<?php //include_once('comments.ctp');?>
</div>
<?php echo $this->element('front/right_view');?>