
<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>


<form action="<?php echo url_for('find_login/search'); ?>" method="post">

<div id="hiddeninputs">
    <?php echo $form->renderHiddenFields(false) ?>
</div>

	<?php echo $form->renderGlobalErrors() ?>
	<div class="userInfo-Box">

		<fieldset>
			<legend class="info">User Login Search</legend>
			<div class="userList">
				<ul>
					<li>
						<span class="userInfo"><?php echo $form['email']->renderLabel() ?></span>
						<span class="userData"><?php echo $form['email'] ?></span></li>
							<?php if($form['email']->hasError()): ?>
					<li><?php echo $form['email']->renderError() ?></li>
							<?php endif; ?>
				</ul>
			</div>
		</fieldset>
	</div>

	<div class="userDetail-actions">
		<ul>
			<li><?php echo $form->renderHiddenFields() ?>
       &nbsp;<a href="<?php echo url_for('session/login?'); ?>">Cancel</a></li>
			<li><button type="submit" class="btn btn-primary"><?php echo ucfirst("Search Login") ?></button></li>
			
		</ul>
	</div>
</form>

