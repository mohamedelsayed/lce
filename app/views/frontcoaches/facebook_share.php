<?php $http_host = $_SERVER['HTTP_HOST'];
$appId = '1425994984092923';
if (strpos($http_host, '.mohamedelsayed.net') !== FALSE) {
	//$appId = '1425994984092923';
	$appId = '1425986790760409';
}elseif (strpos($http_host, 'lifecoachingegypt.com') !== FALSE) {
	$appId = '1425986790760409';
}?>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '<?php echo $appId;?>',
      xfbml      : true,
      version    : 'v2.6'
    });
  };
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery("body").on("click", ".shareBtn", function(){
		var data_url = jQuery(this).attr('data-url');
		FB.ui({
			method: 'share',
			display: 'popup',
			href: data_url,
		}, function(response){});
	});
});
</script>