<?php if($event_popup['Content']['show_as_a_popup'] == 1 && $this->name =='Home'){
	echo $this->Html->css('front/reveal', false);
	echo $this->Javascript->link('front/jquery.reveal', true);?>
	<script type="text/javascript">
		$(window).load(function(){
			$("#popupeventid").reveal();
		});
	</script>
	<a id="popupeventidanchor" data-reveal-id="popupeventid" href="javascript:void(0)">
		<div class="work-item-in" style="visibility: hidden;position: absolute;">Click</div>
	</a>
	<div id="popupeventid" class="reveal-modal">
		<div style="float:left; width:100%; text-align:center;">
			<?php echo $event_popup['Content']['body'];?>
		</div>									
	    <a class="close-reveal-modal">&#215;</a>                                         
	</div>
<?php }?>