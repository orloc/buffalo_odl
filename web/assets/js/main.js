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
			$('#current-devices').fadeOut('slow', function(){ 
				$('#wanted-devices').fadeIn('slow');
				$('#device-label').text('Wish List');
				$('#switch-table').text('Switch to current Devices');
				
			});
		} else { 
			$('#wanted-devices').fadeOut('slow', function() { 
				$('#current-devices').fadeIn('slow');
				$('#device-label').text('Available Devices');
				$('#switch-table').text('Switch to our Wish List');
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


