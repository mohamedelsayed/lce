<div class="t_p_con index" style="margin-left: 0px;">
	<?php if(isset($page_title)){?>
		<div class="category_title" style="float: left;width: 100%;">
			<h2><?php echo $page_title;?></h2>
		</div>				
	<?php }?>
	<?php $sections = array();
	$section_title_style = '';
	if(isset($hide_section_title)){
		$section_title_style = 'display:none';		
	}
	if(!empty($libraries)){?>
		<?php foreach ($libraries as $key => $library) {
			$sections[$library['Library']['type2']][] = $library;
		}
		foreach ($forum_libraries_types2 as $key => $sections_items) {
			if(isset($sections[$key])){
				$sections_items = $sections[$key];					
				if(!empty($sections_items)){?>
					<div class="sections_wrapper" style="float: left;width: 100%;">
						<h3 style="<?php echo $section_title_style;?>"><?php echo $forum_libraries_types2[$key];?></h3>
						<?php if($key == 4 || isset($is_photo_gallery)){?>
							<?php echo $this->element('forum/library_photos', array('sections_items' => $sections_items));?>							      							
						<?php }else{?>
							<?php foreach ($sections_items as $k => $item) {
								$element = '';								
								if($key == 4){									
								}elseif($key == 5){
									$element = 'library_video_file';									
								}else{
									$element = 'library_download_file';								
								}
								if($element != ''){?>
									<div class="con_con">
										<?php echo $this->element('forum/'.$element, array('item' => $item, 'type' => $key));?>
								    </div>									
							    <?php }?>
							<?php }?>
						<?php }?>
					</div>
				<?php }?>
			<?php }?>	
		<?php }?>			
    <?php }else{?>
    	<div class="no-data-found">No data found.</div>
	<?php }?>
</div>