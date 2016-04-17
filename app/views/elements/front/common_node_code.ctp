<?php if(isset($this->params['named']['nodeId'])){
	$currentId = $this->params['named']['nodeId'];
	if(is_numeric($currentId)){?>
		 <script type="text/javascript">
		 $(window).load(function() {
		 	$('#<?php echo $currentId;?>').reveal();								     		
		});
		</script>	
	<?php }?>
<?php }?>
<?php if(isset($this->params['named']['previous'])){
	$countpro = count($nodes)-1;?>
	 <script type="text/javascript">
	 $(window).load(function() {
	 	$('#<?php echo $nodes[$countpro]['Node']['id'];?>').reveal();								     		
	});
	</script>	
<?php }?>
<?php if(isset($this->params['named']['next'])){?>
	 <script type="text/javascript">
	 $(window).load(function() {
	 	$('#<?php echo $nodes[0]['Node']['id'];?>').reveal();								     		
	});
	</script>	
<?php }?>
<script type="text/javascript">
$(document).ready(function() {
	$("body").keydown(function(e) {
		var id;
		$('.reveal-modal').each(function(i) {
			if($(this).css('visibility') == 'visible'){ //i is your index
				id  = $(this).attr('id');			
			}
		}); 
		if(e.keyCode == 37) { // Left Arrow
			$('#previousreveal'+id).click();
		}
		else if(e.keyCode == 39) { // Right Arrow
			$('#nextreveal'+id).click();
		}
	});
});
</script>