<?php if(isset($slideshows)){?>
	<?php if(!empty($slideshows)){?>
		<div class="home_slider_wapper">
			<ul class="bxslider">
				<?php foreach ($slideshows as $key => $slideshow) {
					if(trim($slideshow['Slideshow']['image']) != ''){
						$href = '';
						if($slideshow['Slideshow']['link'] != ''){
							$href = 'href="'.$slideshow['Slideshow']['link'].'"';
						}
						if($slideshow['Slideshow']['target'] == 1){
							$href .= ' target="_blank"';
						}?>
						<li>
							<a <?php echo $href;?>>
								<img src="<?php echo $base_url.'/img/upload/'.$slideshow['Slideshow']['image'];?>" alt="" title=""  />
							</a>
						</li>
					<?php }?>
				<?php }?>
			</ul>
		</div>
		<script type="text/javascript">
		jQuery('.bxslider').bxSlider({
			adaptiveHeight: true,
		  	mode: 'horizontal',
		  	auto: true,
		  	autoControls: true,
		});
		</script>
		<style type="text/css">
		.bx-controls{
			display: none;
		}
		.container {
		    margin-top: 75px !important;
		}
		</style>
	<?php }?>
<?php }?>