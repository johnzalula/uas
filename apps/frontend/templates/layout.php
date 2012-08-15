
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MU - User Administration System</title>
    <link rel="shortcut icon" href="/mu-logo.ico" />
	<?php use_stylesheet('main.css') ?>
   <?php include_javascripts() ?>
   <?php include_stylesheets() ?>

<style>
		.caret {height:7px;}
		.showMenu {width:100px;top:26px;position:absolute;display:none;border:1px solid #f00;}
		ul.user-cont {list-style:none;background:indianred;width:100px;text-align:left;margin:0px;color:#000;}
		ul.user-cont li {color:black;display:block;text-align:left;padding:3px;}
		ul.user-cont li a {color:#000;}
		ul.user-cont li a:hover {text-decoration:none;}
	</style>

<script>
        $('document').ready(function(){
         /*   $('#showProfile').click(function(){
				
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
			});*/

           $('#showLanguage').click(function(){
				
					//$('.showMenu').show();
				if($(".languageList").hasClass('closed')){
	
					$(".languageList").slideDown('fast');
					$(".languageList").removeClass('closed');
					$(".languageList").addClass('opened');
					$('.languageList li a').css('color', 'dodgerblue');
					$('.languageList li a:hover').css('color', 'red');
					$(this).parent().css('background', 'LightGoldenRodYellow ');
					$(this).parent().css('color', '#f00');
	
				}
				else {
					
					$(".languageList").slideUp('fast');
					$(".languageList").removeClass('opened');
					$(".languageList").addClass('closed');
					$(this).parent().css('background', '#333');
				}

				return false;
			});

			$('#down').click(function(){
					$('.showMenu').toggle();
				
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
				<?php if($sf_user->isAuthenticated()): ?>
				<ul>
					<li><a id="showLanguage" class="userLanguage" href="">Language</a>
						<ul class="languageList closed">	
							<li><a href="">English</a></li> 
							<li><a href="">Tigrigna</a></li>  
							<li><a href="">Amharic</a></li>	
						</ul>					
					</li>				
					</li>
				
					<li><a id="showProfile" class="userProfile" href=""><img src="<?php echo image_path('contact');?>"><?php echo $sf_user->getAttribute('full_name') ?></a>
						<ul class="profileBox closed" id="">
							<li><a href=""><img src="<?php echo image_path('contact') ?>"></a></li>
							<li><a href="">haftom</a></li>
							<li><a href="">hagos</a></li>
						</ul>
					</li>
					<li><?php echo link_to('Logout', '@logout') ?></li>
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

			<div class="user-profile">
				<div class="profileBox">
						
				</div>
			</div>
			
			<div class="clearFix"></div>
		</div><!-- end of header -->
	</div><!-- end of header_container -->



	<div class="wrapperBox">
		<div class="wrapper">
			<?php if($sf_user->isAuthenticated()): ?>
			<div class="userBox-container">	
				<div class="userProfile-cont">
					<div class="userAvatar">
						<img src="<?php echo image_path('avatar') ?>">
					</div>
					<div class="userProfile-detail">
						<div class="userDetail">
							<ul>
								<li><span class="user_name"><?php echo $sf_user->getAttribute('full_name') ?></span></li>
								<li><span class="user_text">Login:</span><span class="result_text"><?php echo $sf_user->getAttribute('login_name') ?></span></li>
								<li><span class="user_text">Email:</span><span class="result_text"><?php echo $sf_user->getAttribute('email_address') ?></span></li>
							</ul>
						</div>
					</div>
					<div class="editUser-profile">
						<div class="rightPane">
						<div class="btn-group">
							 <a class="btn" href="#"><i class="icon-user icon-white"></i> User Profile</a>
							 <a class="btn" id="down" href="#"><span class="caret"></span></a>
							
							<div class="showMenu">
							 <ul class="user-menu-cont">
								<li><a href="#"><i class="icon-pencil"></i> Edit</a></li>
								<li><a href="#"><i class="icon-trash"></i> Change Passowrd</a></li>
								<li><a href="<?php echo url_for('identification/index') ?>"><i class="icon-ban-circle"></i> User ID</a></li>
				 			</ul>
							</div>
						  </div>
					</div>
					<!-- ************************* -->
					</div>

					<div class="clearFix"></div>

				</div>
			</div>
		<?php endif; ?>
			<?php echo $sf_content ?>
		</div>
	</div>
</body>
</html>

