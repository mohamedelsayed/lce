<?php if(isset($posts)){?>
	<?php if(!empty($posts)){?>
		<div class='marquee' >
			<?php $count = count($posts);
			$i = 0;
			foreach ($posts as $key => $post) {
				$post_link = $base_url.'/posts/view/'.$post['Post']['id'];
				$title = '';
				if($post['Post']['title'] != ''){
					$title = $post['Post']['title'];
				}?>
				<a class="marquee_home_item" href="<?php echo $post_link;?>"><?php echo $title;?></a> 
				<?php $i++;
				if($i < $count){?>
					--- 
				<?php }?>
			<?php }?>
		</div>
		<script type="text/javascript">
		jQuery('.marquee').marquee({
			//speed in milliseconds of the marquee
    		duration: 15000,
    		//gap in pixels between the tickers
    		gap: 50,
		    //time in milliseconds before the marquee will start animating
		    delayBeforeStart: 0,
		    //'left' or 'right'
		    direction: 'left',
		    //true or false - should the marquee be duplicated to show an effect of continues flow
		    duplicated: false,
		    pauseOnHover: true
		});
		</script>
	<?php }?>
<?php }?>