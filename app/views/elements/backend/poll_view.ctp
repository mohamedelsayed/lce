<?php
$poll = $this->requestAction(array('controller'=>'Pollview', 'action'=>'getActivePollData'));
if(!empty($poll)){	
	echo $this->Html->css('poll/poll', null, array('inline'=>false)); 
	echo $this->Javascript->link('poll/poll', false);
?>
<script>
	$(document).ready(function() {
		$("#pollAjaxLoader").hide(); //hide the ajax loader
		$("#pollMessage").hide(); //hide the ajax loader
		$("#pollSubmit").click(function() {
			return pollControl('<?=$this->Session->read('Setting.url');?>', false);
		});
		$("#votesResults").click(function() {
			return pollControl('<?=$this->Session->read('Setting.url');?>', true);
		});
	}); 
</script>
<?php
$pollStartHtml 	= '<div id="pollWrap"><h3>'.$poll['Poll']['title'].'</h3><ul>';
$pollEndHtml 	= '</ul>'
					.$this->Html->image('backend/ajaxLoader.gif', array('alt'=>"Ajax Loader", 'id'=>'pollAjaxLoader')).
					'<span id="pollMessage"></span><br />
					 <input type="submit" class="btn" name="pollSubmit" id="pollSubmit" value=" تصويت " />
					 <input type="submit" class="btn" name="votesResults" id="votesResults" value=" نتائج " />
				   </div>';	
$pollAnswersHtml = '';
foreach($poll['Option'] as $option){
	$pollAnswersHtml .= '<li>
							<input name="pollAnswerID" id="pollRadioButton'.$option['id'].'" type="radio" value="'.$option['id'].'" />'.
	 						$option['title'].
							'<span id="pollAnswer'.$option['id'].'"></span></li>
							<li class="pollChart pollChart'.$option['id'].'">
					    </li>';
}
echo $pollStartHtml . $pollAnswersHtml . $pollEndHtml;

}?>             