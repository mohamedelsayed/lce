<?php $tree = array(array('url' => '/contact-us', 'str' => $content['Content']['title']));
echo $this->element('front'.DS.'breadcrumb', array('tree' => $tree));?>
<div class="title_event_page">
	<p><?php echo $content['Content']['title'];?></p>
</div>
<div id="requestpopup" class="mesage-pop">
	<h4>Contact Us<div id="closealert" class="closealert">X</div></h4>
	<div id="contactus_Resultdiv"></div>
</div>
<div id="mesagepopbox" class="mesage-pop" >
	<div id="mesagecontent">
    </div>
    <div class="mesage-pop-bg"></div>
</div>	
<script type="text/javascript">
	function opennorequestpopup(){
		var content = jQuery('#requestpopup').html();
		jQuery("#mesagepopbox #mesagecontent").html(content); 
		jQuery("#mesagepopbox").addClass("alert"); 
		jQuery("#mesagepopbox").show();                								
		jQuery('body').addClass("mobile-menu-opend");		
	}
	jQuery(document).ready(function() {
		jQuery("#mesagepopbox").on("click",".closealert", function(){
			jQuery("#mesagepopbox").hide(); 
		  	jQuery("#mesagepopbox #mesagecontent").html('');
			jQuery("#mesagepopbox").removeClass("alert");
			jQuery('body').removeClass("mobile-menu-opend");		
		});
		jQuery('.mesage-pop-bg').click(function(){
			jQuery("#mesagepopbox").hide(); 
		  	jQuery("#mesagepopbox #mesagecontent").html('');
			jQuery("#mesagepopbox").removeClass("alert");
			jQuery('body').removeClass("mobile-menu-opend");		
		});
	});
</script><br />
<div class="img_about" style="margin-top: 10px;">
	<?php echo $content['Content']['map_iframe'];?>
	<?php /*<iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d27513.56686643945!2d31.1884216!3d30.4588901!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sar!2seg!4v1397339395281" width="1200" height="400" frameborder="0" style="border:0"></iframe>*/?>
</div>
<div class="bottom_grop_top">	
	<div class="img_top"><?php echo $content['Content']['inner_title'];?></div>
	<div class="left_bot_2"><?php echo $content['Content']['body'];?></div>
	<?php echo $this->Javascript->link('front/ajax/contactus');?>
	<script type="text/javascript">
	    $(document).ready(function(){
	        $("#send_form_contact").click(function(){
	        	var error = '';	
				if($("#nameinput").val().length === 0){
					error = error + 'You must enter your Name.<br />';
					$("#nameinput").addClass("required");
				}else{
					$("#nameinput").removeClass("required");
				}		
				if(!isValidEmailAddress($("#emailinput").val())) {
					error = error + 'You must enter valid Email.<br />';
					$("#emailinput").addClass("required");
				}
				else{
					$("#emailinput").removeClass("required");
				}
				if($("#messageinput").val().length === 0){
					error = error + 'You must enter your Message.<br />';
					$("#messageinput").addClass("required");
				}	
				else{
					$("#messageinput").removeClass("required");
				}
	        	if(error.length !== 0){			        		
	        		//$('#contactus_Result2').html(error);
	        		//$('#contactus_Result2').show();
	        	}else{	
					sendFormContact('<?php echo $base_url;?>');		          
				}
	        });             
	    });	    
	</script>
	<?php echo $this->Form->create('Contactus', array('type' =>'file','id'=>'ContactusForm',  'class'=>'','url'=>$base_url.'/texts/contactusForm/notajax'));?>
	<div class="g__sm">
		<div class="w_g_m">Name:<span class="requiredspan">*</span></div>
		<div class="input_2">
			<input id="nameinput" name="data[Contactus][name]" class="input_s_2" type="text" placeholder="Please Enter your Name" />
		</div>
	</div>
	<div class="g__sm">
		<div class="w_g_m">Email:<span class="requiredspan">*</span></div>
		<div class="input_2">
			<input id="emailinput" name="data[Contactus][email]" class="input_s_2" type="text" placeholder="Please Enter your Email" />
		</div>
	</div>
	<div class="g__sm">
		<div class="w_g_m">Message:<span class="requiredspan">*</span></div>
		<div class="input_2">
			<textarea id="messageinput" name="data[Contactus][message]" class="in_ut_s_2" placeholder="Please Enter your Message" ></textarea> 	
		</div>
	</div>
	<a style="cursor: pointer;">
		<div id="send_form_contact" class="no_See_2">Send Message</div>
	</a>
	<?php echo $this->Form->end();?>
	<div class="ajax_result_contactus">        
		<div id="contactus_ajaxLoading"></div>
        <div id="contactus_Result2"></div>
    </div>
    <style type="text/css">
	#contactus_ajaxLoading{
		display:none;	
		width: 80px;
		height:15px;
		background-image: url(<?php echo $base_url.'/img/front/tloading.gif'?>);
		background-repeat: no-repeat;
	}
	#contactus_Result2{
		font-family:OpenSans-Regular;
		font-size:14px;
		font-weight:100;
		color:#FF0000;
		width: 100%
	}
	#contactus_Result{
		font-family:OpenSans-Regular;
		color:#000000
		font-size:13px;
		font-weight: bold;
		width: 100%
	}
	.ajax_result_contactus{
		margin-top: 5px;
		width: 100%;
		float:left;
	}			
	</style>
