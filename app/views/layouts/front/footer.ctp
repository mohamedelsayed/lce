<div class="bottom_big" style="float: left;">
<div class="bottom_big_container">
<div class="footer_main">
<div class="logo">
			<a href="#">
				<img src="<?php echo $this->Session->read('Setting.url').'/img/front/';?>logo_footer.png" />
			</a>
		</div>
<div class="col-md-3 footer-grid">
					<h3 class="title">ABOUT US</h3>
					<ul>
						<li><a href="#">Who we are?</a></li>
						<li><a href="#">Vision & Mission</a></li>
						<li><a href="#">Values</a></li>
						<li><a href="#">Board Members</a></li>
						<li><a href="#">Our Team</a></li>
					</ul>
				</div>
                <div class="col-md-4 footer-grid">
					<h3 class="title">OUR SERVICES</h3>
					<ul>
						<li><a href="#">Workshops/Trainings</a></li>
						<li><a href="#">Programs</a></li>
						<li><a href="#">Excutive/Business Coaching</a></li>
						<li><a href="#">Coaching Certification Programs</a></li>
					</ul>
				</div>
                 <div class="col-md-5 footer-grid">
					<h3 class="title">OUR CLIENTS/PARTNERS</h3>
					<ul>
						<li><a href="#">Clients</a></li>
						<li><a href="#">Partners</a></li>
						<li><a href="#">Testimonials</a></li>
					</ul>
				</div>
                <div class="col-md-1 footer-grid">
					<a href="#" class="title">UPCOMING EVENTS</a>
                    <a href="#" class="footer_grid_title">FIND A COACH</a>
                    <a href="#" class="footer_grid_title">CONTACT US</a>
				</div>
                <div class="col-md-12">
				</div>
				<?php /*
	<div class="top_grop">
        <?php echo $this->Javascript->link('front/ajax/newsletter'); ?>
		<script type="text/javascript">
		    $(document).ready(function(){
		        $("#send_form").click(function(){			
					sendForm('<?php echo $this->Session->read('Setting.url');?>');		          
		        });             
		    });
		</script>
		<?php echo $this->Form->create('newsletter', array('id' => 'newsletterForm'));?>
    	<div class="adders_grop">
    		<img src="<?php echo $this->Session->read('Setting.url').'/img/front/';?>bg_g.jpg" />
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
	</div>*/?>
	<div class="facebook_fotter">
    <?php if($this->Session->read('Setting.facbook_link') != ''){?>
			<div class="fase">
				<a target="_blank" href="<?php echo $this->Session->read('Setting.facbook_link');?>">
					<img src="<?php echo $this->Session->read('Setting.url').'/img/front/';?>face_home.png"/>
				</a>
			</div>
		<?php }?>
		<?php if($this->Session->read('Setting.linkedin_link') != ''){?>
			<div class="fase">
				<a target="_blank" href="<?php echo $this->Session->read('Setting.linkedin_link');?>">
					<img src="<?php echo $this->Session->read('Setting.url').'/img/front/';?>icon_in.png"/>
				</a>
			</div>
		<?php  }?>		
        <?php if($this->Session->read('Setting.twitter_link') != ''){?>
			<div class="fase">
				<a target="_blank" href="<?php echo $this->Session->read('Setting.twitter_link');?>">
					<img src="<?php echo $this->Session->read('Setting.url').'/img/front/';?>twitter_home.png"/>
				</a>
			</div>
		<?php }?>	
		<?php if($this->Session->read('Setting.youtube_link') != ''){?>
			<div class="fase">
				<a target="_blank" href="<?php echo $this->Session->read('Setting.youtube_link');?>">
					<img src="<?php echo $this->Session->read('Setting.url').'/img/front/';?>twitter_home.png"/>
				</a>
			</div>
		<?php }?>
	</div>
	<?php /*
	<div class="menu_grop">
		<a href="<?php echo $this->Session->read('Setting.url');?>"><?php echo $this->Session->read('Setting.home_string');?></a>
		<?php if(!empty($header_cats)){
        	foreach ($header_cats as $key => $header_cat) {?>
        		<a href="<?php echo $this->Session->read('Setting.url').'/page/view/'.$header_cat['Cat']['id'];?>">
        			<?php echo $header_cat['Cat']['title'];?>
    			</a>
    		<?php }?>
		<?php }?>
		<a href="<?php echo $this->Session->read('Setting.url').'/article/all';?>"><?php echo $this->Session->read('Setting.blog_string');?></a>
		<a href="<?php echo $this->Session->read('Setting.url').'/faq';?>"><?php echo $this->Session->read('Setting.faq_fotter_string');?></a>
		<a href="<?php echo $this->Session->read('Setting.url').'/contact-us';?>"><?php echo $header_contact_us_title;?></a>
	</div>*/?>
	<div class="left_bot"><?php echo $this->Session->read('Setting.footer');?></div>
	<div id="Developer">
		Developed by <a href="http://www.mohamedelsayed.net" target="_blank">Mohamed Elsayed</a>
	</div>
</div>
</div>
</div>
<style type="text/css">	
#newsletter_ajaxLoading{
	display:none;	
	width: 80px;
	height:15px;
	background-image: url(<?php echo $this->Session->read('Setting.url').'/img/front/tloading.gif'?>);
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
	/*width: 100%;*/
	float:left;
	padding-left: 90px; 
}
</style>