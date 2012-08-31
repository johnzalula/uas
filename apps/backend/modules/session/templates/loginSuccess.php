<?php use_helper('I18N') ?>


<div class="sf_admin_login-container">
	<div class="sf_admin_login-cont">

	<div class="sf_admin_loginContent">
		<div class="sf_admin_loginLogo">
			<div class="sf_admin_login_data">
				<img src="<?php echo image_path('user-network-green') ?>">
			</div>
		</div>
		<div class="sf_admin_loginBox">
			<div class="sf_admin_loginForm">
				<h3><img src="<?php echo image_path('small-user-icon') ?>">Sign In</h3>       
				<form class="well" action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
				<?php echo $form['login'] ?>
					<!--<input type="text" class="span3 roundBox" id="username" name="username" placeholder="Username or email">-->
					
				<?php echo $form['password'] ?>

			<!--<input type="password" class="span3 roundBox" id="password" name="password" placeholder="Password"> -->

					<input class="btn loginBtn btn-primary" type="submit" value="<?php echo __('sign in') ?>" />			
					<p><a href="<?php echo url_for('@sf_guard_password') ?>"><?php echo __('Forgot your password?') ?></a></p>

				</form>
			</div>
		</div>
		
		<div class="clearFix"></div>
	</div>

	</div>
</div>

<div class="sf_admin_footer-cont">
		<div class="sf_admin_footer">
			<div class="sf_admin_footer_content">
				<p>Powered by <a href="http://www.symfony-project.org/"><img align="middle" src="/images/symfony_button.gif" alt="Symfony_button" /></a>&nbsp;-&nbsp;The development of this system was sponsored by <a target="_blank" href="http://www.vliruos.be/"><img align="middle" src="/images/vliruos.jpg" width="100" height="100" alt="VLIRUOS" /></a></p>
				<p>copyright &copy; ICT and Library Center</p>
				<p>Mekelle University</p>
			</div>
		</div>
	</div>

