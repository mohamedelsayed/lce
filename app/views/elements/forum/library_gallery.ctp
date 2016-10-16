<?php if(!empty($library['Gal'])){?>
	<div class="home_slider_wapper">
		<ul class="bxslider">
            <?php foreach ($library['Gal'] as $key => $value) {
                $image = $value['url'];?>
                <li>
                	<?php echo $this->element('forum/embed_google_image', array('file' => $image));?>
                </li>
            <?php }?>
        </ul>
        <div id="bx-pager">
        	<?php $i = 0;
        	foreach ($library['Gal'] as $key => $value) {
                $image = $value['url'];?>
                <a data-slide-index="<?php echo $i++;?>" style="cursor: pointer;">
                	<?php echo $this->element('forum/embed_google_image', array('file' => $image));?>
            	</a>
        	<?php }?>
		</div>
    </div>      
<?php }?>      
<script type="text/javascript">
jQuery('.bxslider').bxSlider({
	adaptiveHeight: true,
  	mode: 'horizontal',
  	auto: true,
  	autoControls: true,
  	pagerCustom: '#bx-pager',
});
</script>
<style type="text/css">
.bx-controls{
	display: none;
}
</style>