$('document').ready(function(){
   

	$('#minimize').click(function(){
		
		//$('.userDetail-actions').toggle('slow');
		//$('.userInfo-Box').toggle('slow');

		if($('#minimize').hasClass('opened'))
		{
			$('.userLayer-info').slideUp('slow');
			$('#minimize').removeClass('opened');
			$('#minimize').addClass('closed');
		}
	else	{
			$('.userLayer-info').slideDown('slow');
			$('#minimize').removeClass('closed');
			$('#minimize').addClass('opened');
		}

		return false;
				
	});        
});
