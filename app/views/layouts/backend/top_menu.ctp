<div id="menu" style="height: 24px;">
	<?php if(($this->action != 'login') && ($this->action != 'forgot')){?>
		<div id="dropdown-holder">
			<ul id="nav" class="dropdown">
		        <li class="heading"><a href="<?php echo $base_url.'/users';?>">Users</a></li>
		        <li class="heading"><a href="<?php echo $base_url.'/cats';?>">Categories</a></li>
		        <li class="heading"><a href="<?php echo $base_url.'/nodes';?>">Nodes</a></li>
		        <li class="heading"><a href="<?php echo $base_url.'/faqs';?>">FAQs</a></li>
		        <li class="heading"><a>Blog</a>
    				<ul>
    					<li class=""><a href="<?php echo $base_url.'/articles';?>">Articles</a></li>
		        		<?php /*<li class=""><a href="<?php echo $base_url.'/comments';?>">Comments</a></li>*/?>
	        		</ul>
        		</li>
		        <li class="heading"><a href="<?php echo $base_url.'/quotes';?>">Quotes</a></li>
		        <li class="heading"><a href="<?php echo $base_url.'/slideshows';?>">Slideshows</a></li>
		        <?php /*<li class="heading"><a href="<?php echo $base_url.'/logos';?>">Logos</a></li>*/?>
		        <li class="heading"><a href="<?php echo $base_url.'/team_members';?>">Members</a></li>
		        <li class="heading"><a href="<?php echo $base_url.'/testimonials';?>">Testimonials</a></li>
        		<?php $contents = $this->requestAction('main/getContents');
        		foreach ($contents as $content){?>
        			<li class="heading">
        				<a href="<?php echo $base_url.'/contents/edit/'.$content['Content']['id'];?>"><?php echo $content['Content']['title'];?></a>
    				</li>
    			<?php }?>
    			<li class="heading"><a>Newsletter System</a>
    				<ul>
		    			<li class=""><a href="<?php echo $base_url.'/subscribers';?>">Subscribers</a></li>
						<li class=""><a href="<?php echo $base_url.'/newsletters';?>">Newsletters</a></li>
						<li class=""><a href="<?php echo $base_url.'/queues';?>">Sending Queue</a></li>
					</ul>
				</li>
				<li class="heading"><a href="<?php echo $base_url.'/values';?>">Values</a></li>				
				<li class="heading new_items_li" ><a>Events</a>
    				<ul>
    					<li class=""><a href="<?php echo $base_url.'/instructors';?>">Instructors</a></li>
		    			<li class=""><a href="<?php echo $base_url.'/nevents';?>">Eevents</a></li>
		    			<li class=""><a href="<?php echo $base_url.'/nevent_orders';?>">Events Checkouts</a></li>							    				
					</ul>
				</li>
				<li class="heading new_items_li"><a>Coaches</a>
    				<ul>
    					<li class=""><a href="<?php echo $base_url.'/specializations';?>">Specializations</a></li>
		    			<li class=""><a href="<?php echo $base_url.'/geographies';?>">Geographies</a></li>						
		    			<li class=""><a href="<?php echo $base_url.'/coaches';?>">Coaches</a></li>						
					</ul>
				</li>
		    </ul>
	    </div>
	<?php }?>
</div>
<style type="text/css">
.dropdown li{
	border-bottom:1px solid #C3C3C3;
}
.new_items_li{
	background-color: #2BBBB6;	
}
.new_items_li a{
	color: #FFFFFF;
}
</style>