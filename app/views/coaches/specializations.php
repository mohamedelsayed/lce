<?php $saved_specializations_text  = '';
if(!empty($saved_specializations)){
	$saved_specializations_text = implode(',', $saved_specializations).',';	
}?>
<div class="input text">
	<label for="CoachMobile">Specializations</label>
	<ul id="specializations_result" class="autocomplete_ul_result specializations_result">
		<?php foreach ($specializations as $key => $value) {
			if(in_array($key, $saved_specializations)){?>
				<li class="itemli" id="sitemli<?php echo $key;?>"><h5><?php echo $value;?></h5>
				<a userid="<?php echo $key;?>" class="removeuser removeusers">x</a></li>
			<?php }?>
		<?php }?>
	</ul>
	<input type="hidden" name="specializations_ids" id="specializations_ids" value="<?php echo $saved_specializations_text;?>" />
	<input type="text" id="specializations_id" name="specializations_id">
</div>
<script type="text/javascript">
$(document).ready(function(){
	var savailableTags = [
	<?php foreach ($specializations as $key => $value) {?>
		{value: "<?php echo $key;?>", label: "<?php echo $value;?>"},
	<?php }?>
	];
    $("#specializations_id").autocomplete({
    	select: function( event, ui ){
			var oldids = jQuery("#specializations_ids").val();
			if(oldids){
				if(oldids.indexOf(ui.item.value) == -1){
					addlitoul(ui.item.value, ui.item.label);					
					jQuery("#specializations_ids").val(oldids+ui.item.value+",");
				}
			}else{
				addlitoul(ui.item.value, ui.item.label);
				jQuery("#specializations_ids").val(ui.item.value+",");
			}
			jQuery("#specializations_id").val("");	
			return false;
		},
		source: savailableTags,
		minLength: 0
    });
	$("#specializations_id").focus(function(){
		//$('#specializations_id').trigger("keyup"); 
    });
    jQuery("body").on("click", ".removeusers", function(){
		var userid = jQuery(this).attr('userid');
		jQuery(this).closest('li').remove();
		var oldids = jQuery("#specializations_ids").val();
		var newids = oldids.replace(userid+',','');
		jQuery("#specializations_ids").val(newids);
	});
});
function addlitoul(uiitemvalue, uiitemlabel){
	jQuery("ul#specializations_result").append('<li class="itemli" id="sitemli'+uiitemvalue+'"><h5>'+uiitemlabel+'</h5><a userid="'+uiitemvalue+'" class="removeuser removeusers">x</a></li>');
}
</script>