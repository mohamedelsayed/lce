<div class="bottom_big" style="float: left;">
	<div class="bottom_big_container">
		<div class="footer_main">
			<div class="logo_footer">
				<a href="<?php echo $base_url;?>">
					<img src="<?php echo $base_url.'/img/front/';?>logo_footer.png" />
				</a>
			</div>
			<?php if(!empty($header_cats)){
				$i = 3;
            	foreach ($header_cats as $key => $header_cat) {?>
            		<div class="col-md-<?php echo $i++;?> footer-grid uppercase_text">
            			<a href="<?php echo $base_url.'/page/view/'.$header_cat['Cat']['id'];?>" >
							<h3 class="title"><?php echo $header_cat['Cat']['title'];?></h3>
						</a>
						<?php if(!empty($header_cat['Node'])){?>
				            <ul>
				            	<?php foreach ($header_cat['Node'] as $key => $header_cat_node) { ?>
					            	<li>
					            		<a href="<?php echo $base_url.'/page/view/'.$header_cat['Cat']['id'].'?nodeid='.$header_cat_node['id'];?>"><?php echo $header_cat_node['title'];?></a>
					        		</li>
				        		<?php }?>
							</ul>
						<?php }elseif(!empty($header_cat['ChildCat'])){?>
							<ul>
				            	<?php foreach ($header_cat['ChildCat'] as $key => $header_cat_child) {?>
					            	<li>
					            		<a href="<?php echo $base_url.'/page/show/'.$header_cat['Cat']['id'].'?childid='.$header_cat_child['id'];?>"><?php echo $header_cat_child['title'];?></a>
					        		</li>
				        		<?php }?>
							</ul>
						<?php }?>
					</div>
				<?php }?>
			<?php }?>
            <div class="col-md-1 footer-grid">
				<a href="<?php echo $base_url.'/all-events';?>" class="title">UPCOMING EVENTS</a>
                <a href="<?php echo $base_url.'/all-coaches';?>" class="footer_grid_title">FIND A COACH</a>
                <a href="<?php echo $base_url.'/contact-us';?>" class="footer_grid_title">CONTACT US</a>
			</div>
            <div class="col-md-12"></div>
			<div class="facebook_fotter">
		    	<?php if($this->Session->read('Setting.facbook_link') != ''){?>
					<div class="fase">
						<a target="_blank" href="<?php echo $this->Session->read('Setting.facbook_link');?>">
							<img src="<?php echo $base_url.'/img/front/';?>face_home.png"/>
						</a>
					</div>
				<?php }?>
				<?php if($this->Session->read('Setting.linkedin_link') != ''){?>
					<div class="fase">
						<a target="_blank" href="<?php echo $this->Session->read('Setting.linkedin_link');?>">
							<img src="<?php echo $base_url.'/img/front/';?>icon_in.png"/>
						</a>
					</div>
				<?php  }?>		
		        <?php if($this->Session->read('Setting.twitter_link') != ''){?>
					<div class="fase">
						<a target="_blank" href="<?php echo $this->Session->read('Setting.twitter_link');?>">
							<img src="<?php echo $base_url.'/img/front/';?>twitter_home.png"/>
						</a>
					</div>
				<?php }?>	
				<?php if($this->Session->read('Setting.youtube_link') != ''){?>
					<div class="fase">
						<a target="_blank" href="<?php echo $this->Session->read('Setting.youtube_link');?>">
							<img src="<?php echo $base_url.'/img/front/';?>twitter_home.png"/>
						</a>
					</div>
				<?php }?>
			</div>
			<div class="left_bot"><?php echo $this->Session->read('Setting.footer');?></div>
            <div class="payment">
            <a href="#" class="payment_logo">
            <img src="<?php echo $base_url.'/img/front/';?>secured.png"/>
            </a>
            <a href="#" class="payment_logo">
            <img src="<?php echo $base_url.'/img/front/';?>visa.jpg"/>
            </a>
            <a href="#" class="payment_logo">
            <img src="<?php echo $base_url.'/img/front/';?>mastercard.png"/>
            </a>
            <a href="#" class="payment_logo">
            <img src="<?php echo $base_url.'/img/front/';?>choose.png"/>
            </a>
            </div>
			<div id="Developer">
				Developed by <a href="http://www.mohamedelsayed.net" target="_blank">Mohamed Elsayed</a>
			</div>
		</div>
	</div>
</div>
<?php /*
	<div class="top_grop">
        <?php echo $this->Javascript->link('front/ajax/newsletter'); ?>
		<script type="text/javascript">
		    $(document).ready(function(){
		        $("#send_form").click(function(){			
					sendForm('<?php echo $base_url;?>');		          
		        });             
		    });
		</script>
		<?php echo $this->Form->create('newsletter', array('id' => 'newsletterForm'));?>
    	<div class="adders_grop">
    		<img src="<?php echo $base_url.'/img/front/';?>bg_g.jpg" />
		</div>		
        <div class="input_2">
        	<input name="data[newsletter][email]" class="inpu_lce" type="text" id="email" name="email" placeholder="Your Email Address.." />
    	</div>
    	<div class="Suche_2">
			<input class="Suche_a" type="button" value="Subscribe" id="send_form" style="cursor: pointer;">
		</div>
		<div class="ajax_result_adv">        
			<div id="newsletter_ajaxLoading"></div>
            <div id="newsletter_Result" ></div>
        </div>
        <?php echo $this->Form->end(__('', true,array('class' => '')));?>
	</div>
	<div class="menu_grop">
		<a href="<?php echo $base_url;?>"><?php echo $this->Session->read('Setting.home_string');?></a>
		<?php if(!empty($header_cats)){
        	foreach ($header_cats as $key => $header_cat) {?>
        		<a href="<?php echo $base_url.'/page/view/'.$header_cat['Cat']['id'];?>">
        			<?php echo $header_cat['Cat']['title'];?>
    			</a>
    		<?php }?>
		<?php }?>
		<a href="<?php echo $base_url.'/article/all';?>"><?php echo $this->Session->read('Setting.blog_string');?></a>
		<a href="<?php echo $base_url.'/faq';?>"><?php echo $this->Session->read('Setting.faq_fotter_string');?></a>
		<a href="<?php echo $base_url.'/contact-us';?>"><?php echo $header_contact_us_title;?></a>
	</div>			
<style type="text/css">	
#newsletter_ajaxLoading{
	display:none;	
	width: 80px;
	height:15px;
	background-image: url(<?php echo $base_url.'/img/front/tloading.gif'?>);
	background-repeat: no-repeat;
}
#newsletter_Result{
	font-size:11px;
	font-weight:100;
	color: #FFFFFF;
	width: 300px;
	font-family:OpenSans-Regular; 
	font-size:13px; 
	font-weight:bold; 
	color:#FFFFFF; 
}
.ajax_result_adv{
	margin-top: 5px;
	float:left;
	padding-left: 90px; 
}
</style>*/?>