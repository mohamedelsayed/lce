<?php $tree = array(array('url' => '/page/view/'.$cat['Cat']['id'], 'str' => $cat['Cat']['title']));
echo $this->element('front'.DS.'breadcrumb', array('tree' => $tree));?>
<script type="text/javascript">
	$(document).ready(function(){
		$(".leftmenuparentout").click(function(){
			var data_id = $(this).attr('data-id');
			show_left_item_menu(data_id);
			/*var div_id = $(this).attr('id');
			$('.leftmenuparent').removeClass('leftmenuparentcurrent');
			$('.leftmenuchild').removeClass('leftmenuchildcurent');
			$('.leftmenuparent i').removeClass('services_menu_arrow_open');
			$('.leftmenuparent i').addClass('services_menu_arrow_close');
			var nextDiv = $(this).next();
			var status = nextDiv.css("display");
			$(".leftmenuchild").fadeOut();
			if(status == 'none'){			
				nextDiv.fadeIn();
				$(this).addClass('leftmenuparentcurrent');
				nextDiv.addClass('leftmenuchildcurent');
				$('#'+div_id+' i').removeClass('services_menu_arrow_close');
				$('#'+div_id+' i').addClass('services_menu_arrow_open');				
			}else if(status == 'block'){								
				nextDiv.fadeOut();								
				$(this).removeClass('leftmenuparentcurrent');
				nextDiv.removeClass('leftmenuchildcurent');
				$('#'+div_id+' i').removeClass('services_menu_arrow_open');
				$('#'+div_id+' i').addClass('services_menu_arrow_close');
			}*/
		});									
	});
	function show_left_item_menu (data_id) {
		$('.leftmenuparent i').not('#child'+data_id+' i').not('.leftmenuparentcurrent'+' i').removeClass('rotate-180');
		$('#child'+data_id+' i').addClass('rotate-180');
		$('.leftmenuchild').not('#childcontent'+data_id).not('.leftmenuchildcurent').slideUp('slow');			
		$('#child'+data_id).next('.leftmenuchild').slideDown('slow');	  
	}
</script>
<div class="leftmenu">
	<?php if(!empty($cat)){?>
		<div class="menu_left">
			<?php echo $cat['Cat']['title'];?>
		</div>
	<?php }?>	
	<?php if(!empty($all_cats)){?>
		<?php $i = 0;$j = 0;
		$first_cat_id = 0;
		foreach ($all_cats as $key => $all_cat) {
			$classtop = '';
			$classout = '';
			$j++;
			if($j == 1){
				$classtop = 'leftmenuchildcurent';
				$classout = 'leftmenuparentcurrent';
				$first_cat_id = $all_cat['Cat']['id'];
			}?>
			<div class="leftmenuparentout" data-id="<?php echo $all_cat['Cat']['id'];?>">
				<div class="leftmenuparent <?php echo $classout;?>" id="child<?php echo $all_cat['Cat']['id'];?>">
					<?php echo $all_cat['Cat']['title'];?>
					<?php if(!empty($all_nodes[$all_cat['Cat']['id']])){?>
					<i class="services_menu_arrow_close"></i>
					<?php }?>
				</div>
				<?php if(!empty($all_nodes[$all_cat['Cat']['id']])){?>
		    		<div class="leftmenuchild <?php echo $classtop;?>" id="childcontent<?php echo $all_cat['Cat']['id'];?>">
		    			<ul>
		    				<?php foreach ($all_nodes[$all_cat['Cat']['id']] as $key => $all_node) {
		    					$i++;
		    					$class = '';
								if($i == 1){
									$class = 'currentnodeitem';								
								}?>
		    					<li data-cat-id="<?php echo $all_cat['Cat']['id'];?>" class="nodeitem <?php echo $class;?>" id="nodeitem<?php echo $all_node['Node']['id'];?>"><?php echo $all_node['Node']['title'];?></li>
		    					<script type="text/javascript">
									$(document).ready(function(){
										$('#nodeitem<?php echo $all_node['Node']['id'];?>').click(function(){
											$('.nodeitemview').removeClass('currentnodeitemview');
											$('.nodeitem').removeClass('currentnodeitem');
											$('#nodeitemview<?php echo $all_node['Node']['id'];?>').addClass('currentnodeitemview');
											$('#nodeitem<?php echo $all_node['Node']['id'];?>').addClass('currentnodeitem');
										});
									});
								</script>
	    					<?php }?>
		    			</ul>
					</div>
				<?php }?>
			</div>
		<?php }?>
	<?php }?>
