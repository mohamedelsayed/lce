<div style="float: left;font-size: 18px;padding: 60px 0;text-align: center;width: 100%;">
	<?php if(isset($_GET['all_instalments_done'])){?>
		<a style="color: #000000;">You already paid all instalments.</a>
	<?php }else{?>	
		<a onclick="open_checkout_installment_form_popup();" class="pay_instalment"><?php echo $title;?></a>
		<script type="text/javascript">
		var value_for_each_installment = <?php echo $settings['value_for_each_installment'];?>;
		jQuery(document).ready(function(){
			open_checkout_installment_form_popup();
		});
		</script>
	<?php }?>
</div>
<style type="text/css">
.pay_instalment{
	border: 2px solid #f58521;
	border-radius: 5px;
	color: #f58521;
	cursor: pointer;
	font-size: 16px;
	width: 20%;
	display: initial;
	padding: 5px 20px;	
}
.pay_instalment:hover{
	border: 2px solid #f58521;
	text-decoration:none;
	color: #ffffff;
	background-color: #f58521;
	transition: .5s all;
	-webkit-transition: 0.5s all ease;
	-moz-transition: 0.5s all ease;
	-o-transition: 0.5s all ease;
	-ms-transition: 0.5s all ease;
}
.event_popup_ticket_price_all_popup{
	float: right;
}
</style>	