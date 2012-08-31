
<script type="text/javascript">
        $(document).ready(function () {
            
        });
   </script>




<div class="userBox-container">

<?php if ($sf_user->getFlash('welcome_notice_success', false) == true): ?>
	<div class="loginError">
		<div class="alert alert-success">
			<a class="close" data-dismiss="alert">&times;</a>
			Welcome <strong><?php echo $sf_user->getAttribute('full_name') ?></strong> you have succeffuly registered! your password is ( <strong><span class="pass"><?php echo $sf_user->getFlash('generated_pass') ?></span></strong> ). pleas change yout password now!
		</div>
	</div>
<?php endif; ?>

<?php if ($sf_user->getFlash('notice_success', false) == true): ?>
	<div class="loginError">
		<div class="alert alert-success">
			<a class="close" data-dismiss="alert">&times;</a>
			You have <strong>Successfuly</strong> changed your password!
		</div>
	</div>
<?php endif; ?>

<?php if ($sf_user->getFlash('user_id_saved_success', false) == true): ?>
	<div class="loginError">
		<div class="alert alert-success">
			<a class="close" data-dismiss="alert">&times;</a>
			You have <strong>Successfuly</strong> enter your ID No!
		</div>
	</div>
<?php endif; ?>

	<div class="user-listBox">
		<div class="lisHeader">
				<h1>User Detail Information</h1>
			</div>
<!--
		<h3>User Detail Information<span id="minimize" class="opened"><img src="<?php echo image_path('down')  ?>"></span></h3>
			<a class="button" href="<?php echo url_for('user/new') ?>"><img src="<?php echo image_path('icons/icon-16-add');?>"><?php echo 'New User';?>&nbsp;»</a> -->
			
		<div class="userLayer-info">
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
						<li><span class="userInfo">ID No:</span><span class="userData">
		<?php foreach( $user->getUserIdentifications() as $useridentity ): ?>
<?php echo '[ '.'<i>'. $useridentity->getIdentificationType() .'</i>'.' => '. $useridentity->getIdentification().' ]' ?>
		<?php endforeach; ?>
			</span></li>
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
</div>


