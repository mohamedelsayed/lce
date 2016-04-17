<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<!--
		 * @author Author "Mohamed Elsayed"  
		 * @author Author Email "me@mohamedelsayed.net"
		 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
		-->
		<?php echo $this->Html->charset();?>
		<title>
			<?php echo $settings['title'].' - '.$title_for_layout; ?>
		</title>
		<?php
		echo $this->Html->meta('icon', $settings['url'].'/app/webroot/img/backend/favicon.ico' );
		//CSS
		echo $this->Html->css('backend/style');
		echo $this->Html->css('backend/dropdown');
		//SCRIPTS
		echo $this->Html->scriptBlock("var siteUrl ='".$settings['url']."';");//Define global var siteUrl
		if($this->name =='Images'){
			echo $this->Javascript->link('libs/jquery');
		}else{
			echo $this->Javascript->link('backend/jquery-1.10.2');
		}
		echo $this->Javascript->link('backend/jquery-ui.js');
		echo $scripts_for_layout;
		echo $this->Javascript->link('backend/all');
		echo $this->Javascript->link('/ckeditor/ckeditor');?>		
	</head>	
	<body>
		<div id="container">
			<div id="header"></div>				
			<div class="bg_web">
				<div class="content_left">
					<div class="name_title" style="margin-top: -30px;">
						<a href="<?php echo $settings['url'];?>" target="_blank">
							<img src="<?php echo $settings['url']."/img/front/logo.png";?>" width="" height="" />
						</a>				
					</div>		
					<?php if(($this->action != 'login') && ($this->action != 'forgot')){?>
						<div class="title" style="margin-top: 0;">
							<?php echo 'Welcome to '.$this->Session->read('Setting.title').' CMS';?>
							<div class="hellohome">
								<?php echo 'Hello, '. $this->Session->read('userInfo.User.name').': ';
								echo $this->Html->link(
									$this->Html->image('backend/settings2.jpeg', array('title'=> __('Settings', true), 'border' => '0')),
									array('controller' => 'settings/edit'),
									array('escape' => false)
								);
								echo $this->Html->link(
									$this->Html->image('backend/home.jpeg', array('title'=> __('Home', true), 'border' => '0')),
									array('controller' => 'me-admin/index'),
									array('escape' => false)
								);
								echo $this->Html->link(
									$this->Html->image('backend/logout2.jpeg', array('title'=> __('logout', true), 'border' => '0')),
									array('controller' => 'me-admin/logout'),
									array('escape' => false)
								);
								?>
							</div>
						</div>
					<?php }?>										
					<div class="content_data">
						<div id="content">
							<?php include_once 'top_menu.ctp';?>
							<div id="data">
								<div id="datatop">
									<?php echo $this->Html->image('backend/topdatabg.jpg');?>
								</div>
								<div id="datamiddle">
									<div id="datain">
										<div id="leftin">
											<?php echo $this->Session->flash ();?>
											<?php echo $content_for_layout;	?>
										</div>
									</div>
								</div>
							</div>							
						</div>
					</div>
					<div id="bottom">				
						<?php echo $this->Html->image('backend/bottombg.png');?>
					</div>
					<div class="logos_img" style="display: none;">
						<a href="http://www.mohamedelsayed.net/" target="_blank">
							<img src="<?php echo $settings['url']."/img/backend/logos.jpg";?>" width="585" height="277" />
						</a>
					</div>
				</div>
				<div class="content_right" style="margin-left: 646px;width: 354px;">
					<div class="image" style="margin-top: 75px;margin-left: 25px;display: none;">
						<a href="http://www.mohamedelsayed.net/" target="_blank">
							<img src="<?php echo $settings['url']."/img/backend/logo.png";?>" width="354" />
						</a>
					</div>
				</div>
			</div>			
			<div id="footer"></div>			
		</div>
		<?php echo $this->element('sql_dump'); ?>
	</body>
</html>