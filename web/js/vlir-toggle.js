$('document').ready(function(){
   

	$('#minimizeVlir').click(function(){
		
		//$('.userDetail-actions').toggle('slow');
		//$('.userInfo-Box').toggle('slow');

		if($('#minimizeVlir').hasClass('opened'))
		{
			$('.sf_admin_sideLogo-vlir-content').slideUp('slow');
			$('#minimizeVlir').removeClass('opened');
			$('#minimizeVlir').addClass('closed');
		}
	else	{
			$('.sf_admin_sideLogo-vlir-content').slideDown('slow');
			$('#minimizeVlir').removeClass('closed');
			$('#minimizeVlir').addClass('opened');
		}

		return false;
				
	});        
});