</div>
<?php if(!empty($all_cats)){?>
	<?php $i = 0;
	foreach ($all_cats as $key => $all_cat) {?>
		<?php if(!empty($all_nodes[$all_cat['Cat']['id']])){?>
			<?php foreach ($all_nodes[$all_cat['Cat']['id']] as $key => $all_node) {
				$i++;
				$class = '';
				if($i == 1){
					$class = 'currentnodeitemview';								
				}?>
				<div class="rightmenu nodeitemview  <?php echo $class;?>" id="nodeitemview<?php echo $all_node['Node']['id'];?>">
					<div class="s_right"><?php echo $all_node['Node']['title'];?></div>
					<div class="nodeitemviewbody">
						<?php echo $all_node['Node']['body'];?>
					</div>
					<?php if($all_node['Node']['duration'] != '' || $all_node['Node']['participants'] != ''){?>
						<div class="s_right_1">Program Details:</div>
						<?php if($all_node['Node']['duration'] != ''){?>
							<div class="s_right_f">Duration</div>
							<div class="s_right_s"><?php echo $all_node['Node']['duration'];?></div>
						<?php }?>
						<?php if($all_node['Node']['participants'] != ''){?>
							<div class="s_right_t">No. of Participants</div>
							<div class="s_right_fo"><?php echo $all_node['Node']['participants'];?></div>
						<?php }?>
						<div class="s_ri"></div>
					<?php }?>
				</div>
			<?php }?>
		<?php }?>
	<?php }?>
<?php }?>
<?php if(isset($_REQUEST['nodeid'])){?>
	<script type="text/javascript">
		$(document).ready(function(){
			var childdivleft = $('#nodeitem<?php echo $_REQUEST['nodeid'];?>').closest("div");
			var prevDiv = childdivleft.prev();
			prevDiv.click();
			$('#nodeitem<?php echo $_REQUEST['nodeid'];?>').click();
		});
	</script>
<?php }?>
<script type="text/javascript">
$(document).ready(function(){
	$('.nodeitem').click(function(){
		var cat_id = $(this).attr('data-cat-id');
		$('.leftmenuchild').not('#childcontent'+cat_id).removeClass('leftmenuchildcurent');
		$('#childcontent'+cat_id).addClass('leftmenuchildcurent');
		$('.leftmenuparent').not('#child'+cat_id).removeClass('leftmenuparentcurrent');
		$('#child'+cat_id).addClass('leftmenuparentcurrent');
	});
	<?php if(isset($_REQUEST['childid'])){?>		
		show_left_item_menu(<?php echo $_REQUEST['childid'];?>);	
		var childdiv = $('#child<?php echo $_REQUEST['childid'];?>');
		var nextDiv = childdiv.next();
		var divid = nextDiv.attr('id');
		<?php /*childdiv.click();*/?>
		$('#'+divid+' li:first').click();
	<?php }else{?>
		show_left_item_menu(<?php echo $first_cat_id;?>);	
		<?php /*var childdiv = $('#child<?php echo $first_cat_id;?>');
		var nextDiv = childdiv.next();
		var divid = nextDiv.attr('id');
		childdiv.click();
		$('#'+divid+' li:first').click();*/?>	
	<?php }?>
});
</script>
<style type="text/css">
.rotate-180 {
	 -webkit-transition: .5s ease-in-out;
    -moz-transition: .5s ease-in-out;
    -o-transition: .5s ease-in-out;
    transition: .5s ease-in-out;
    display:inline-block;
	-webkit-transform: rotate(180deg);
	-moz-transform: rotate(180deg);
	-ms-transform: rotate(180deg);
	transform: rotate(180deg);
	-o-transform: rotate(180deg);
}
.services_menu_arrow_close{
	width: 12px;
	height: 7px;
}
</style>