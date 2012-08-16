
<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>


<form action="<?php echo url_for('register/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
<div id="hiddeninputs">
    <?php echo $form->renderHiddenFields(false) ?>
</div>

	<?php echo $form->renderGlobalErrors() ?>
	<div class="userInfo-Box">

		<fieldset>
			<legend class="info">Account information</legend>
			<div class="userList">
				<ul>
					<li>
						<span class="userInfo"><?php echo $form['name']->renderLabel() ?></span>
						<span class="userData"><?php echo $form['name'] ?></span></li>
							<?php if($form['name']->hasError()): ?>
					<li><?php echo $form['name']->renderError() ?></li>
							<?php endif; ?>
					<li>
						<span class="userInfo"><?php echo $form['fathers_name']->renderLabel() ?></span>
						<span class="userData"><?php echo $form['fathers_name'] ?></span></li>
							<?php if($form['fathers_name']->hasError()): ?>
					<li><?php echo $form['fathers_name']->renderError() ?></li>
							<?php endif; ?>
					<li>
						<span class="userInfo"><?php echo $form['grand_fathers_name']->renderLabel() ?></span>
						<span class="userData"><?php echo $form['grand_fathers_name'] ?></span></li>
							<?php if($form['grand_fathers_name']->hasError()): ?>
					<li><?php echo $form['grand_fathers_name']->renderError() ?></li>
							<?php endif; ?>
					<li>
						<span class="userInfo"><?php echo $form['phone']->renderLabel() ?></span>
						<span class="userData"><?php echo $form['phone'] ?></span></li>
							<?php if($form['phone']->hasError()): ?>
					<li><?php echo $form['phone']->renderError() ?></li>
							<?php endif; ?>
					<li><span class="userInfo"><?php echo $form['alternate_email']->renderLabel() ?></span>
						<span class="userData"><?php echo $form['alternate_email'] ?></span></li>
							<?php if($form['alternate_email']->hasError()): ?>
					<li><?php echo $form['alternate_email']->renderError() ?></li>
							<?php endif; ?>	
				</ul>
			</div>
		</fieldset>
	</div>

	<div class="userDetail-actions">
		<ul>
			<li><?php echo $form->renderHiddenFields() ?>
       &nbsp;<a href="<?php echo url_for('user/show?id='.$form->getObject()->getId()); ?>">Cancel</a></li>
			<li><button type="submit" class="btn btn-primary"><?php echo ucfirst("Save") ?></button></li>
			
		</ul>
	</div>
</form>

