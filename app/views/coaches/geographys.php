<?php $saved_geographys_text  = '';
if(!empty($saved_geographys)){
	$saved_geographys_text = implode(',', $saved_geographys).',';	
}?>
<div class="input text">
	<label for="CoachMobile">Geographies</label>
	<ul id="geographys_result" class="autocomplete_ul_result geographys_result">
		<?php foreach ($geographys as $key => $value) {
			if(in_array($key, $saved_geographys)){?>
				<li class="itemli" id="sitemli<?php echo $key;?>"><h5><?php echo $value;?></h5>
				<a userid="<?php echo $key;?>" class="removeuser removeuserg">x</a></li>
			<?php }?>
		<?php }?>
	</ul>
	<input type="hidden" name="geographys_ids" id="geographys_ids" value="<?php echo $saved_geographys_text;?>" />
	<input type="text" id="geographys_id" name="geographys_id">
</div>
<script type="text/javascript">
$(document).ready(function(){
	var gavailableTags = [
	<?php foreach ($geographys as $key => $value) {?>
		{value: "<?php echo $key;?>", label: "<?php echo $value;?>"},
	<?php }?>
	];
    $("#geographys_id" ).autocomplete({
    	select: function( event, ui ){
			var oldids = jQuery("#geographys_ids").val();
			if(oldids){
				if(oldids.indexOf(ui.item.value) == -1){
					addlitoulg(ui.item.value, ui.item.label);					
					jQuery("#geographys_ids").val(oldids+ui.item.value+",");
				}
			}else{
				addlitoulg(ui.item.value, ui.item.label);
				jQuery("#geographys_ids").val(ui.item.value+",");
			}
			jQuery("#geographys_id").val("");	
			return false;
		},
		source: gavailableTags
    });
    jQuery("body").on("click", ".removeuserg", function(){
		var userid = jQuery(this).attr('userid');
		jQuery(this).closest('li').remove();
		var oldids = jQuery("#geographys_ids").val();
		var newids = oldids.replace(userid+',','');
		jQuery("#geographys_ids").val(newids);
	});
});
function addlitoulg(uiitemvalue, uiitemlabel){
	jQuery("ul#geographys_result").append('<li class="itemli" id="sitemli'+uiitemvalue+'"><h5>'+uiitemlabel+'</h5><a userid="'+uiitemvalue+'" class="removeuser removeuserg">x</a></li>');
}
</script>