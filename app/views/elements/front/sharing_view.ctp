<?php 
$onClick = '';
$class = '';
$type = isset($type)?$type:'default';
$size = isset($size)?$size:'small';
if($size == 'large')
	$class = 'addthis_32x32_style';
if(isset($articleId)){
	echo $this->Javascript->link('front/ajax/sharing', false); 
	$onClick = "updateShared('".$articleId."', '".$base_url."')";
}
?>
<div id="sharingDiv" onclick="<?php echo $onClick;?>">
    <!-- AddThis Button BEGIN -->
    <div class="addthis_toolbox addthis_default_style <?php echo $class;?>"> <!-- For large icons add this class addthis_32x32_style-->
    <?php if($type == 'default'){?>
        <a class="addthis_button_facebook"></a>
        <a class="addthis_button_twitter"></a>
        <a class="addthis_button_google"></a>
        <a class="addthis_button_email"></a>
        <a class="addthis_button_compact"></a>
        <!--<a id="sharedCount" class="addthis_counter addthis_bubble_style"></a>-->
    <?php }elseif($type == 'like'){?>
        <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
        <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
        <!--<a class="addthis_button_tweet"></a>-->
       <!-- <a class="addthis_counter addthis_pill_style"></a>--> 
    <?php }elseif($type == 'header'){?>
        <a class="addthis_button_facebook">
        	<img src="<?php echo $base_url.'/img/front/Bloom-Website-Home_13.jpg';?>" width="28" height="28" title="Facebook"/>
    	</a>
        <a class="addthis_button_twitter">
        	<img src="<?php echo $base_url.'/img/front/Bloom-Website-Home_15.jpg';?>" width="28" height="28" title="twitter"/>
        </a>
        <a class="addthis_button_google">
        	<img src="<?php echo $base_url.'/img/front/Bloom-Website-Home_17.jpg';?>" width="28" height="28" title="google+"/>
        </a>
        <a class="addthis_button_linkedin">
        	<img src="<?php echo $base_url.'/img/front/Bloom-Website-Home_19.jpg';?>" width="28" height="28" title="linkedin"/>
        </a>
    <?php }elseif($type == 'product'){?>
        <a class="addthis_button_facebook">
        	<img src="<?php echo $base_url.'/img/front/ProductF.jpg';?>" width="22" height="22" title="Facebook"/>
    	</a>
        <a class="addthis_button_twitter">
        	<img src="<?php echo $base_url.'/img/front/ProductT.jpg';?>" width="22" height="22" title="twitter"/>
        </a>
        <a class="addthis_button_google">
        	<img src="<?php echo $base_url.'/img/front/ProductG.jpg';?>" width="22" height="22" title="google+"/>
        </a>
        <a class="addthis_button_email">
        	<img src="<?php echo $base_url.'/img/front/ProductM.jpg';?>" width="22" height="22" title="Mail"/>
        </a>
    <?php }?>    
    </div>
	<script type="text/javascript">var addthis_config = {data_ga_property: 'UA-26708176-1', data_ga_social : true};</script>
    <script type="text/javascript">var addthis_config = {data_track_clickback:true};</script>
    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4ef2f8b523f36440"></script>
</div>