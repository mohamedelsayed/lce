<div class="container_out">
    <div class="users form">
		<?php echo $form->create('Member', array('url'=>$this->Session->read('Setting.url').'/'.$this->params['url']['url']));?>
	    <fieldset>
	        <legend><?php __('Change password');?></legend>
	    	<?php echo $form->input('password', array('label'=>'Write Your New Password'));
	    	echo $form->end(__('Submit', true));?>
	    </fieldset>
	</div>
</div>