<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.lifecoachingegypt.com
 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */
if(isset($item_id) && isset($item_type)){?>
	<div class="agree_disagree_wrapper">
		<?php $member_id = 0;
		if(isset($userInfoFront['id'])){
			$member_id = $userInfoFront['id'];
		}
		$item_type_text = $agreements_items_types[$item_type];
		$identifiertype = $item_type_text.$item_id;
		if($member_id != 0){
			$is_agree_disagree = $this->requestAction('agreements/is_agree_disagree/'.$item_id.'/'.$item_type.'/'.$member_id);
			$count_agree_disagree = $this->requestAction('agreements/count_agree_disagree/'.$item_id.'/'.$item_type);
			$count_agree = $count_agree_disagree['count_agree'];
			$count_disagree = $count_agree_disagree['count_disagree'];
			$inactiveagreebuttonclass = '';
			$inactivedisagreebuttonclass = '';
			if($is_agree_disagree == 1){
				$inactiveagreebuttonclass = $inactiveagreedisagreebutton;				
			}if($is_agree_disagree == 0){
				$inactivedisagreebuttonclass = $inactiveagreedisagreebutton;				
			}?>
			<div id="add_agreements_result<?php echo $identifiertype;?>" class="add_agreements_result"></div>
			<div class="agreedisagreebutton_wrapper">
				<div class="agreedisagreebutton_in">
					<a id="agreebutton<?php echo $identifiertype;?>" class="agreedisagreebutton agreedisagreehover agreebutton <?php echo $inactiveagreebuttonclass;?>" agreeflag="1" itemid="<?php echo $item_id;?>" itemtype="<?php echo $item_type;?>" identifiertype="<?php echo $identifiertype;?>" >Agree</a>
					<a id="disagreebutton<?php echo $identifiertype;?>" class="agreedisagreebutton agreedisagreehover disagreebutton <?php echo $inactivedisagreebuttonclass;?>" agreeflag="0" itemid="<?php echo $item_id;?>" itemtype="<?php echo $item_type;?>" identifiertype="<?php echo $identifiertype;?>">Disagree</a>	
				</div>
				<div class="count_agree_disagree">
					<div class="agreedisagreehover agreedisagreehoverin" agreeflag="1" itemid="<?php echo $item_id;?>" itemtype="<?php echo $item_type;?>" identifiertype="<?php echo $identifiertype;?>" >
						<span id="count_agree_number<?php echo $identifiertype;?>"><?php echo $count_agree;?></span> Agree, </div>
					<div class="agreedisagreehover agreedisagreehoverin" agreeflag="0" itemid="<?php echo $item_id;?>" itemtype="<?php echo $item_type;?>" identifiertype="<?php echo $identifiertype;?>" >
						<span id="count_disagree_number<?php echo $identifiertype;?>"><?php echo $count_disagree;?></span> Disagree</div>
				</div>
			</div>	
			<div id="add_agreements_status<?php echo $identifiertype;?>" class="add_agreements_status"></div>
		<?php }?>
	</div>
<?php }?>