<div class="container_out">
	<div class="users form" id="login">
	<?php echo $form->create('Member', array('url'=>'login'));?>
		<fieldset>
	 		<legend><?php __('Login');?></legend>
		<?php 
			echo $form->input('username', array('placeholder' => 'Username or Email', 'label' => false));
			echo $form->input('password', array('placeholder' => 'Password', 'label' => false));?>
			<div class="input remember_checkbox_out">				
				<?php echo $form->checkbox('remember', array('class' => 'remember_checkbox'));?>
				<label for="MemberRemember">Remember me</label>
				<div class="login-box-terms">
					<a class="lostpassword" title="Forgot password?" href="<?php echo $this->Session->read('Setting.url').'/forum/forget';?>">Forgot password?</a>
				</div>
			</div>
			<?php echo $form->end(__('Login', true));?>			
		</fieldset>
	</div>
</div>