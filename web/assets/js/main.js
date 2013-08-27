$(document).ready(function(){
	$('#b2top').hide();
	$('#wanted-devices').hide();

	$('#wanted-head').hide();

	$('span.link-over').each(function() {
		$(this).hide();
	});

    $('div#mouse-overs span').each(function(){
        $(this).hide();
    });
    $('div#mouse-overs').hide();
    $('#nav a').each(function(){
        var id = $(this).attr('id');
        $(this).mouseover(function(){
            navMouseOver('show', id);
        }).mouseout(function(){ 
            navMouseOver('hide', id);
        });

    });

	$('div#device-list a').click(function() { 
		if ($('#wanted-devices').is(':hidden')){
			$('#current-devices').fadeOut('fast', function(){ 
				$('#device-label').text('Wish List');
                $('#switch-table').text('Switch to Available Devices');
				$('#current-head').fadeOut('fast', function () { 
					$('#wanted-head').fadeIn('slow');
					$('#wanted-devices').fadeIn('slow');
				});
				
			});
		} else { 
			$('#wanted-devices').fadeOut('fast', function(){ 
				$('#device-label').text('Available Devices');

                $('#switch-table').text('Switch to our Wish List');
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

function navMouseOver(dir, id){
    $('div#mouse-overs').find('span').each(function(){
        var labId = id+'Lab';
        if ($(this).attr('id') == labId) { 
            console.log($(this).attr('id'),labId, dir);
            if (dir == 'show') { 
                $(this).show();    
                $('div#mouse-overs').show();
            } 
            if (dir == 'hide') { 
                $(this).hide();    
                $('div#mouse-overs').hide();
            }
        }
    });
}


