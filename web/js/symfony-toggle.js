$('document').ready(function(){
   

	$('#minimizeSymf').click(function(){
		
		//$('.userDetail-actions').toggle('slow');
		//$('.userInfo-Box').toggle('slow');

		if($('#minimizeSymf').hasClass('opened'))
		{
			$('.sf_admin_sideLogo-symf-content').slideUp('slow');
			$('#minimizeSymf').removeClass('opened');
			$('#minimizeSymf').addClass('closed');
		}
	else	{
			$('.sf_admin_sideLogo-symf-content').slideDown('slow');
			$('#minimizeSymf').removeClass('closed');
			$('#minimizeSymf').addClass('opened');
		}

		return false;
				
	});        
});
