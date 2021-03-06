<?php global $base_url;
$base_url = BASE_URL;?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml">
	<head>
		<!--
		 * @author Author "Mohamed Elsayed"  
		 * @author Author Email "me@mohamedelsayed.net"
		 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
		-->
		<?php echo $this->Html->charset();?>
		<title>
			<?php if($this->name!='Home') echo $title_for_layout.' | '; 
			echo $this->Session->read('Setting.title'); ?>
		</title>
		<!--Share default image and description-->
		<meta property="og:image" content="<?php echo (isset($shareImage))?$base_url.'/img/upload/'.$shareImage:$base_url.'/img/front/logo.png';?>"/>
		<meta property="og:description" content="<?php echo (isset($metaDescription))?$metaDescription:$this->Session->read('Setting.meta_description');?>"/>
		<!--Meta sent by web admin -->
		<meta name="abstract" content="<?php echo (isset($metaKeywords))?$metaKeywords:$this->Session->read('Setting.meta_keywords');?>" />
		<META HTTP-EQUIV="CONTENT-LANGUAGE" CONTENT="en" />
		<META NAME="revisit-after" CONTENT="7 days" />
		<META NAME="robots" CONTENT="all" />
		<meta name="rating" content="General" />
		<meta name="distribution" content="Global" />
		<meta name="MSSmartTagsPreventParsing" content="true" />
		<meta name="Expires" content="-1" />
		<meta name="reply-to" content="<?php echo $this->Session->read('Setting.email');?>" />
		<meta name="classification" content="Business" />
		<meta name="Copyright" content="Bloom" />
		<meta name="Author" content="" />
		<meta http-equiv="Cache-Control" content="Public" />
		<meta http-equiv="Pragma" content="No-Cache" />
		<script type="text/javascript">
		var base_url = '<?php echo $base_url;?>';
		</script>
		<?php
		//META
		echo $this->Html->meta('icon', $base_url.'/app/webroot/img/front/favicon.png' );
		echo $this->Html->meta('keywords', isset($metaKeywords)?$metaKeywords:$this->Session->read('Setting.meta_keywords'));
		echo $this->Html->meta('description', isset($metaDescription)?$metaDescription:$this->Session->read('Setting.meta_description'));	
		//CSS
		echo $this->Html->css(array('old_front/style','old_front/style_slider','old_front/skin', 'old_front/new_style', 'front/jMenu.jquery', 'front/style', 'front/new_style','front/styles_1.css', 'forum/jquery.bxslider.css', 'forum/AddCalEvent' , 'forum/style'));
		//SCRIPTS
		echo $this->Html->scriptBlock("var siteUrl ='".$base_url."';");//Define global var siteUrl
		//echo $this->Javascript->link('libs/jquery');
		echo $this->Javascript->link(array('front/jquery', 'front/jMenu.jquery', 'front/jquery.jcarousel', 'forum/jqColorPicker.min', 'forum/jquery.marquee.min', 'forum/jquery.bxslider.min', 'forum/AddCalEventZones', 'forum/AddCalEvent'));		
		echo $this->Javascript->link('/ckeditor/ckeditor');
		echo $this->Javascript->link('forum/jquery.simple-color');
		echo $this->Javascript->link('forum/dev.js');?>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<?php if($this->params['controller'] != 'images'){?>
			<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<?php }?>
		<?php echo $scripts_for_layout;?>
		<script type="text/javascript">		
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', '<?php echo $this->Session->read('Setting.google_analytics_propertyid');?>']);
		  _gaq.push(['_trackPageview']);		
		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();		
		</script>	
		<script type="text/javascript">
		$(document).ready(function(){
			$('ul.tabs li').click(function(){
				var tab_id = $(this).attr('data-tab');
				$('ul.tabs li').removeClass('current');
				$('.tab-content').removeClass('current');
				$(this).addClass('current');
				$("#"+tab_id).addClass('current');
			});
		});
		</script>	
		<?php $member_id = 0;
		if(isset($userInfoFront['id'])){
			$member_id = $userInfoFront['id'];
		}?>
		<script type="text/javascript">
			var siteUrl ='<?php echo $base_url;?>';
			var imgPath = '<?php echo 'img'.DS.'upload'.DS;?>';
			var filesPath = '<?php echo 'files'.DS.'upload'.DS;?>';
			var flv_player_src = siteUrl+'/app/webroot/files/flv_player/player.swf';
			var flv_player_skinPath = siteUrl+'/app/webroot/files/flv_player/skins/fs40/fs40.xml';
			var flv_player_imagePath = siteUrl+'/app/webroot/img/backend/no_image.jpeg';
			var member_id = <?php echo $member_id;?>;
			var common_agree_disagree_click_flag = 0;
			var common_block_unblock_click_flag = 0;
			var inactiveagreedisagreebuttonclass = '<?php echo $inactiveagreedisagreebutton;?>';
		</script>
		<?php echo $this->Javascript->link('forum/ajax/agreements');?>
		<?php echo $this->Javascript->link('forum/ajax/block_member');?>
	</head>
	<body>
		<div class="container_big">
			<?php include_once('header.ctp');?>
			<div class="container">
			<div class="flashSession"><?php echo $this->Session->flash();?>	</div>				
				<?php echo $content_for_layout; ?>				
			</div>
			<?php include_once('footer.ctp');?>  
		</div>
        <?php //echo '<div style="float:left; width:100%;"><div style="margin-left: auto;margin-right: auto;width:945px;">'.$this->element('sql_dump').'</div></div>';?>		
	</body>
</html>