$(document).ready(function(){
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

	$(window).scroll(function () { 
		var div = $('#breadcrumbs');
		if ($(this).scrollTop() != 0 ) {
			if (!(div.hasClass('navbar-fixed-top'))){
				div.addClass('navbar-fixed-top');
			}	
		} else if ( div.hasClass('navbar-fixed-top')) {
			div.removeClass('navbar-fixed-top');
		}
	});
});


