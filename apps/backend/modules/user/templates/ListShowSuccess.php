<?php if($sf_user->isAuthenticated() && $sf_user->hasCredential('admin')): ?>

<?php use_helper('I18N', 'Date') ?>

<div id="sf_admin_container">


	<h1><?php echo __('User ' . $user->getFullName(), array(), 'messages') ?></h1>

	<?php include_partial('user/flashes') ?>

	<div id="sf_admin_header">
		<ul>
			<li><a href="<?php echo url_for('user/index') ?>"><img src="<?php echo image_path('arrow_left') ?>"> Back</a><li>
			<li>Actions<img src="<?php echo image_path('next') ?>"></li>
			<li><a href="<?php echo url_for('user/edit?id='.$user->getId()) ?>">Edit</a></li>
			<li><a href="<?php echo url_for('user/listDelete?id='.$user->getId()) ?>">Delete</a></li>
			<li><a href="" onclick="window.print();return false;">Print version</a></li>
			<li><a href="<?php echo url_for('user/resetpassword?id='.$user->getId()); ?>">Reset Password</a></li>
			<li><a href="<?php echo url_for('') ?>">Extend</a></li>
		</ul>
	</div>

<div id="sf_admin_wrapper">
	<div id="sf_admin_content">
		<div class="sf_admin_user">
		<fieldset>
			<legend>User Account Detail</legend>
		<table>
			<tr>
				<td><label><?php echo __('Status') ?></label></td>
				<td><b><?php echo $user->getStatus(); ?></b></td>
			</tr>
			<tr>
				<td><label>Name</label></td>
				<td><?php echo $user->getName(); ?></td>
			</tr>
			<tr>
				<td><label>Fathers name</label></td>
				<td><?php echo $user->getFathersName(); ?></td>
			</tr>
			<tr>
				<td><label>Grandfathers name</label></td>
				<td><?php echo $user->getGrandFathersName(); ?></td>
			</tr>
			<tr>
				<td><label>Login</label></td>
				<td><?php echo $user->getLogin(); ?></td>
			</tr>
			<tr>
				<td><label>Email address</label></td>
				<td><?php echo $user->getEmailLocalPart() . "@" . $user->getDomainName()->getName(); ?></td>
			</tr>
			<tr>
				<td><label>Alternate Email address</label></td>
				<td><?php echo $user->getAlternateEmail(); ?></td>
			</tr>
			<tr>
				<td><label>Phone</label></td>
				<td><?php echo $user->getPhone(); ?></td>
			</tr>
			<?php if($sf_user->hasFlash('generated_pass')): ?>
				<tr>
					<td><label>Auto Generated Password</label></td>
					<td><?php echo htmlentities($sf_user->getFlash('generated_pass')); ?></td>
				</tr>
			<?php endif; ?>
		</table>
		</fieldset>
		
		<fieldset>
		<legend>FTP Accounts </legend> 
			<table>
				<tr>
					<th>Upload Bandwidth</th>
					<th>Download Bandwidth</th>
					<th>IP Access</th>
					<th>Quota Size</th>
					<th>Quota Files</th>
				</tr>

				<?php foreach($user->getFtpAccounts() as $ftp_account): ?>
					<tr>
						<td><?php echo $ftp_account->getUpBandwidth(); ?></td>
						<td><?php echo $ftp_account->getDownBandwidth(); ?></td>
						<td><?php echo $ftp_account->getIpAccess();  ?></td>
						<td><?php echo $ftp_account->getQuotaSize();  ?></td>
						<td><?php echo $ftp_account->getQuotaFiles();  ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		</fieldset>

		<fieldset>
		<legend> Samba Accounts </legend>
			<table>
				<tr>
					<th>Hostname</th>
				</tr>
				<?php foreach($user->getSambaAccounts() as $samba_account){ ?>

					<tr>
						<td><?php echo $samba_account->getHostname(); ?></td>
					</tr>
					<?php } ?>
				</table>
			</fieldset>

			
			<fieldset><legend> Unix Accounts </legend> 
				<table>
					<tr>
						<th>Unix Host Name</th>
						<th>Unix Quota size</th>
					</tr>
					<?php foreach($user->getUnixAccounts() as $unix_account): ?>
						<tr>
							<td><?php echo $unix_account->getHostname(); ?></td>
							<td><?php echo $unix_account->getQuota(); ?></td>
						</tr>
					<?php endforeach; ?>
				</table>
			</fieldset>
		</div>
	</div>

		</div>
		<div id="sf_admin_footer">
		</div>
	</div>
<?php else: ?>
	<div class="loginError">
		<div class="alert alert-error">
			<a class="close" data-dismiss="alert">&times;</a>
				Your are <strong>not allowed </strong>to access this page. <strong>Only Administrator</strong> is allowed!
		</div>
	</div>
<?php endif; ?>

