<div class="header_big">
	<div class="header">
		<div class="logo">
			<a href="<?php echo $base_url;?>">
				<img src="<?php echo $base_url.'/img/front/';?>logo_header.png" />
			</a>
		</div>
        <div class="menu_">
        	<ul id="jMenu" class="menu">
        		<li>
        			<a id="home" href="<?php echo $base_url;?>" class="fNiv"><?php echo $this->Session->read('Setting.home_string');?></a>
    			</li>
				<?php if(!empty($header_cats)){
	            	foreach ($header_cats as $key => $header_cat) {?>
	            		<li class="header_menu_li header_menu_li<?php echo $header_cat['Cat']['id'];?>">
			            	<a href="<?php echo $base_url.'/page/view/'.$header_cat['Cat']['id'];?>" class="fNiv" id="page<?php echo $header_cat['Cat']['id'];?>">
			            		<?php echo $header_cat['Cat']['title'];?>
                                <i class="header_menu_arrow"></i>
		            		</a>
		            		<?php if(!empty($header_cat['Node'])){?>
					            <ul style="width: auto;overflow: hidden;">
					            	<?php foreach ($header_cat['Node'] as $key => $header_cat_node) { ?>
						            	<li class="submenu">
						            		<a href="<?php echo $base_url.'/page/view/'.$header_cat['Cat']['id'].'?nodeid='.$header_cat_node['id'];?>"><?php echo $header_cat_node['title'];?></a>
						        		</li>
					        		<?php }?>
								</ul>
							<?php }elseif(!empty($header_cat['ChildCat'])){?>
								<ul style="width: auto;overflow: hidden;">
					            	<?php foreach ($header_cat['ChildCat'] as $key => $header_cat_child) {?>
						            	<li class="submenu">
						            		<a href="<?php echo $base_url.'/page/show/'.$header_cat['Cat']['id'].'?childid='.$header_cat_child['id'];?>"><?php echo $header_cat_child['title'];?></a>
						        		</li>
					        		<?php }?>
								</ul>
							<?php }?>
						</li>
					<?php }?>
				<?php }?>
				<li>
					<a id="frontcoaches" href="<?php echo $base_url.'/all-coaches';?>" class="fNiv">Find a coach</a>
				</li>
				<li>
					<a id="frontevents" href="<?php echo $base_url.'/all-events';?>" class="fNiv">upcoming events</a>
				</li>
				<li>
					<a id="content" href="<?php echo $base_url.'/contact-us';?>" class="fNiv"><?php echo $header_contact_us_title;?></a>
				</li>
			</ul>
		</div>
	</div>
</div>
<?php if(isset($selected)){?>
	<script type="text/javascript">
	$(document).ready(function() {
		$('#<?php echo $selected;?>').addClass('selected');
	});
	</script>
<?php }?>
<?php include_once 'frontevents.php'; ?>
<?php include_once 'frontcoaches.php';?>
<?php /*
		<?php if(!empty($quote)){
			$quote_name = $quote['Quote']['name'];
			$quote_body = strip_tags(trim($quote['Quote']['body']));?>
			<div class="men_etop">
				<div class="men_e">"<?php echo $quote_body;?>"</div>
				<div class="men_a">- <?php echo $quote_name;?></div>
			</div>
		<?php }?> 
	</div>
</div>
<div class="menu_big">
	<div class="menu">
		<ul id="jMenu">
			<li>
				<a href="<?php echo $base_url;?>" class="fNiv" id="home" ><?php echo $this->Session->read('Setting.home_string');?></a>           
            </li>
            <?php if(!empty($header_cats)){
            	foreach ($header_cats as $key => $header_cat) {?>
            		<li>
		            	<a href="<?php echo $base_url.'/page/view/'.$header_cat['Cat']['id'];?>" class="fNiv" id="page<?php echo $header_cat['Cat']['id'];?>">
		            		<?php echo $header_cat['Cat']['title'];?>
	            		</a>
	            		<?php if(!empty($header_cat['Node'])){?>
				            <ul>
				            	<?php foreach ($header_cat['Node'] as $key => $header_cat_node) {
				            		//print_r($header_cat_node); ?>
					            	<li class="submenu">
					            		<a style="width: 200px;" href="<?php echo $base_url.'/page/view/'.$header_cat['Cat']['id'].'?nodeid='.$header_cat_node['id'];?>"><?php echo $header_cat_node['title'];?></a>
					        		</li>
				        		<?php }?>
							</ul>
						<?php }elseif(!empty($header_cat['ChildCat'])){?>
							<ul>
				            	<?php foreach ($header_cat['ChildCat'] as $key => $header_cat_child) {?>
					            	<li class="submenu">
					            		<a style="width: 310px;" href="<?php echo $base_url.'/page/show/'.$header_cat['Cat']['id'].'?childid='.$header_cat_child['id'];?>"><?php echo $header_cat_child['title'];?></a>
					        		</li>
				        		<?php }?>
							</ul>
						<?php }?>
					</li>
				<?php }?>
			<?php }?>
            <li>
            	<a id="blog" href="<?php echo $base_url.'/article/all';?>" class="fNiv" id="careers"><?php echo $this->Session->read('Setting.blog_string');?></a>           
            </li>
            <li>
            	<a id="faqs" href="<?php echo $base_url.'/faq';?>" class="fNiv" id="faqs"><?php echo $this->Session->read('Setting.faq_string');?></a>           
            </li>
            <li>
            	<a id="content" href="<?php echo $base_url.'/contact-us';?>" class="fNiv" id="contact"><?php echo $header_contact_us_title;?></a>           
            </li>
        </ul>
    </div>
</div>*/?>
<?php /*<script type="text/javascript">
$(document).ready(function() {
    $('#cssmenu #menu-button').on('click', function(){
		var menu = $(this).next('ul');
		if (menu.hasClass('open')) {
			menu.removeClass('open');
		}else {
			menu.addClass('open');
		}
	});
});
</script>*/?>
<style type="text/css">
	li.header_menu_li2 ul li a{
		min-width: 310px;		
	}
</style>