<?php if(isset($points_data) && !empty($points_data)){?>
    <?php //$x = 0;
    foreach ($points_data as $key => $point) {
        $image = '';
		$max_width = '';
		$max_height = '';
        //$max_width  = 'max-width:100%;';
        //$max_height  = 'max-height:80%;';
        //$x++;
        //$height = '162px';
        //if($x == 3){
            //$height = '127px';
        //}
        if(isset($point['Point'])){
            $image = $base_url.'/img/upload/'.$point['Point']['image'];
        }?>
        <div class="points_wrap_div">
        	<div class="vision_and_mission_left">
	            <div class="points_image" style="overflow: hidden;">
	                <a>
	                    <img style="<?php echo $max_width.$max_height;?>" src="<?php echo $image;?>"/>
	                </a>
	            </div>
            </div>
            <div class="vision_and_mission_right">
	            <div class="points_title">
	                <?php echo $point['Point']['title'];?>
	            </div>
	            <div class="points_body">
	                <?php $body = $point['Point']['body'];
	                //$body = $this->element('front'.DS.'remove_unneeded_tags_from_string', array('string' => $body));
	                $body = $this->element('front'.DS.'string_format_view', array('str' => $body, 'val' => 100, 'type' => 'wordsCut'));
	                echo $body;?>
	            </div>
            </div>
        </div>
    <?php }?>
<?php }?>    