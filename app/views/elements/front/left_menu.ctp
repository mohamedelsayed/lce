<div class="data-left">
	<div class="data-leftin">
		<?php 
		$inner_cat_id = '';
		if(isset($this->params['pass'][1]))
		$inner_cat_id = $this->params['pass'][1];
		elseif(isset($this->params['pass'][0]))
		$inner_cat_id = $this->params['pass'][0];?>
		<?php if($type == 'artist'){?>
			<?php $class = '';
			if(!empty($left_cats_children)){
				$class = 'subselected';
			}			
			elseif($left_selected == 'artwork')
			$class = 'selected';?>		
			<a <?php echo 'class="'.$class.'"';?> href="<?php echo $base_url.'/'.$this->element('front/clean_title',array('artistName' => $artist['Artist']['name']));?>">Artworks</a>
			<?php if(isset($left_cats_children) && !empty($left_cats_children)){
				$inner_class = 'sub';
        		if($inner_cat_id == 'all'){
        			$inner_class = 'subcurrent';
    			}?>
				<a class="<?php echo $inner_class;?>" href="<?php echo $base_url.'/'.$this->element('front/clean_title',array('artistName' => $artist['Artist']['name'])).'/category'.'/all';?>">- All</a>
	            <?php if(!empty($left_cats_children)){
	            	foreach ($left_cats_children as $left_cats_children_item) {
	            		$inner_class = 'sub';
	            		if($left_cats_children_item['Cat']['id'] == $inner_cat_id){
	            			$inner_class = 'subcurrent';
            			}?>
	            		<a class="<?php echo $inner_class;?>" href="<?php echo $base_url.'/'.$this->element('front/clean_title',array('artistName' => $artist['Artist']['name'])).'/category/'.$left_cats_children_item['Cat']['id'];?>">
	            			- <?php echo $left_cats_children_item['Cat']['title'];?>
	        			</a>
	    			<?php }?>
				<?php }?>
				<?php /*<script type="text/javascript">
					$(document).ready(function() {
						$(".data-right").css('width',745);
						$(".data-menu").css('margin-left',195);
						$(".data-left").css('width',155);
						$(".data-left").css('margin-right',10);
					});
				</script>*/?>
	        <?php }?>
			<a <?php if($left_selected == 'biography') echo 'class="selected"';?> href="<?php echo $base_url.'/'.$this->element('front/clean_title',array('artistName' => $artist['Artist']['name'])).'/biography';?>">Biography</a>
		<?php }?>
		<?php if(!empty($left_cats)){
			$first = 0;
			foreach ($left_cats as $left_cat) {				
				if($type == 'exhibition'){
					$left_cat_link = $base_url.'/exhibition/index/'.$left_cat['Cat']['id'];
				}elseif($type == 'artist'){
					$left_cat_link = $base_url.'/'.$this->element('front/clean_title',array('artistName' => $artist['Artist']['name'])).'/category/'.$left_cat['Cat']['id'];
				}?>
				<?php $class = '';
				if($left_selected == $left_cat['Cat']['id']){
					$class = 'selected';
					if(!empty($left_cats_children_ex) && (count($left_cats_children_ex) > 0)){
						if($left_cat['Cat']['id'] == $left_cats_children_ex[0]['Cat']['parent_id']){
							if($left_cat['Cat']['id'] == $inner_cat_id)
							$class = 'selected';
							else
							$class = 'subselected';
						}
					}else
					$class = 'selected';
					if($first++ == 0 && $this->params['url']['url'] == 'exhibition')
					$class = 'selected';
				}?>
				<a <?php echo 'class="'.$class.'"';?> href="<?php echo $left_cat_link;?>">
					<?php echo $left_cat['Cat']['title'];?>
				</a>
				<?php if(isset($left_cats_children_ex) && !empty($left_cats_children_ex)){?>
		            <?php if(!empty($left_cats_children_ex)){
		            	if($left_cat['Cat']['id'] == $left_cats_children_ex[0]['Cat']['parent_id']){
			            	foreach ($left_cats_children_ex as $left_cats_children_ex_item) {
			            		$inner_class = 'sub';
			            		if($left_cats_children_ex_item['Cat']['id'] == $inner_cat_id){
			            			$inner_class = 'subcurrent';
		            			}
			            		if($type == 'exhibition'){
									$left_sub_cat_link = $base_url.'/exhibition/index/'.$left_cats_children_ex_item['Cat']['id'];
								}elseif($type == 'artist'){
									$left_sub_cat_link = $base_url.'/artist/category/'.$artist_id.'/'.$left_cats_children_ex_item['Cat']['id'];
								}?>
			            		<a class="<?php echo $inner_class;?>" href="<?php echo $left_sub_cat_link;?>">
			            			- <?php echo $left_cats_children_ex_item['Cat']['title'];?>
			        			</a>
			    			<?php }?>
		    			<?php }?>
					<?php }?>
					<?php /*<script type="text/javascript">
						$(document).ready(function() {
							$(".data-right").css('width',745);
							$(".data-menu").css('margin-left',195);
							$(".data-left").css('width',155);
							$(".data-left").css('margin-right',10);
						});
					</script>*/?>
		        <?php }?>			
			<?php }?>
		<?php }?>
		<?php if($type == 'exhibition'){?>	
			<a <?php if($left_selected == 'events') echo 'class="selected"';?> href="<?php echo $base_url.'/exhibition/events';?>" >
				<?php echo $left_event_title;?>
			</a>
		<?php }?>
	</div>
</div>