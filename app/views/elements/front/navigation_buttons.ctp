<div id="lightbox-nav" style="display: block;">
	<?php $tempurl = explode("/", $this->params['url']['url']);
	$currenturlwithoutpage = '';
	$countitem = 1; 
	foreach ($tempurl as $value) {
		$pos1 = strpos($value,'page:');
		$pos2 = strpos($value,'previous:');
		$pos3 = strpos($value,'next:');
		if($pos1 === false && $pos2 === false && $pos3 === false){
			$currenturlwithoutpage .= $value;
			if($countitem++ < count($tempurl))
			$currenturlwithoutpage .= '/';
		}
	}$currenturlwithoutpage = rtrim($currenturlwithoutpage,"/");?>
    <?php if($k != 0){?>
    	<a id="previousreveal<?php echo $nodeId?>" class="lightbox-nav-btnPrev" ></a>
        <script type="text/javascript">
		$(document).ready(function() {
			$('#previousreveal<?php echo $nodeId?>').click(function(e) {
				//$(".close-reveal-modal").click();
				$(".reveal-modal").css('visibility','hidden');
		     	e.preventDefault();
			 	$('#<?php echo $prevId?>').reveal();
		    });
		    $('#previousreveal<?php echo $nodeId?>').mouseover(function(){
		     	div = $('#previousreveal<?php echo $nodeId?>');
		     	div.css('background-image',"url('<?php echo $this->Session->read('Setting.url').'/img/lightbox/lightbox-btn-prev.png';?>')");												     	
     		}).mouseout(function(){
	     		<?php /*div.css('background-image',"url('<?php echo $this->Session->read('Setting.url').'/img/lightbox/lightbox-blank.gif';?>')");*/?>
	     		div.css('background-image',"url('<?php echo $this->Session->read('Setting.url').'/img/lightbox/lightbox-btn-prev.png';?>')");
     		});
		});
		</script>	
	<?php }else{?>
		<?php if($page != 1){?>			
		<a id="previousreveal<?php echo $nodeId?>" class="lightbox-nav-btnPrev" ></a>
		<script type="text/javascript">
		$(document).ready(function() {
			$('#previousreveal<?php echo $nodeId?>').click(function(e) {
				window.location= '<?php echo $this->Session->read('Setting.url').'/'.$currenturlwithoutpage.'/page:'.($page-1).'/previous:1';?>';
		    });
		     $('#previousreveal<?php echo $nodeId?>').mouseover(function(){
		     	div = $('#previousreveal<?php echo $nodeId?>');
		     	div.css('background-image',"url('<?php echo $this->Session->read('Setting.url').'/img/lightbox/lightbox-btn-prev.png';?>')");												     	
     		}).mouseout(function(){
     			<?php /*div.css('background-image',"url('<?php echo $this->Session->read('Setting.url').'/img/lightbox/lightbox-blank.gif';?>')");*/?>
	     		div.css('background-image',"url('<?php echo $this->Session->read('Setting.url').'/img/lightbox/lightbox-btn-prev.png';?>')");
     		});								     		
		});
		</script>
		<?php }?>
	<?php }?>									
	<?php if($k != $countNode-1){?>
		<a id="nextreveal<?php echo $nodeId?>" class="lightbox-nav-btnNext"></a>											
        <script type="text/javascript">
		$(document).ready(function() {
			$('#nextreveal<?php echo $nodeId?>').click(function(e) {
				//$(".close-reveal-modal").click();
				$(".reveal-modal").css('visibility','hidden');
				e.preventDefault();
				$('#<?php echo $nextId?>').reveal();
		    });
		    $('#nextreveal<?php echo $nodeId?>').mouseover(function(){
		     	div = $('#nextreveal<?php echo $nodeId?>');
		     	div.css('background-image',"url('<?php echo $this->Session->read('Setting.url').'/img/lightbox/lightbox-btn-next.png';?>')");
     		}).mouseout(function(){
     			<?php /*div.css('background-image',"url('<?php echo $this->Session->read('Setting.url').'/img/lightbox/lightbox-blank.gif';?>')");*/?>
	     		div.css('background-image',"url('<?php echo $this->Session->read('Setting.url').'/img/lightbox/lightbox-btn-next.png';?>')");
     		});									     		
		});
		</script>
	<?php }else{?>
		<?php $lastpage = $this->Paginator->counter(array('format' => '%pages%'));
		if($lastpage != $page){ ?>
		<a id="nextreveal<?php echo $nodeId?>" class="lightbox-nav-btnNext"></a>
		<script type="text/javascript">
		$(document).ready(function() {
			$('#nextreveal<?php echo $nodeId?>').click(function(e) {
				window.location= '<?php echo $this->Session->read('Setting.url').'/'.$currenturlwithoutpage.'/page:'.($page+1).'/next:1';?>';
		    });
		    $('#nextreveal<?php echo $nodeId?>').mouseover(function(){
		     	div = $('#nextreveal<?php echo $nodeId?>');
		     	div.css('background-image',"url('<?php echo $this->Session->read('Setting.url').'/img/lightbox/lightbox-btn-next.png';?>')");
     		}).mouseout(function(){
     			<?php /*div.css('background-image',"url('<?php echo $this->Session->read('Setting.url').'/img/lightbox/lightbox-blank.gif';?>')");*/?>
	     		div.css('background-image',"url('<?php echo $this->Session->read('Setting.url').'/img/lightbox/lightbox-btn-next.png';?>')");
     		});									     		
		});
		</script>
		<?php }?>
	<?php }?>
</div>          