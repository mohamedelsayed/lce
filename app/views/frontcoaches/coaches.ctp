<?php $tree = array(array('url' => '/all-coaches', 'str' => 'FIND A COACH'));
echo $this->element('front'.DS.'breadcrumb', array('tree' => $tree));
$order_fields = array('name', 'gender', 'created');
$order_directions = array('ASC', 'DESC');
$order_field = $order_fields[array_rand($order_fields)];
$order_direction = $order_directions[array_rand($order_directions)];
global $base_url;
$http_host = $_SERVER['HTTP_HOST'];
$appId = '1425994984092923';
if (strpos($http_host, '.mohamedelsayed.net') !== FALSE) {
	$appId = '1425994984092923';
}elseif (strpos($http_host, 'lifecoachingegypt.com') !== FALSE) {
	$appId = '1425986790760409';
}?>
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
<div class="coach_posts_group" id="list_coaches"></div>
<div id="list_coaches_loadmore_button" class="load-more" order_field="<?php echo $order_field;?>" order_direction="<?php echo $order_direction;?>"></div>
<?php include_once 'facebook_share.php'; ?>