<?php $id = $this->data['Content']['id'];
/*if($this->data['Content']['id'] == 2){?>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript">
	var map;
	var marker=false;
	function initialize() {
		var la = "<?php echo $this->data['Content']['latitude'];?>";
		var lo = "<?php echo $this->data['Content']['longitude'];?>";
		if (la === ""||lo === ""){
			var myLatlng = new google.maps.LatLng(30.04449,31.2356947);
		}else{
			var myLatlng = new google.maps.LatLng(la,lo);	  
 		}
 		var myOptions = {
 			zoom: 14,
 			center: myLatlng,
 			mapTypeId: google.maps.MapTypeId.ROADMAP
		}	
		//var image = 'http://localhost/forsale/app/webroot/img/front/leftarrow.png';
		map = new google.maps.Map(document.getElementById("gmap"), myOptions);
		marker = new google.maps.Marker({
	      	position: myLatlng, 
	      	map: map
	  	});
	  	google.maps.event.addListener(map, 'center_changed', function() {
		  	var location = map.getCenter();
			//document.getElementById("lat").innerHTML = location.lat();
			//document.getElementById("lon").innerHTML = location.lng();
			$("#lat").val(location.lat());
			$("#lon").val(location.lng());
		    placeMarker(location);
	  	});
	  	google.maps.event.addListener(map, 'zoom_changed', function() {
		  	zoomLevel = map.getZoom();
			document.getElementById("zoom_level").innerHTML = zoomLevel;
	  	});
	  	google.maps.event.addListener(marker, 'dblclick', function() {
		    zoomLevel = map.getZoom()+1;
		    if (zoomLevel == 20) {
		     zoomLevel = 10;
		   	}    
			document.getElementById("zoom_level").innerHTML = zoomLevel; 
			map.setZoom(zoomLevel);
		});
		document.getElementById("zoom_level").innerHTML = 14; 
		document.getElementById("lat").value = la;
		document.getElementById("lon").value = lo;
	}	  
	function placeMarker(location) {
		var clickedLocation = new google.maps.LatLng(location);
	  	marker.setPosition(location);
	}
	window.onload = function(){initialize();};	
	</script>
<?php }*/?>
<div class="contents form">
<?php echo $this->Form->create('Content', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php echo  __('Edit Content of '). $this->data['Content']['title']; ?></legend>
	<div id="form">
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		if($id == 1){
			echo $this->Form->input('inner_title');
		}
		echo $this->Form->input('Content.body', array('class'=>'ckeditor'));
		if($id == 1){
			echo $this->Form->input('map_iframe');
			echo $this->Form->input('address');
			echo $this->Form->input('phone');
			echo $this->Form->input('mail');
			echo $this->Form->input('facebook_link');
			echo $this->Form->input('linkedin_link');
			echo $this->Form->input('working_hours', array('class'=>'ckeditor'));
		}
		/*if($this->data['Content']['id'] == 2){
			//echo $this->Form->input('map_iframe');
			echo "Location Map (Google Map details)";?>
			<center>
				<div id="bd">
					<div id="gmap"></div>
					<?php  echo  $this->Form->input('latitude',array('id'=>'lat'));
					echo $this->Form->input('longitude',array('id'=>'lon'));?>
					<div id="zoom_level" style="display:none"></div>
				</div>
			</center>
		<?php }*/?>
	</div>
	<?php /*<div id="tapss">
        <ul class="tabs">
            <li><a class="current" href="#">Images</a></li>
        </ul>
        <div class="panes">
        	<div style="display: block;">
	            <?php
	            echo $this->Form->input('Gal.0.caption', array('value'=>'')); 
				echo $this->Form->input('Gal.0.image', array('type'=>'file','label'=>'Image (945 * 470)'));
				echo '<h3>'.__('Related Images', true).'</h3>';
				echo $this->element('backend/images_gallery_view', array('gallery' => $this->data['Gal']));
				?> 
				<?php if(!empty($this->data['Gal']) && (count($this->data['Gal']) > 1)){?>
					<div class="actions">
						<ul>
							<li style="width:140px;">
								<?php echo $this->Html->link(__('Positioning of Images', true), array('controller'=> 'gals','action' => 'index',$this->data['Content']['id'],'Content'));?>   
							</li>
						</ul>
					</div>
				<?php }?>
			</div>           
        </div>            
    </div>*/?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php //__('Actions'); ?></h3>
	<ul>
		<li><?php //echo $this->Html->link(__('List Contents', true), array('action' => 'index'));?></li>
	</ul>
</div>