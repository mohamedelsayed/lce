<div class="header_big">
	<div class="header">
		<div class="logo">
			<a href="<?php echo $this->Session->read('Setting.url');?>">
				<img src="<?php echo $this->Session->read('Setting.url').'/img/front/';?>logo.png" />
			</a>
		</div>
        <div id='cssmenu'>
<ul>
   <li><a href='#'><span>Home</span></a></li>
   <li><a href='#'><span>About us</span></a></li>
   <li class='active has-sub'><a href='#'><span>Our Services</span></a></li>
  <ul>
         <li><a href='#'><span>Workshops/Trainings</span></a></li>
         <li><a href='#'><span>Programs</span></a></li>
         <li><a href='#'><span>Executive/business coaching</span></a></li>
         <li><a href='#'><span>coaching certification programs</span></a></li>
      </ul>
   <li><a href='#'><span>Our Clients/Partners</span></a></li>
   <li><a href='#'><span>Find a coach</span></a></li>
   <li><a href='#'><span>upcoming events</span></a>
   <li><a href='#'><span>Contact Us</span></a></li>
   </li>
</ul>
</div>
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
				<a href="<?php echo $this->Session->read('Setting.url');?>" class="fNiv" id="home" ><?php echo $this->Session->read('Setting.home_string');?></a>           
            </li>
            <?php if(!empty($header_cats)){
            	foreach ($header_cats as $key => $header_cat) {?>
            		<li>
		            	<a href="<?php echo $this->Session->read('Setting.url').'/page/view/'.$header_cat['Cat']['id'];?>" class="fNiv" id="page<?php echo $header_cat['Cat']['id'];?>">
		            		<?php echo $header_cat['Cat']['title'];?>
	            		</a>
	            		<?php if(!empty($header_cat['Node'])){?>
				            <ul>
				            	<?php foreach ($header_cat['Node'] as $key => $header_cat_node) {
				            		//print_r($header_cat_node); ?>
					            	<li class="submenu">
					            		<a style="width: 200px;" href="<?php echo $this->Session->read('Setting.url').'/page/view/'.$header_cat['Cat']['id'].'?nodeid='.$header_cat_node['id'];?>"><?php echo $header_cat_node['title'];?></a>
					        		</li>
				        		<?php }?>
							</ul>
						<?php }elseif(!empty($header_cat['ChildCat'])){?>
							<ul>
				            	<?php foreach ($header_cat['ChildCat'] as $key => $header_cat_child) {?>
					            	<li class="submenu">
					            		<a style="width: 310px;" href="<?php echo $this->Session->read('Setting.url').'/page/show/'.$header_cat['Cat']['id'].'?childid='.$header_cat_child['id'];?>"><?php echo $header_cat_child['title'];?></a>
					        		</li>
				        		<?php }?>
							</ul>
						<?php }?>
					</li>
				<?php }?>
			<?php }?>
            <li>
            	<a id="blog" href="<?php echo $this->Session->read('Setting.url').'/article/all';?>" class="fNiv" id="careers"><?php echo $this->Session->read('Setting.blog_string');?></a>           
            </li>
            <li>
            	<a id="faqs" href="<?php echo $this->Session->read('Setting.url').'/faq';?>" class="fNiv" id="faqs"><?php echo $this->Session->read('Setting.faq_string');?></a>           
            </li>
            <li>
            	<a id="content" href="<?php echo $this->Session->read('Setting.url').'/contact-us';?>" class="fNiv" id="contact"><?php echo $header_contact_us_title;?></a>           
            </li>
        </ul>
    </div>
</div>*/?>
<script type="text/javascript">
$(document).ready(function() {
    $('#cssmenu #menu-button').on('click', function(){
		var menu = $(this).next('ul');
		if (menu.hasClass('open')) {
			menu.removeClass('open');
		}
		else {
			menu.addClass('open');
		}
	});
} )
</script>
<?php if(isset($selected)){?>
	<script type="text/javascript">
	$(document).ready(function() {
    $('#cssmenu #menu-button').on('click', function(){
		var menu = $(this).next('ul');
		if (menu.hasClass('open')) {
			menu.removeClass('open');
		}
		else {
			menu.addClass('open');
		}
	});
} )
	</script>
<?php }?>