</div>
<div class="bottom_grop_2">
	<div class="img_top_2">Contacts</div>
	<?php if($content['Content']['address'] != ''){?>
		<div class="ri_3">
			<div class="ri_2">
				<a>
					<img src="<?php echo $base_url.'/img/front/';?>home.png"/>
				</a>
			</div><?php echo $content['Content']['address'];?>
		</div>
	<?php }?>
	<?php if($content['Content']['phone'] != ''){?>
		<div class="ri_3">
			<div class="ri_2">
				<a>
					<img src="<?php echo $base_url.'/img/front/';?>tele.png"/>
				</a>
			</div><?php echo $content['Content']['phone'];?>
		</div>
	<?php }?>
	<?php if($content['Content']['mail'] != ''){?>
		<div class="ri_3">
			<div class="ri_2">
				<a href="mailto:<?php echo $content['Content']['mail'];?>">
					<img src="<?php echo $base_url.'/img/front/';?>mail.png"/>
				</a>
			</div>
			<a href="mailto:<?php echo $content['Content']['mail'];?>"><?php echo $content['Content']['mail'];?></a>		
		</div>
	<?php }?>
	<?php if($content['Content']['facebook_link'] != ''){?>
		<div class="ri_3">
			<div class="ri_2">
				<a href="<?php echo $content['Content']['facebook_link'];?>">
					<img width="22" src="<?php echo $base_url.'/img/front/';?>face.png"/>
				</a>
			</div>
			<a target="_blank" href="<?php echo $content['Content']['facebook_link'];?>">
				<?php $replace = '';$search1 = 'https://www.facebook.com';
				$search2 = 'http://www.facebook.com';
				$search3 = 'https://facebook.com';
				$search4 = 'http://facebook.com';
				$facebook = $content['Content']['facebook_link'];
				$facebook = str_replace($search1, $replace, $facebook);
				$facebook = str_replace($search2, $replace, $facebook);
				$facebook = str_replace($search3, $replace, $facebook);
				$facebook = str_replace($search4, $replace, $facebook);
				echo $facebook;?>
			</a>
		</div>
	<?php }?>
	<?php if($content['Content']['linkedin_link'] != ''){?>
		<div class="ri_3">
			<div class="ri_2">
				<a href="<?php echo $content['Content']['linkedin_link'];?>">
					<img src="<?php echo $base_url.'/img/front/linkedin_contact.png';?>" width="22" />
				</a>
			</div>
			<a target="_blank" href="<?php echo $content['Content']['linkedin_link'];?>">
				<?php $replace = '';$search1 = 'https://www.linkedin.com';
				$search2 = 'http://www.linkedin.com';
				$search3 = 'https://linkedin.com';
				$search4 = 'http://linkedin.com';
				$linkedin = $content['Content']['linkedin_link'];
				$linkedin = str_replace($search1, $replace, $linkedin);
				$linkedin = str_replace($search2, $replace, $linkedin);
				$linkedin = str_replace($search3, $replace, $linkedin);
				$linkedin = str_replace($search4, $replace, $linkedin);
				echo $linkedin;?>
			</a>
		</div>
	<?php }?>
	<?php /* if($content['Content']['working_hours'] != ''){?>
		<div class="img_top_2" style="margin-bottom: 15px;">Working Hours</div>
		<div class="ri_3">
			<?php echo $content['Content']['working_hours'];?>
		</div>
	<?php } */?>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$(".img_about iframe").css('width','1200');
	$(".img_about iframe").css('height','400');
	$(".img_about iframe").css('border','0');
});
</script>