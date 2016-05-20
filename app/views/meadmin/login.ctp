<?php echo $this->Html->css('backend/login');?>
<div class="users form" id="login">
<?php echo $form->create('User', array('url'=>'login'));?>
	<fieldset>
 		<legend><?php __('Login');?></legend>
	<?php 
		echo $form->input('username');
		echo $form->input('password');
		echo $form->end(__('Login', true));?>
		<div class="forget">
			<a href="<?php echo $base_url.'/forget-password';?>">Forgot Password?</a>
		</div>
	</fieldset>
</div>