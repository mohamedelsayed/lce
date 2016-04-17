<div class="index">	
	<?php if(!empty($announcement)){?>
		<div class="home_announcements">
			<h2>Announcement</h2>
			<a href="<?php echo $this->Session->read('Setting.url').'/announcements/view/'.$announcement['Announcement']['id'];?>">
				<div class="home_announcements_title"><?php echo $announcement['Announcement']['title'];?></div>				
			</a>
			<div class="home_announcements_date">Created on: <?php echo date('M d, Y, g:i a', strtotime($announcement['Announcement']['created']));?></div>			
			<div class="home_announcements_body"><?php echo $announcement['Announcement']['body'];?></div>	
		</div>
		
		
	<?php }?>
	<div class="add_action_button"><?php echo $this->Html->link(__('Add Post', true), array('controller' => 'posts','action' => 'add')); ?></div>
	<?php if(!empty($posts)){
    	$page_limit = $limit; $page = 1;
    	$page_count = $this->Paginator->counter(array(
			'format' => __('%pages%', true)
		));?>
		<div class="filterposts_wrapper">
			<form id="filterpostsform" accept-charset="utf-8" method="post" enctype="multipart/form-data">
				<input type="hidden" name="page" value="1" />
				<input type="hidden" name="limit" value="<?php echo $page_limit;?>" />
				<div class="filtertitlediv">
					<input class="filtertitle" id="filtertitle" type="text" name="title" />
				</div>
				<div class="filtercategoryiddiv">
					<select id="filtercategoryid" class="filtercategoryid" name="category_id">
						<option value="0"></option>
						<?php foreach ($categories as $key => $value) {?>
							<option value="<?php echo $key;?>"><?php echo $value;?></option>
						<?php }?>
					</select>
				</div>
				<div class="filterbuttondiv">
					<input type="submit" value="Filter"  class="filterbutton" id="filterbutton" name=""filterbutton>
				</div>
			</form>
		</div>
		<div class="post_head">
			<div class="post_title_head">Post</div>
			<div class="post_category_head">Category</div>
			<div class="post_date_head">Date</div>
			<div class="post_author_head">Author</div>
			<div class="post_last_comment_date_head">Last comment at</div>
		</div>
		<ul id="posts-listing" class="posts-listing"></ul>		
    	<div id="loadmorepost" page="<?php echo $page;?>" limit="<?php echo $page_limit;?>" filtertitle="" filtercategoryid="0" pagecount="<?php echo $page_count;?>" class="load-more"></div>
    	<script type="text/javascript">
		jQuery(document).ready(function() {
			 jQuery('#loadmorepost').click(function(){
			 	var page = $(this).attr("page");
			 	var limit = $(this).attr("limit");
			 	var title = $(this).attr("filtertitle");
			 	var category_id = $(this).attr("filtercategoryid");
			 	var nextpage = parseInt(page) + 1;
			 	var pagecount = $(this).attr("pagecount");
			 	var loadmorepostbutton = $(this);
			 	$.ajax({
			 		type: "POST",
			        url: siteUrl+'/posts/list_posts',
					data: {page:page,limit:limit,category_id:category_id,title:title},
			        beforeSend: function() {
			        	loadmorepostbutton.addClass("ajaxloading");
			        },
			        success: function(result) {
						loadmorepostbutton.removeClass("ajaxloading");
						jQuery("#posts-listing").append(result);				
						if(parseInt(nextpage) <= parseInt(pagecount)){
							loadmorepostbutton.attr("page", nextpage)
						}else{
							loadmorepostbutton.hide();
						}
					}
			    });
			});
		});
		jQuery(document).ready(function() {
			jQuery("#loadmorepost").click();
		});	
		</script>
	<?php }?>
</div>
<script type="text/javascript">
function submitfilterposts(){
	var nextpage = 2;
	var loadmorepostbutton = $('#loadmorepost');
	var filtertitle = $('#filtertitle').val();
	var filtercategoryid = $('#filtercategoryid').val();
	loadmorepostbutton.attr("page", 1);
	loadmorepostbutton.attr("filtertitle", filtertitle);	
	loadmorepostbutton.attr("filtercategoryid", filtercategoryid);	
	$.ajax({
		type: 'POST',
		data: $('#filterpostsform').serialize(),	
		url: siteUrl+'/posts/list_posts',
		beforeSend: function(){
			jQuery("#posts-listing").html('');	
	    	loadmorepostbutton.addClass("ajaxloading");
	    },
	    success: function(result) {
			loadmorepostbutton.removeClass("ajaxloading");			
			jQuery("#posts-listing").html(result);				
			var pagecount = loadmorepostbutton.attr("pagecount");
			if(parseInt(nextpage) <= parseInt(pagecount)){
				loadmorepostbutton.attr("page", nextpage);
				loadmorepostbutton.show();
			}else{
				loadmorepostbutton.hide();
			}
		}
	});	
	return false;  
}
jQuery(document).ready(function(){
	var myform = jQuery('#filterpostsform');
	jQuery(myform).submit(function(event) {
		event.preventDefault();
	});
	jQuery("#filterbutton").click(function(){
		submitfilterposts();
	});			
});
</script>