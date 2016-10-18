<?php $saved_instructors_text  = '';
if(!empty($saved_instructors)){
	$saved_instructors_text = implode(',', $saved_instructors).',';	
}?>
<div class="input text">
	<label for="CoachMobile">Instructor</label>
	<ul id="instructors_result" class="autocomplete_ul_result instructors_result">
		<?php foreach ($instructors as $key => $value) {
			if(in_array($key, $saved_instructors)){?>
				<li class="itemli" id="sitemli<?php echo $key;?>"><h5><?php echo $value;?></h5>
				<a userid="<?php echo $key;?>" class="removeuser removeusers">x</a></li>
			<?php }?>
		<?php }?>
	</ul>
	<input type="hidden" name="instructors_ids" id="instructors_ids" value="<?php echo $saved_instructors_text;?>" />
	<input type="text" id="instructors_id" name="instructors_id">
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
	var savailableTags = [
	<?php foreach ($instructors as $key => $value) {?>
		{value: "<?php echo $key;?>", label: "<?php echo $value;?>"},
	<?php }?>
	];
    jQuery("#instructors_id").autocomplete({
    	select: function( event, ui ){
			var oldids = jQuery("#instructors_ids").val();
			if(oldids){
				if(oldids.indexOf(ui.item.value) == -1){
					addlitoul(ui.item.value, ui.item.label);					
					jQuery("#instructors_ids").val(oldids+ui.item.value+",");
				}
			}else{
				addlitoul(ui.item.value, ui.item.label);
				jQuery("#instructors_ids").val(ui.item.value+",");
			}
			jQuery("#instructors_id").val("");	
			return false;
		},
		source: savailableTags,
		minLength: 0
    });
	jQuery("#instructors_id").focus(function(){
		//jQuery('#instructors_id').trigger("keyup"); 
    });
    jQuery("body").on("click", ".removeusers", function(){
		var userid = jQuery(this).attr('userid');
		jQuery(this).closest('li').remove();
		var oldids = jQuery("#instructors_ids").val();
		var newids = oldids.replace(userid+',','');
		jQuery("#instructors_ids").val(newids);
	});
});
function addlitoul(uiitemvalue, uiitemlabel){
	jQuery("ul#instructors_result").append('<li class="itemli" id="sitemli'+uiitemvalue+'"><h5>'+uiitemlabel+'</h5><a userid="'+uiitemvalue+'" class="removeuser removeusers">x</a></li>');
}
</script>