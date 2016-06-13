<?php if(isset($values_data) && !empty($values_data)){?>
    <?php //$x = 0;
    foreach ($values_data as $key => $value) {
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
        if(isset($value['Value'])){
            $image = $base_url.'/img/upload/'.$value['Value']['image'];
        }?>
        <div class="values_wrap_div">
            <div class="values_image" style="overflow: hidden;">
                <a>
                    <img style="<?php echo $max_width.$max_height;?>" src="<?php echo $image;?>"/>
                </a>
            </div>
            <div class="values_title">
                <?php echo $value['Value']['title'];?>
            </div>
            <div class="values_body">
                <?php $body = $value['Value']['body'];
                //$body = $this->element('front'.DS.'remove_unneeded_tags_from_string', array('string' => $body));
                $body = $this->element('front'.DS.'string_format_view', array('str' => $body, 'val' => 100, 'type' => 'wordsCut'));
                echo $body;?>
            </div>
        </div>
    <?php }?>
<?php }?>    