<div class="container_out">
    <div class="users form">
    <?php echo $form->create('Member', array('url'=>$this->Session->read('Setting.url').'/'.$this->params['url']['url']));?>
        <fieldset>
            <legend><?php __('Forgot username or password');?></legend>
        	<?php echo $form->input('email', array('label'=>'Write Your Email'));?>
        </fieldset>
    <?php echo $form->end(__('Submit', true));?>
    </div>
</div>