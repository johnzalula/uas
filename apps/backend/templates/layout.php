
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Administration System</title>
    <link rel="shortcut icon" href="/mu-logo.ico" />
	<?php use_stylesheet('admin.css') ?>
   <?php include_javascripts() ?>
   <?php include_stylesheets() ?>

<script>
	$('document').ready(function(){
            $('#showLanguage').click(function(){
				
				if($(".languageList").hasClass('closed')){
	
					$(".languageList").slideDown('fast');
					$(".languageList").removeClass('closed');
					$(".languageList").addClass('opened');
					$(this).parent().css('background', 'ivory');
					$(this).parent().css('color', 'black');
	
				}
				else {
					
					$(".languageList").slideUp('fast');
					$(".languageList").removeClass('opened');
					$(".languageList").addClass('closed');
					$(this).parent().css('background', '#333');
				}

				return false;
			});
        });
        </script>
</head>
<body>

	<div class="topMenu-cont">
		<div class="topMenu">
			<div class="miniNav">
				<ul>
					<?php if($sf_user->isAuthenticated()): ?>
					<li><a href="<?php echo url_for('@user') ?>">Home</a></li><?php endif; ?>
					<li><a href="http://www.mu.edu.et">MU Site</a></li>
					<li><a href="https://mail.mu.edu.et">MU Mail</a></li>
				</ul>
			</div>
			
<?php if($sf_user->isAuthenticated()): ?>
			<div class="profileNav">
				<ul>
					<li><a id="showLanguage" class="userLanguage" href="">Language</a>
						<ul class="languageList closed">	
							<li><?php echo link_to('English', 'session/en') ?> </li> 
							<li><?php echo link_to('Tigrigna', 'session/tig') ?></li>  
							<li><?php echo link_to('Amharic', 'session/am') ?></li>	
						</ul>					
					</li>
					<li><a id="showProfile" class="userProfile dropdown-toggle" href=""><img src="<?php echo image_path('contact');?>"><?php echo $sf_user->getAttribute('username') ?></a>
						<ul class="profileBox closed" id="">
							<li><a href=""><img src="<?php echo image_path('contact') ?>"></a></li>
							<li><a href="">haftom</a></li>
							<li><a href="">hagos</a></li>
						</ul>
					</li>
					<li><?php echo link_to('Logout', '@sf_guard_signout') ?></li>
				</ul>
			</div>
<?php endif; ?>
			<div class="clearFix"></div>
		</div>
	</div>

	<div class="topSeparator"></div>

	<div class="header_container">
		<div class="header">
			<div class="logo-box">
				<div class="logo">
					<div><img src="<?php echo image_path('mu-logo');?>" height="40" width="40"></div>
					<span class="title">Mekelle University</span><br>
					<span class="sub-title ">User Administration System (UAS)</span>
				</div><!-- end of logo -->
			</div><!-- end of logo-box -->
			<?php if($sf_user->isAuthenticated()): ?>
			<div class="user-profile-cont">
				<div class="userBox">
					<div class="userAvatar">
						<img src="<?php echo image_path('avatar') ?> ">
					</div>
					<div class="userDetail">
						<ul>
							<li><?php echo link_to('Logout', '@sf_guard_signout') ?></li>
						</ul>
					</div>

					<div class="clearFix"></div>			

				</div>
			</div>
		<?php endif; ?>
			<div class="clearFix"></div>
		</div><!-- end of header -->
	</div><!-- end of header_container -->


	<div class="wrapperBox">
		<div class="wrapper">
<?php if($sf_user->isAuthenticated()): ?>
			<div class="left-container">
				<div class="leftBar">
					<ul class="accordion">
			
			<li id="one" class="files">

				<a href="#one">User Administration<span><img src="<?php echo image_path('downarr') ?> "></span></a>

				<ul class="sub-menu">
					<li ><?php echo link_to('Users', '@user') ?></li>
					<li><?php echo link_to('User Identifications', '@user_identification') ?></li>
					<li><?php echo link_to('Groups', '@sf_guard_group') ?></li>
					<li><?php echo link_to('Permissions', '@sf_guard_permission') ?></li>
				</ul>

			</li>
			
			<li id="two" class="mail">

				<a href="#two">Mail Configuration<span><img src="<?php echo image_path('downarr') ?> "></span></a>

				<ul class="sub-menu">
					<li><?php echo link_to('Aliases', '@email_alias') ?></li>
					<li><?php echo link_to('Domains', '@domainname') ?></li>
					<li><?php echo link_to('Unix', '@unix_account') ?></li>
					<li><?php echo link_to('FTP', '@ftp_account') ?></li>
					<li><?php echo link_to('Samba', '@samba_account') ?></li>
				</ul>

			</li>
			</li>
			
		</ul>
		</div>
			<div class="sf_admin_sideLogo">
				<h3>Sponsored By</h3>
				<div class="sf_admin_sideLogo-content">
					<img class="vlir" src="<?php echo image_path('vliruos') ?>">
				</div>
			</div>
			<div class="sf_admin_sideLogo">
				<h3>Powerd By</h3>
				<div class="sf_admin_sideLogo-content">
					<img class="symfony" src="<?php echo image_path('symfony_button') ?> " width="80" height="24">
				</div>
			</div>
		
	</div>
<?php endif; ?>
			<div class="content-container">
				<div class="content">
					<?php echo $sf_content ?>
				</div>
			</div>

			<div class="clearFix"></div>
		</div>
	</div>

	
</body>
</html>


