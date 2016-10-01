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
		            				<a <?php echo $style_width;?> title="Events" href="<?php echo $base_url.'/events/all';?>">Events</a>
				        		</li>	
				        		<li class="submenu">
		            				<a <?php echo $style_width;?> title="MarketPlace" href="<?php echo $base_url.'/posts/admin_all';?>">MarketPlace</a>
				        		</li>	
				        		<li class="submenu">
		            				<a <?php echo $style_width;?> title="Library" href="<?php echo $base_url.'/libraries';?>">Library</a>
				        		</li>	
				        		<li class="submenu">
		            				<a <?php echo $style_width;?> title="Settings" href="<?php echo $base_url.'/forum_settings';?>">Settings</a>
				        		</li>
				        		<?php /*<li class="submenu">
		            				<a <?php echo $style_width;?> title="Groups" id="userslink" href="<?php echo $base_url.'/groups/';?>">Groups</a>
				        		</li>
		            			<li class="submenu">
		            				<a <?php echo $style_width;?> title="Contacts" id="userslink" href="<?php echo $base_url.'/members';?>">Contacts</a>
				        		</li>*/?>			        		
				        		<?php /*<li class="submenu">
		            				<a <?php echo $style_width;?> title="Categories" id="categorieslink" href="<?php echo $base_url.'/categories';?>">Categories</a>
				        		</li>
				        		<li class="submenu">
		            				<a <?php echo $style_width;?> title="Posts" id="postslink" href="<?php echo $base_url.'/posts';?>">Posts</a>
				        		</li>	
				        		<li class="submenu">
		            				<a <?php echo $style_width;?> title="Comments" id="commentslink" href="<?php echo $base_url.'/forum_comments';?>">Comments</a>
				        		</li>	
				        		<li class="submenu">
		            				<a <?php echo $style_width;?> title="Announcements" id="announcementslink" href="<?php echo $base_url.'/announcements';?>">Announcements</a>
				        		</li>	
				        		<li class="submenu">
		            				<a <?php echo $style_width;?> title="Events" id="eventslink" href="<?php echo $base_url.'/events';?>">Events</a>
				        		</li>		        		*/?>
			        		</ul>
		        		</li> 	            
		            <?php }?>
	            <?php }?>
	            <?php if($GLOBALS['is_loggin']){?>
		            <?php /*<li>
		            	<a title="Announcements" id="announcementsall" href="<?php echo $base_url.'/announcements/all';?>" class="fNiv">Announcements</a>           
		            </li>*/?>
		            <?php /*<li>
		            	<a title="Calendar" id="Calendar" href="<?php echo $base_url.'/calendar';?>" class="fNiv">Calendar</a>           
		            </li>*/?>
	            <?php }?>
	            <?php if($GLOBALS['is_loggin']){?>
		            <li>
		            	<a title="Contacts" id="contactspages" href="<?php echo $base_url.'/members/all';?>" class="fNiv">Contacts</a>           
		            </li>
	            <?php }?>
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
			        		</ul>
		        		</li>
	        		<?php }?>
        		<?php }?>
        		<?php if($GLOBALS['is_loggin']){?>
	        		<li class="">
        				<a id="market_place_page" title="MarketPlace" href="<?php echo $base_url.'/posts/all';?>">MarketPlace</a>
	        		</li>
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
<?php /*global $base_url;?>
<div class="header_big">
	<div class="header">
		<div class="logo">
			<a href="<?php echo $base_url.'/forum';?>">
				<img src="<?php echo $base_url.'/img/front/logo.png';?>" />
			</a>
		</div>
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
				<a href="<?php echo $base_url.'/forum';?>" class="fNiv" id="home" ><?php echo $this->Session->read('Setting.home_string');?></a>           
            </li>
            <?php if($GLOBALS['is_loggin']){?>
            	<?php if($isAdmin == 1){?>
            		<li>
		            	<a title="Admin" id="adminlink" class="fNiv">Admin</a> 	            
	            		<ul>
	            			<li class="submenu">
	            				<a <?php echo $style_width;?> title="Users" id="userslink" href="<?php echo $base_url.'/members';?>">Contacts</a>
			        		</li>
			        		<li class="submenu">
	            				<a <?php echo $style_width;?> title="Categories" id="categorieslink" href="<?php echo $base_url.'/categories';?>">Categories</a>
			        		</li>
			        		<li class="submenu">
	            				<a <?php echo $style_width;?> title="Posts" id="postslink" href="<?php echo $base_url.'/posts';?>">Posts</a>
			        		</li>	
			        		<li class="submenu">
	            				<a <?php echo $style_width;?> title="Comments" id="commentslink" href="<?php echo $base_url.'/forum_comments';?>">Comments</a>
			        		</li>	
			        		<li class="submenu">
	            				<a <?php echo $style_width;?> title="Announcements" id="announcementslink" href="<?php echo $base_url.'/announcements';?>">Announcements</a>
			        		</li>	
			        		<li class="submenu">
	            				<a <?php echo $style_width;?> title="Events" id="eventslink" href="<?php echo $base_url.'/events';?>">Events</a>
			        		</li>		        		
		        		</ul>
	        		</li> 	            
	            <?php }?>
	            <li>
	            	<a title="Announcements" id="announcementsall" href="<?php echo $base_url.'/announcements/all';?>" class="fNiv">Announcements</a>           
	            </li>
	            <li>
	            	<a title="Calendar" id="Calendar" href="<?php echo $base_url.'/calendar';?>" class="fNiv">Calendar</a>           
	            </li>
	            <li>
	            	<a title="Contacts" id="Contacts" href="<?php echo $base_url.'/members/all';?>" class="fNiv">Contacts</a>           
	            </li>
	            <li>
	            	<a title="Edit Profile" id="editProfile" href="<?php echo $base_url.'/members/edit';?>" class="fNiv">Edit Profile</a>           
	            </li>            
	            <li>
	            	<a title="Logout" id="logout" href="<?php echo $base_url.'/forum/logout';?>" class="fNiv">Logout</a>           
	            </li> 
            <?php }?>           
        </ul>
    </div>
</div>*/?>
<style type="text/css">
	li.header_menu_li2 ul li a{
		min-width: 310px;		
	}
</style>
<?php include_once 'popup.php'; ?>