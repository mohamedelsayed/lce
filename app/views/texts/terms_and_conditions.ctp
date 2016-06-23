<?php $tree = array(array('url' => '/terms-and-conditions', 'str' => $content['Content']['title']));
echo $this->element('front'.DS.'breadcrumb', array('tree' => $tree));?>
<div class="title_event_page">
	<p><?php echo $content['Content']['title'];?></p>
</div>
<div class="img_about" style="margin-top: 10px;">
	<?php echo $content['Content']['body'];?>
</div>