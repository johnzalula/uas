<?php if($sf_user->isAuthenticated()): ?>

<div class="userBox-container">

<?php if ($sf_user->getFlash('notice_success', false) == true): ?>
	<div class="loginError">
		<div class="alert alert-success">
			<a class="close" data-dismiss="alert">&times;</a>
			You have <strong>Successfuly</strong> changed your password!
		</div>
	</div>
<?php endif; ?>

	<div class="user-listBox">
		<h3>User Detail Information</h3>
		<div class="userDetail-actions">
			<ul>
				<li><a href="<?php echo url_for('user/edit?id='.$user->getId()) ?>">Edit</a></li>
				<li>
					<a href="<?php echo url_for('user/changepassword?user_id='.$user->getId().'&user_email='.$user->getEmailLocalPart()) ?>">Change password</a>
<!--<?php echo link_to('Change password','change_user_password', array('user_id' => $user->getId(), 'user_email' => $user->getEmailLocalPart()))?>--></li>
			</ul>
		</div>
		<div class="userInfo-Box">

		<fieldset>
			<legend>Account information</legend>
			<div class="userList">
				<ul>
					<li><span class="userInfo">Full name:</span><span class="userData"><?php echo $user->getFullName() ?></span></li>
					<li><span class="userInfo">Login:</span><span class="userData"><?php echo $user->getLogin() ?></span></li>
					<li><span class="userInfo">Status:</span><span class="userData"><?php echo $user->getStatus() ?></span></li>
					<li><span class="userInfo">Expires at:</span><span class="userData"><?php echo $user->getExpiresAt() ?></span></li>
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
<?php else: ?>
<div class="securedLayer">
	<div class="loginError">
		<div class="alert alert-error">
			<a class="close" data-dismiss="alert">&times;</a>
			This user is not <strong>Authorized</strong> to access this page!
		</div>
	</div>

</div>
<?php endif ?>


