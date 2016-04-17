<div class="data">
	<?php echo $this->element('front/breadcrumb',array('tree' => $tree));?>
	<?php echo $this->element('front/left_menu',array('type' => 'exhibition', 'left_selected' => $left_selected,'left_cats' => $left_cats,'artist_id' => $artist['Artist']['id']));?>
	<div class="data-right">
		<?php if(isset($cat) && $cat['Cat']['under_construction'] == 1){
			if($cat['Cat']['body'] != null){
				echo $cat['Cat']['body'];
			}
			else{
				echo '<div class="no_data_found">Sorry this section is under construction';
			}
		}else {?>
			<?php if($left_selected != 'events'){
				/*if($left_selected == 'artwork' && (!empty($nodes) || !empty($cats))){?>			
					<?php $current_page = 1;
					if(isset($this->params['named']['page'])) $current_page = $this->params['named']['page'];
					if($current_page == 1){
						$link = $this->Session->read('Setting.url').'/artist/category/'.$artist['Artist']['id'].'/all';?>
						<a href="<?php echo $link;?>">
							<div class="work-item">
								<div class="work-item-pic">
									<img src="<?php echo $this->Session->read('Setting.url').'/img/upload/'.$artist['Artist']['image'];?>" />
								</div>
								<div class="work-item-tit">All</div>
							</div>
						</a>
					<?php }?>
				<?php }*/?>
				<?php if(isset($cat) && $cat['Cat']['body'] != null){
					echo $cat['Cat']['body'];            
				}elseif(!empty($cats)){
					foreach ($cats as $cat) {
						$link = $this->Session->read('Setting.url').'/exhibition/index/'.$cat['Cat']['id'];?>
						<a href="<?php echo $link;?>">
							<div class="work-item">
								<div class="work-item-pic">
									<img src="<?php echo $this->Session->read('Setting.url').'/img/upload/'.$cat['Cat']['image'];?>" />
								</div>
								<div class="work-item-tit">
									<?php echo $cat['Cat']['title'];?>
								</div>
							</div>
						</a>
					<?php }?>				
				<?php }elseif(!empty($nodes)){?>
					<?php echo $this->Html->css('front/reveal', false);
					echo $this->Javascript->link('front/jquery.reveal', false);?>
					<script type="text/javascript">
						$(document).ready(function() {
							$(".data-right").css('width',745);
							$(".data-menu").css('margin-left',195);
							$(".data-left").css('width',155);
							$(".data-left").css('margin-right',10);
						});
					</script>
					<?php echo $this->element('front/common_node_code');?>
					<?php $i = 1;
					$j = 0;
					foreach ($nodes as $node) {?>
						<?php echo $this->element('front/node_view',array('node' => $node,'j' => $j));					
						if(($i++%4) == 0){?>
							<div class="lineblock"></div>
						<?php }?>
					<?php $j++;}?>					
				<?php }/*elseif(isset($cat) && $cat['Cat']['body'] != null){
					echo $cat['Cat']['body'];            
				}*/else echo '<div class="no_data_found">No data found.</div>';?>
				<?php if(!empty($nodes) || !empty($cats)){?>
					<?php echo $this->element('front/paging_view');?>					
				<?php }?>			
			<?php }else{
				if(!empty($events)){
					foreach ($events as $event) {?>
						<div class="events-item">
							<div class="events-title">
								<?php echo $event['Event']['title'];?>
							</div>
		                	<div class="events-video">
		                		<?php if(isset($event['Video'][0])){?>
				    				 <?php echo $this->element('front/video_view',array('record' => $event['Video'][0]));?>
								<?php }?>           
	                		</div>
	                		<div class="events-data">
	                			<?php echo $event['Event']['body'];?>
                			</div>
            			</div>
					<?php }?>
					<?php /*if($content_event['Content']['body'] != null){?>
						<div class="events-item">
		                	<div class="events-video">
		                		<?php if(isset($content_event['Video'][0])){?>
				    				 <?php echo $this->element('front/video_view',array('record' => $content_event['Video'][0]));?>
								<?php }?>           
		            		</div>
		                </div>
						<?php echo $content_event['Content']['body'];
					}*/
				}else echo '<div class="no_data_found">No data found.</div>';		
			}?>
		<?php }?>
    </div>
</div>