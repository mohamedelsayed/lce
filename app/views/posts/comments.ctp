<?php echo $this->Javascript->link('forum/ajax/upload_image', false);
echo $this->Javascript->link('forum/ajax/upload_video', false);
echo $this->Javascript->link('forum/ajax/upload_attachement', false);?>
<div id="comments_div">
	<?php echo $this->Javascript->link('forum/ajax/comments', false); ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#add_comment").click(function(){
                addComment();
            });
        });
    </script>
    <div class="comments_form">
    	<?php echo $this->Form->create('ForumComment');?>
	        <fieldset>
	            <?php /*<legend><?php __('Add Comment'); ?></legend>*/?>
	        	<?php 
	        	echo $this->Form->input('post_id', array('type'=>'hidden', 'value'=>$post['Post']['id']));
				echo $this->Form->input('member_id', array('type'=>'hidden', 'value'=>$userInfoFront['id']));
				echo $this->Form->input('approved', array('type' => 'hidden', 'value' => 1));?>
	        	<div class="commentcontainer">
					<ul class="comment-tabs clearfix">
						<li id="defaultlitab" class="selected"><!--<i class="text-icon"></i>-->Text</li>
						<li><!--<i class="media-icon"></i>-->Media</li>
				       	<li><!--<i class="document-icon"></i>-->Attachment</li>            			
					</ul>
					<div class="comment-tabs-container clearfix">
						<div class="comment-tab-item text-links">
							<?php echo $this->Form->input('comment', array('type' => 'textarea', 'label' => false));?>
						</div>
						<div class="comment-tab-item text-links commentmediatab">				
				        	<div class="input file uploadimageout">
								<input class="hiddeninputbutton" id="uploadimageinput" type="file" name="uploadimageinput" />
								<input id="uploadimagepath" name="data[ForumComment][image]" value="" type="hidden" />
								<button type="button" id="uploadimage" class="uploadimage">Upload Image</button>
								<div id="uploadimagestatus" class="uploadstatus"></div>
							</div>
							<div class="input file uploadvideoout">
								<input class="hiddeninputbutton" id="uploadvideoinput" type="file" name="uploadvideoinput" />
								<input id="uploadvideopath" name="data[ForumComment][video]" value="" type="hidden" />
								<button type="button" id="uploadvideo" class="uploadvideo">Upload Video</button>
								<div id="uploadvideostatus" class="uploadstatus"></div>
							</div>
						</div>
						<div class="comment-tab-item text-links commentattachementtab">
							<div class="input file uploadattachementout">
								<input class="hiddeninputbutton" id="uploadattachementinput" type="file" name="uploadattachementinput" />
								<input id="uploadattachementpath" name="data[ForumComment][attachement]" value="" type="hidden" />
								<button type="button" id="uploadattachement" class="uploadattachement">Upload Attachement</button>
								<div id="uploadattachementstatus" class="uploadstatus"></div>								
							</div>
						</div>
					</div>				
		            <div id="add_comment">Add Comment</div>
		            <div id="ajaxLoading"></div>
		            <div id="commnetResult"></div>
	            </div>
			</fieldset>
		</form>
    </div>
    <ul id="comments-listing" class="comments-listing">
    	<div id="comment_messages"></div>
    </ul>
    <?php if(!empty($comments)){
    	$page_limit = $limit; $page = 1;$post_id = $post['Post']['id'];
    	$page_count = $this->Paginator->counter(array(
			'format' => __('%pages%', true)
		));?>		
    	<div id="loadmorecomment" page="<?php echo $page;?>" limit="<?php echo $page_limit;?>" postid="<?php echo $post_id;?>" class="load-more"></div>
    	<script type="text/javascript">
		jQuery(document).ready(function() {
			 jQuery('#loadmorecomment').click(function(){
			 	var page = $(this).attr("page");
			 	var limit = $(this).attr("limit");
			 	var postid = $(this).attr("postid");
			 	var nextpage = parseInt(page) + 1;
			 	var pagecount = <?php echo $page_count;?>;
			 	var loadmorecommentbutton = $(this);
			 	$.ajax({
			 		type: "POST",
			        url: siteUrl+'/posts/list_comments',
					data: {page:page,limit:limit,postid:postid},
			        beforeSend: function() {
			        	loadmorecommentbutton.addClass("ajaxloading");
			        },
			        success: function(result) {
						loadmorecommentbutton.removeClass("ajaxloading");
						jQuery("#comments-listing").append(result);				
						if(parseInt(nextpage) <= parseInt(pagecount)){
							loadmorecommentbutton.attr("page", nextpage)
						}else{
							loadmorecommentbutton.hide();
						}
					}
			    });
			});
		});
		jQuery(document).ready(function() {
			jQuery("#loadmorecomment").click();
		});	
		</script>
	<?php }?>
	<script type="text/javascript">
	jQuery(function(){
		jQuery(".comment-tabs-container .comment-tab-item:first-child").addClass("active");
		jQuery(".comment-tabs li:first-child").addClass("selected");
		jQuery(".comment-tabs li").click(function(){
			jQuery(this).addClass("selected").siblings().removeClass("selected");
			jQuery('.comment-tabs-container .comment-tab-item').eq(jQuery(this).index()).fadeIn().addClass("active").siblings().fadeOut().removeClass("active");
		});
	});
	</script>
</div>