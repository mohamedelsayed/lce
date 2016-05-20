<div id="comments_div">
	<?php echo $this->Javascript->link('front/ajax/comments', false); ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#add_comment").click(function(){
                addComment('<?php echo $base_url;?>');
            });
        });
    </script>
    <div class="comments_form">
    <?php echo $this->Form->create('Comment');?>
        <fieldset>
            <legend><?php __('Add Comment'); ?></legend>
        	<?php
            echo $this->Form->input('name');
            //echo $this->Form->input('email');
            //echo $this->Form->input('title');
            echo $this->Form->input('body', array('label'=>'Comment'));
			echo $this->Form->input('article_id', array('type'=>'hidden', 'value'=>$article['Article']['id']));
        	?>
            <div id="add_comment">Add Comment</div>
            <div id="ajaxLoading"></div>
            <div id="commnetResult"></div>
        </fieldset>
    </div>
    <?php if(!empty($comments)){?>
	    <div class="count">
			<?php echo $this->Paginator->counter(array(
				'format' => __('%count% Comment(s)', true)
			));?>
	    </div>
		<?php foreach($comments as $comment){?>
	    <div class="comment">
	        <div class="com_logo"><img src="<?php echo $base_url.'/img/front/';?>comment_icon.png" width="50" /></div>
	        <?php /*<div class="com_title"><?php echo strip_tags($comment['Comment']['title']);?></div>*/?>
	        <div class="com_name"><?php echo 'By: '.strip_tags($comment['Comment']['name']);?></div>
	        <div class="com_date"><?php echo date('F d, Y, g:i a', strtotime($comment['Comment']['created']));?></div>
	        <div class="com_body"><?php echo strip_tags($comment['Comment']['body']);?></div>
	    </div>
	    <div id="space"><img src="<?php echo $base_url.'/app/webroot/img/front/';?>line.png" width="407" height="1" /></div>                    
	    <?php }?>
	    <?php echo $this->element('front/paging_view');?>
	<?php }?>
</div>