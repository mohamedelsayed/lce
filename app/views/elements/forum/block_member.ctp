<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.lifecoachingegypt.com
 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */
if(isset($other_member_id)){?>
	<?php $block_unblock_member_button = $this->requestAction('blocked_members/get_block_unblock_member_button/'.$other_member_id.'/0/'.$other_member_fullname);?>		
	<div class="block_member_wrapper block_member_wrapper<?php echo $other_member_id;?>">
		<?php echo $block_unblock_member_button;?>
	</div>	
<?php }?>