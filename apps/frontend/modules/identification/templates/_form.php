<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>


<form action="<?php echo url_for('identification/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
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
						<span class="userInfo"><?php echo $form['identification']->renderLabel() ?></span>
						<span class="userData"><?php echo $form['identification'] ?></span></li>
							<?php if($form['identification']->hasError()): ?>
					<li><?php echo $form['identification']->renderError() ?></li>
							<?php endif; ?>
					<li>
						<span class="userInfo"><?php echo $form['identification_type']->renderLabel() ?></span>
							<ul>
								<li><?php echo $form['identification_type'] ?></li>				
							</ul>
					<li>
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

