<?php if($sf_user->isAuthenticated()): ?>
<?php if ($form->hasErrors()):?>
	<div id="loginError">					
		<div class="alert alert-error">
			<a class="close" data-dismiss="alert">&times;</a>
			<?php include_partial('global/error_message', array('form'=>$form));?>
		</div>
	</div>
<?php endif; ?>

<?php if ($sf_user->getFlash('user_failure', false) == true): ?>
	<div class="loginError">
		<div class="alert alert-error">
			<a class="close" data-dismiss="alert">&times;</a>
			User does not exist, please try again!
		</div>
	</div>
<?php endif; ?>

<?php if ($sf_user->getFlash('user_change_failure', false) == true): ?>
	<div class="loginError">
		<div class="alert alert-error">
			<a class="close" data-dismiss="alert">&times;</a>
			current password is worng!
		</div>
	</div>
<?php endif; ?>



<div class="user-listBox">
		<h3>Change User Password</h3>
		<div class="userDetail-actions">
			<ul>
				<li><a href="<?php echo url_for('user/show?id='.$sf_request->getParameter('user_id')) ?>">Back</a></li>
				
			</ul>
		</div>
	<form action="<?php echo url_for('user/changepassword'); ?>" method="post">
		<div id="hiddeninputs">
			 <?php echo $form->renderHiddenFields(false) ?>
		</div>

		<div class="userInfo-Box">

		<fieldset>
			<legend>Account information</legend>
			<div class="userList">
				<ul>
					<li><span class="userInfo"><?php echo $form['password']->renderLabel() ?></span><span class="userData"><?php echo $form['password'] ?></span></li>
					<li><span class="userInfo"><?php echo $form['new_password']->renderLabel() ?></span><span class="userData"><?php echo $form['new_password'] ?></span></li>
					<li><span class="userInfo"><?php echo $form['confirm_new_password']->renderLabel() ?></span><span class="userData"><?php echo $form['confirm_new_password'] ?></span></li>
				</ul>
			</div>
		</fieldset>
	</div>
	</div>
	<div class="userDetail-actions">
			<ul>
				<li>
          	<a href="<?php echo url_for('user/show?id='.$sf_request->getParameter('user_id')) ?>">Cancel</a></li>
				<li><button type="submit" class="btn btn-primary"><?php echo ucfirst("Save") ?></button></li>
				
			</ul>
		</div>
	</form>
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

