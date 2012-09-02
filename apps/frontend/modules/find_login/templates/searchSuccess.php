
<?php if ($form->hasErrors()):?>
	<div id="loginError">					
		<div class="alert alert-error">
			<a class="close" data-dismiss="alert">&times;</a>
			<?php include_partial('global/error_message', array('form'=>$form));?>
		</div>
	</div>
<?php endif; ?>

<?php if ($sf_user->getFlash('search.failure', false) != false):?>
<div id="messageLayer">
	<div class="alert alert-error">
		<a class="close" data-dismiss="alert">&times;</a>
		User don't exist
	</div>
</div>
<?php endif; ?>

<div class="user-listBox">
		<h3>User Login Search</h3>
		<div class="userDetail-actions">
			<ul>
				<li><a href="<?php echo url_for('session/login') ?>">Back</a></li>
			</ul>
		</div>
		<?php include_partial('form', array('form' => $form)) ?>
	
</div>

