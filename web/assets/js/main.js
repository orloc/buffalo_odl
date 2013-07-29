$(document).ready(function(){
	$('#b2top').hide();
	$('#wanted-devices').hide();

	$('#wanted-head').hide();

	$('span.link-over').each(function() {
		$(this).hide();
	});

	$('#navigation div a').each(function(){
		$(this).hover(
			function(){
				$(this).find('img').hide().closest('a').find('.link-over').show();
			},
			function(){
				$(this).find('.link-over').hide().closest('a').find('img').show();
			}
		);
	});

	$('div#device-list a').click(function() { 
		if ($('#wanted-devices').is(':hidden')){
			$('#current-devices').fadeOut('fast', function(){ 
				$('#device-label').text('Wish List');
				$('#current-head').fadeOut('fast', function () { 
					$('#wanted-head').fadeIn('slow');
					$('#wanted-devices').fadeIn('slow');
				});
				
			});
		} else { 
			$('#wanted-devices').fadeOut('fast', function(){ 
				$('#device-label').text('Available Devices');
				$('#wanted-head').fadeOut('fast', function () { 
					$('#current-head').fadeIn('slow');
					$('#current-devices').fadeIn('slow');
				});
			});
		}
	});



	$(window).scroll(function () { 
		var div = $('#breadcrumbs');
		if ($(this).scrollTop() != 0 ) {
			if (!(div.hasClass('navbar-fixed-top'))){
				$('#b2top').show();
				div.addClass('navbar-fixed-top');
			}	
		} else if ( div.hasClass('navbar-fixed-top')) {

			$('#b2top').hide();
			div.removeClass('navbar-fixed-top');
		}
	});
});


