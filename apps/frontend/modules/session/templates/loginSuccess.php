
<div id="login-container">
	<div id="login-cont">
		<?php if ($form->hasErrors()):?>
				<div id="loginError">					
					<div class="alert alert-error">
						<a class="close" data-dismiss="alert">&times;</a>
						<?php include_partial('global/error_message', array('form'=>$form));?>
					</div>
				</div>
			<?php endif; ?>

		<?php if ($sf_user->getFlash('login_failure_notice', false) == true): ?>
			<div class="loginError">
				<div class="alert alert-error">
					<a class="close" data-dismiss="alert">&times;</a>
					Either your <strong>password</strong> or <strong>username</strong> was wrong, please try again! 
				</div>
			</div>
		<?php endif; ?>
			
	<div class="loginContent">
		
		<div class="loginLogo">
			<div class="login_data">
				<img src="<?php echo image_path('user-network-green') ?>">
				<p>UAS</p>
				<p>User Administration System</p>
			</div>
				
		</div>
		<div class="loginBox">
			<div class="loginForm">
				<h3>Sign In</h3>       
				<form class="well" action="<?php echo url_for('session/dologin'); ?>" method="post">
					<div id="hiddeninputs">
							<input type="hidden" name="sf_method" value="put" />
						</div>
						<div id="hiddeninputs">
							 <?php echo $form->renderHiddenFields(false) ?>
						</div>
					<?php echo $form['login'] ?>
					<?php echo $form['password'] ?>

					<input class="btn loginBtn btn-primary" type="submit" value="<?php echo 'Login';?>" />			
					<p><label class="checkbox"><input type="checkbox"> 
					Remember?</label></p>

				</form>
			</div>
		</div>
		
		<div class="register-cont">
			<div class="registerBox">
				<h3>New to UAS</h3>
				<p>If you do not have an account, you can <a href="<?php echo url_for('register/new') ?>">sign up</a>.</p>
			</div>
		</div>					

		<div class="clearFix"></div>
	</div>

	</div>
</div>

<div class="footer-cont">
		<div class="footerBox">
			<div class="footer_content">
				<p>Powered by <a href="http://www.symfony-project.org/"><img align="middle" src="/images/symfony_button.gif" alt="Symfony_button" /></a>&nbsp;-&nbsp;The development of this system was sponsored by <a target="_blank" href="http://www.vliruos.be/"><img align="middle" src="/images/vliruos.jpg" width="100" height="100" alt="VLIRUOS" /></a></p>
				<p>copyright &copy; ICT and Library Center</p>
				<p>Mekelle University</p>
			</div>
		</div>
	</div>

