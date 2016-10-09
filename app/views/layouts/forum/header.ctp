<?php global $base_url;?>
<div class="header_big">
	<div class="header">
		<div class="logo">
			<a href="<?php echo $base_url.'/forum';?>">
				<img src="<?php echo $base_url.'/img/front/';?>logo_header.png" />
			</a>
		</div>
        <div class="menu_">
        	<ul id="jMenu" class="menu">
        		<li>
        			<a id="home" href="<?php echo $base_url.'/forum';?>" class="fNiv">
        				<?php echo $this->Session->read('Setting.home_string');?>
    				</a>
    			</li>
				<?php $style_width = 'style="width: 200px;"';
				if($GLOBALS['is_loggin']){?>
	            	<?php if($isAdmin == 1){?>
	            		<li>
			            	<a title="Admin" id="adminpages" class="fNiv hassubmenu">Admin</a> 	            
		            		<ul>
		            			<li class="submenu">
		            				<a <?php echo $style_width;?> title="Groups" href="<?php echo $base_url.'/members/admin_all';?>">Contacts</a>
				        		</li>		            					            							        		
				        		<li class="submenu">
		            				<a <?php echo $style_width;?> title="Events" href="<?php echo $base_url.'/events/admin_all';?>">Events</a>
				        		</li>	
				        		<li class="submenu">
		            				<a <?php echo $style_width;?> title="MarketPlace" href="<?php echo $base_url.'/posts/admin_all';?>">MarketPlace</a>
				        		</li>	
				        		<li class="submenu">
		            				<a <?php echo $style_width;?> title="Library" href="<?php echo $base_url.'/libraries/admin_all';?>">Library</a>
				        		</li>	
				        		<li class="submenu">
		            				<a <?php echo $style_width;?> title="Settings" href="<?php echo $base_url.'/forum_settings';?>">Settings</a>
				        		</li>				        		
			        		</ul>
		        		</li> 	            
		            <?php }?>
	            <?php }?>	            
	            <li>
	            	<a title="Calendar" id="calendar" href="<?php echo $base_url.'/calendar';?>" class="fNiv">Calendar</a>           
	            </li>
	            <?php if($GLOBALS['is_loggin']){?>
	        		<li class="">
        				<a id="market_place_page" title="DCC MarketPlace" href="<?php echo $base_url.'/posts/all';?>">DCC MarketPlace</a>
	        		</li>
        		<?php }?>
        		<?php if($GLOBALS['is_loggin']){?>
	        		<li class="">
        				<a id="library_page" title="Library" href="<?php echo $base_url.'/libraries/all';?>">Library</a>
	        		</li>
        		<?php }?>
	            <?php /*if($GLOBALS['is_loggin']){?>
		            <li>
		            	<a title="Contacts" id="contactspages" href="<?php echo $base_url.'/members/all';?>" class="fNiv">Contacts</a>           
		            </li>
	            <?php }*/?>
	            <?php if($GLOBALS['is_loggin']){?>
		            <?php if(!empty($header_groups)){?>
			            <li>
			            	<a title="Groups" id="grouppages" class="fNiv hassubmenu">Groups</a> 	            
		            		<ul>
		            			<?php foreach ($header_groups as $key => $header_group) {
		            				$group_title = $header_group['Group']['title'];
		            				$group_id = $header_group['Group']['id'];?>
			            			<li class="submenu">
			            				<a <?php echo $style_width;?> title="<?php echo $group_title;?>" href="<?php echo $base_url.'/members/group/'.$group_id;?>"><?php echo $group_title;?></a>
					        		</li>
				        		<?php }?>
				        		<li class="submenu">
				        			<?php $admin_group_title = 'Admins';?>
		            				<a <?php echo $style_width;?> title="<?php echo $admin_group_title;?>" href="<?php echo $base_url.'/members/admin/';?>"><?php echo $admin_group_title;?></a>
				        		</li>
			        		</ul>
		        		</li>
	        		<?php }?>
        		<?php }?>        		
	            <?php if($GLOBALS['is_loggin']){?>
		            <li>
		            	<a title="Edit Profile" id="editprofilepages" href="<?php echo $base_url.'/members/edit';?>" class="fNiv">Edit Profile</a>           
		            </li>            
		            <li>
		            	<a title="Logout" id="logout" href="<?php echo $base_url.'/forum/logout';?>" class="fNiv">Logout</a>           
		            </li> 
	            <?php }?> 
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
<style type="text/css">
	li.header_menu_li2 ul li a{
		min-width: 310px;		
	}
</style>
<?php include_once 'popup.php'; ?>