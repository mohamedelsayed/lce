<?php $tree = array(array('url' => '/all-coaches', 'str' => 'FIND A COACH'));
echo $this->element('front'.DS.'breadcrumb', array('tree' => $tree));
global $base_url;?>
<div class="title_coach_page">
	<p>FIND A COACH</p>
</div>
<div class="coach_search_group">
	<div class="coach_search">Search</div>
	<div class="input_coach_search">
		<input class="input_search" type="text" >
	</div>
</div>
<div class="coach_select_left">
	<div class="coach_search">Coaching Area</div>
	<div class="coach_select_select coach_select">
		<select>
			<option selected="selected" value="1">Please Select</option>
			<option value="2">1</option>
			<option value="3">2</option>
			<option value="4">3</option>
			<option value="5">4</option>
			<option value="6">5</option>
		</select>
	</div>
</div>
<div class="coach_select_right">
	<div class="coach_search">Geography</div>
	<div class="coach_select_select coach_select">
		<select>
			<option selected="selected" value="1">Please Select</option>
			<option value="2">1</option>
			<option value="3">2</option>
			<option value="4">3</option>
			<option value="5">4</option>
			<option value="6">5</option>
		</select>
	</div>
</div>
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
<div id="list_coaches_loadmore_button" class="load-more" ></div>
<script type="text/javascript">
	ajax_list_coaches(0);
</script>