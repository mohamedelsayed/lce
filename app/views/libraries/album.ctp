<div class="t_p_con index" style="margin-left: 0px;">
	<?php if(isset($page_title)){?>
		<div class="category_title" style="float: left;width: 100%;">
			<h2><?php echo $page_title;?></h2>
		</div>				
	<?php }?>
	<?php if(!empty($library)){?>
		<?php echo $this->element('forum/library_gallery', array('library' => $library));?>	
    <?php }else{?>
    	<div class="no-data-found">No data found.</div>
	<?php }?>
</div>