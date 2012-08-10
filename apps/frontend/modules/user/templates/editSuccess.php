
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

<?php if ($sf_user->getFlash('saved_user_success', false) == true): ?>
	<div class="loginError">
		<div class="alert alert-success">
			<a class="close" data-dismiss="alert">&times;</a>
			Your settings saved successfully!
		</div>
	</div>
<?php endif; ?>

<div class="user-listBox">
		<h3>Edit User</h3>
		<div class="userDetail-actions">
			<ul>
				<li><a href="<?php echo url_for('user/show?id='.$sf_request->getParameter('user_id')) ?>">Back</a></li>
				
			</ul>
		</div>
		<?php include_partial('form', array('form' => $form)) ?>
	
</div>

