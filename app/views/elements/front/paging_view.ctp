<div id="paging_menu">
	<div class="pagination">
	    <ul>
	    	<?php //$this->Paginator->options = array('url'=> '../../'.$url)?>
	        <li><?php echo $this->Paginator->prev('', array(), null, array('class'=>'prev disabled'));?></li>
	        <?php echo $this->Paginator->numbers(array('tag'=>'li', 'separator'=>'','modulus'=>22));?>
	        <li><?php echo $this->Paginator->next('', array(), null, array('class' => 'next disabled'));?></li>
	    </ul>
	</div>
</div>