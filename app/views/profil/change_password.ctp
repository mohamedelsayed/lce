<?php echo $this->Html->css('backend/login');?>
<div class="users form" id="login">
<?php echo $form->create('User', array('url'=>$this->Session->read('Setting.url').'/'.$this->params['url']['url']));?>
    <fieldset>
        <legend><?php __('Change password');?></legend>
    	<?php echo $form->input('password', array('label'=>'Write Your New Password'));
    	echo $form->end(__('Submit', true));?>
    </fieldset>
</div>