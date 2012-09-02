
<script type="text/javascript">
        $(document).ready(function () {
            
        });
   </script>




<div class="userBox-container">

<?php if ($sf_user->getFlash('search.success', false) == true): ?>
	<div class="loginError">
		<div class="alert alert-success">
			<a class="close" data-dismiss="alert">&times;</a>
			You have <strong>Successfuly</strong> searched your login account information!
		</div>
	</div>
<?php endif; ?>

	<div class="user-listBox">
		<div class="lisHeader">
				<h1>User Detail Information</h1>
			</div>
			
		<div class="userLayer-info">
			<div class="userDetail-actions">
				<ul>
					<li><a href="<?php echo url_for('session/login') ?>">Cancel</a></li>
				</ul>
			</div>
			<div class="userInfo-Box">

			<fieldset>
				<legend>Account information</legend>
				<div class="userList">
					<ul>
						<li><span class="userInfo">Full name:</span><span class="userData"><?php echo $user->getFullName() ?></span></li>
						<li><span class="userInfo">Login:</span><span class="userData "><span class="pass"><?php echo $user->getLogin() ?></span></span></li>
						<li><span class="userInfo">Status:</span><span class="userData"><?php echo $user->getStatus() ?></span></li>
						<li><span class="userInfo">Expires at:</span><span class="userData"></span></li>
					</ul>
				</div>
			</fieldset>
		
			<fieldset>
				<legend>Email Information</legend>
				<div class="userList">
					<ul>
						<li><span class="userInfo">Email address:</span><span class="userData"><?php echo $user->getEmailAddress() ?></span></li>
						<li><span class="userInfo">Email quota:</span><span class="userData"><?php echo $user->getEmailQuota() ?></span></li>
					</ul>
				</div>
			</fieldset>
		
			<fieldset>
				<legend>Contact Information</legend>
				<div class="userList">
					<ul>
						<li><span class="userInfo">Phone No:</span><span class="userData"><?php echo $user->getPhone() ?></span></li>
						<li><span class="userInfo">Alternate email:</span><span class="userData"><?php echo $user->getAlternateEmail() ?></span></li>
					</ul>
				</div>
			</fieldset>


		</div>
		</div>
	</div>
</div>


