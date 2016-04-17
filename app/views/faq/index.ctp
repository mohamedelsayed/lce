<script type="text/javascript">
	$(document).ready(function(){
		$(".faqquestion").click(function(){
			$('.faqquestion').removeClass('faqquestioncurrent');
			var nextDiv = $(this).next();
			var status = nextDiv.css("display");
			$(".faqanswer").fadeOut();
			if(status == 'none'){								
				nextDiv.fadeIn();
				$(this).addClass('faqquestioncurrent');
			}
			else if(status == 'block'){								
				nextDiv.fadeOut();								
				$(this).removeClass('faqquestioncurrent');
			}
		});									
	});
</script>
<div class="top_con">
	<?php /*<div class="top_con_2">FAQs</div>*/?>
	<div class="top_con_3">General Questions</div>
</div>
<?php if(!empty($faqs)){
	$i = 1;
	$count = count($faqs);?>
	<?php foreach ($faqs as $key => $faq) {?>
		<div class="faqquestionanswer">
			<div class="faqquestion">
				<?php echo $faq['Faq']['question'];?>
    		</div>
    		<div class="faqanswer">
    			<?php echo $faq['Faq']['answer'];?>
			</div>
		</div>
		<?php if($i++ < $count){?>
			<div class="bck"></div>
		<?php }?>
	<?php }?>
<?php }else{?>
	<div class="no-data-found">No data found.</div>
<?php }?>