<?php $tree = array(array('url' => '/all-coaches', 'str' => 'FIND A COACH'));
echo $this->element('front'.DS.'breadcrumb', array('tree' => $tree));
$order_fields = array('name', 'gender', 'created');
$order_directions = array('ASC', 'DESC');
$order_field = $order_fields[array_rand($order_fields)];
$order_direction = $order_directions[array_rand($order_directions)];
global $base_url;?>
<div class="title_coach_page">
	<p>FIND A COACH</p>
</div>
<form id="search_coach_form" accept-charset="utf-8" action="" method="post" enctype="multipart/form-data">
	<div class="coach_search_group">
		<div class="coach_search">Search</div>
		<div class="input_coach_search">
			<input class="input_search" type="text" name="coach_name" id="coach_name">
		</div>
	</div>
	<div class="coach_select_left">
		<div class="coach_search">Coaching Area</div>
		<div class="coach_select_select coach_select">
			<select name="coach_specialization" id="coach_specialization">
				<option value="0">Please Select</option>
				<?php if(!empty($specializations)){
					foreach ($specializations as $key => $value) {?>
						<option value="<?php echo $key;?>"><?php echo $value;?></option>
					<?php }?>
				<?php }?>
			</select>
		</div>
	</div>
	<div class="coach_select_right">
		<div class="coach_search">Geography</div>
		<div class="coach_select_select coach_select">
			<select name="coach_geography" id="coach_geography">
				<option value="0">Please Select</option>
				<?php if(!empty($geographys)){
					foreach ($geographys as $key => $value) {?>
						<option value="<?php echo $key;?>"><?php echo $value;?></option>
					<?php }?>
				<?php }?>
			</select>
		</div>
	</div>
</form>
<div class="coach_posts_group" id="list_coaches">
	<?php /*<div class="post_coach_left">
		<a href="#">
			<img alt="<?php echo $this->Session->read('Setting.title');?>" src="<?php echo $base_url.'/img/front/';?>pic_coach.png" />
		</a>
		<div class="post_coach_title">Mona Adel<samp>BS Psychology </samp></div>
		<div class="post_coach_phone">Zamalek, Heliopolis and Maadi<samp>Remote Coaching</samp></div>
		<div class="post_coach_prograf">“Lorem Ipsum is simply dummy text of the printing and typesetting industry.” </div>
		<div class="post_coach_profile"><a href="#">View Profile</a><samp><a href="#">Recommend this caoch</a></samp></div>
		<div class="post_coach_sumit"><a href="#">Contact me</a></div>
	</div>
<div class="post_coach_right">
<a href="#"><img alt="<?php echo $this->Session->read('Setting.title');?>" src="<?php echo $base_url.'/img/front/';?>pic_coach.png" /></a>
<div class="post_coach_title">Mona Adel<samp>BS Psychology </samp></div>
<div class="post_coach_phone">Zamalek, Heliopolis and Maadi<samp>Remote Coaching</samp></div>
<div class="post_coach_prograf">“Lorem Ipsum is simply dummy text of the printing and typesetting industry.” </div>
<div class="post_coach_profile"><a href="#">View Profile</a><samp><a href="#">Recommend this caoch</a></samp></div>
<div class="post_coach_sumit"><a href="#">Contact me</a></div>
</div>
<div class="post_coach_conter"></div>
<div class="post_coach_left">
<a href="#"><img alt="<?php echo $this->Session->read('Setting.title');?>" src="<?php echo $base_url.'/img/front/';?>pic_coach.png" /></a>
<div class="post_coach_title">Mona Adel<samp>BS Psychology </samp></div>
<div class="post_coach_phone">Zamalek, Heliopolis and Maadi<samp>Remote Coaching</samp></div>
<div class="post_coach_prograf">“Lorem Ipsum is simply dummy text of the printing and typesetting industry.” </div>
<div class="post_coach_profile"><a href="#">View Profile</a><samp><a href="#">Recommend this caoch</a></samp></div>
<div class="post_coach_sumit"><a href="#">Contact me</a></div>
</div>
<div class="post_coach_right">
<a href="#"><img alt="<?php echo $this->Session->read('Setting.title');?>" src="<?php echo $base_url.'/img/front/';?>pic_coach.png" /></a>
<div class="post_coach_title">Mona Adel<samp>BS Psychology </samp></div>
<div class="post_coach_phone">Zamalek, Heliopolis and Maadi<samp>Remote Coaching</samp></div>
<div class="post_coach_prograf">“Lorem Ipsum is simply dummy text of the printing and typesetting industry.” </div>
<div class="post_coach_profile"><a href="#">View Profile</a><samp><a href="#">Recommend this caoch</a></samp></div>
<div class="post_coach_sumit"><a href="#">Contact me</a></div>
</div>
<div class="post_coach_conter"></div>
<div class="post_coach_left">
<a href="#"><img alt="<?php echo $this->Session->read('Setting.title');?>" src="<?php echo $base_url.'/img/front/';?>pic_coach.png" /></a>
<div class="post_coach_title">Mona Adel<samp>BS Psychology </samp></div>
<div class="post_coach_phone">Zamalek, Heliopolis and Maadi<samp>Remote Coaching</samp></div>
<div class="post_coach_prograf">“Lorem Ipsum is simply dummy text of the printing and typesetting industry.” </div>
<div class="post_coach_profile"><a href="#">View Profile</a><samp><a href="#">Recommend this caoch</a></samp></div>
<div class="post_coach_sumit"><a href="#">Contact me</a></div>
</div>
<div class="post_coach_right">
<a href="#"><img alt="<?php echo $this->Session->read('Setting.title');?>" src="<?php echo $base_url.'/img/front/';?>pic_coach.png" /></a>
<div class="post_coach_title">Mona Adel<samp>BS Psychology </samp></div>
<div class="post_coach_phone">Zamalek, Heliopolis and Maadi<samp>Remote Coaching</samp></div>
<div class="post_coach_prograf">“Lorem Ipsum is simply dummy text of the printing and typesetting industry.” </div>
<div class="post_coach_profile"><a href="#">View Profile</a><samp><a href="#">Recommend this caoch</a></samp></div>
<div class="post_coach_sumit"><a href="#">Contact me</a></div>
</div>
<div class="post_coach_conter"></div>*/?>
</div>
<div id="list_coaches_loadmore_button" class="load-more" order_field="<?php echo $order_field;?>" order_direction="<?php echo $order_direction;?>"></div>
<script type="text/javascript">
ajax_list_coaches(0);
jQuery(document).ready(function() {
	jQuery('body').on('mousewheel', function(e){
		start_ajax_list_coaches();
	});		
	jQuery(window).on('scroll', function() {
		start_ajax_list_coaches();
	});	
});
</script>