
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Administration System</title>
    <link rel="shortcut icon" href="/mu-logo.ico" />
	<?php use_stylesheet('main.css') ?>
   <?php include_javascripts() ?>
   <?php include_stylesheets() ?>

<script>
        $('document').ready(function(){
            $('#showProfile').click(function(){
				
				if($(".profileBox").hasClass('closed')){
	
					$(".profileBox").slideDown('fast');
					$(".profileBox").removeClass('closed');
					$(".profileBox").addClass('opened');
					$(this).parent().css('background', 'ivory');
					$(this).parent().css('color', 'black');
				}
				else {
					
					$(".profileBox").slideUp('fast');
					$(".profileBox").removeClass('opened');
					$(".profileBox").addClass('closed');
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
					<li><a href="<?php echo url_for('user/show?id='.$sf_user->getAttribute('uid')) ?>">Home</a></li><?php endif; ?>
					<li><a href="http://www.mu.edu.et">MU Site</a></li>
					<li><a href="https://mail.mu.edu.et">MU Mail</a></li>
				</ul>
			</div>
			
			<div class="profileNav">
				<ul>
					<li><a class="language" href="">Language</a>
						<ul class="langauge">							
							<li><a href="">Tigrigna</a></li>
							<li><a href="">Amharik</a></li>
							<li><a href="">English</a></li>
						</ul>					
					</li>
				<?php if($sf_user->isAuthenticated()): ?>
					<li><a id="showProfile" class="userProfile dropdown-toggle" href=""><img src="<?php echo image_path('contact');?>"><?php echo $sf_user->getAttribute('full_name') ?></a>
						<ul class="profileBox closed" id="">
							<li><a href=""><img src="<?php echo image_path('contact') ?>"></a></li>
							<li><a href="">haftom</a></li>
							<li><a href="">hagos</a></li>
						</ul>
					</li>
					<li><?php echo link_to('Logout', 'session/logout') ?></li>
					<?php endif; ?>
				</ul>
			</div>

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

			<div class="clearFix"></div>
		</div><!-- end of header -->
	</div><!-- end of header_container -->



	<div class="login-body">
		<?php echo $sf_data->getRaw('sf_content') ?>
	</div>
</body>
</html>


