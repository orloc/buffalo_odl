function initialize() {
	var latlang = new google.maps.LatLng(42.886216,-78.873259);
    var marker; 
    var map;

	var mapOptions = {
		zoom: 13,
		center: latlang,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};

	map = new google.maps.Map(
		document.getElementById("map-canvas"), 
		mapOptions
	);

	marker = new google.maps.Marker({
		map:map,
		postion:latlang,
        title: "Stop by and Visit!"
	});

    function toggleBounce() {
        if (marker.getAnimation() != null){ 
            market.setAnimation(null);
        } else { 
            marker.setAnimation(google.maps.Animation.BOUNCE);
        }
    }

    //google.maps.event.addListener(marker, 'click', toggleBounce);
}

google.maps.event.addDomListener(window, 'load', initialize);

