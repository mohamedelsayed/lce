<div id="menu" style="height: 24px;">
	<?php if(($this->action != 'login') && ($this->action != 'forgot')){?>
		<div id="dropdown-holder">
			<ul id="nav" class="dropdown">
		        <li class="heading"><a href="<?php echo $this->Session->read('Setting.url').'/users';?>">Users</a></li>
		        <li class="heading"><a href="<?php echo $this->Session->read('Setting.url').'/cats';?>">Categories</a></li>
		        <li class="heading"><a href="<?php echo $this->Session->read('Setting.url').'/nodes';?>">Nodes</a></li>
		        <li class="heading"><a href="<?php echo $this->Session->read('Setting.url').'/faqs';?>">FAQs</a></li>
		        <li class="heading"><a>Blog</a>
    				<ul>
    					<li class=""><a href="<?php echo $this->Session->read('Setting.url').'/articles';?>">Articles</a></li>
		        		<?php /*<li class=""><a href="<?php echo $this->Session->read('Setting.url').'/comments';?>">Comments</a></li>*/?>
	        		</ul>
        		</li>
		        <li class="heading"><a href="<?php echo $this->Session->read('Setting.url').'/quotes';?>">Quotes</a></li>
		        <li class="heading"><a href="<?php echo $this->Session->read('Setting.url').'/slideshows';?>">Slideshows</a></li>
		        <?php /*<li class="heading"><a href="<?php echo $this->Session->read('Setting.url').'/logos';?>">Logos</a></li>*/?>
		        <li class="heading"><a href="<?php echo $this->Session->read('Setting.url').'/team_members';?>">Members</a></li>
		        <li class="heading"><a href="<?php echo $this->Session->read('Setting.url').'/testimonials';?>">Testimonials</a></li>
        		<?php $contents = $this->requestAction('main/getContents');
        		foreach ($contents as $content){?>
        			<li class="heading">
        				<a href="<?php echo $this->Session->read('Setting.url').'/contents/edit/'.$content['Content']['id'];?>"><?php echo $content['Content']['title'];?></a>
    				</li>
    			<?php }?>
    			<li class="heading"><a>Newsletter System</a>
    				<ul>
		    			<li class=""><a href="<?php echo $this->Session->read('Setting.url').'/subscribers';?>">Subscribers</a></li>
						<li class=""><a href="<?php echo $this->Session->read('Setting.url').'/newsletters';?>">Newsletters</a></li>
						<li class=""><a href="<?php echo $this->Session->read('Setting.url').'/queues';?>">Sending Queue</a></li>
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
</style>