<?php if(!empty($tree)){?>
	<div class="data-menu">
		<?php $k = 1;
		foreach ($tree as $key => $value) {
			$flag = false;
			if(isset($treeLink)){
				if($treeLink[$key] != ''){					
					$flag = true;
				}
			}if($flag == true){?><a href="<?php echo $this->Session->read('Setting.url').'/'.$treeLink[$key];?>"><?php }echo $value;if($flag == true){?></a><?php }
			if($k++ < count($tree)){?>
				<img class="arrow_image" src="<?php echo $this->Session->read('Setting.url').'/img/front/';?>arrw.jpg" />
			<?php }?>
		<?php }?>
	<?php }?>
</div>