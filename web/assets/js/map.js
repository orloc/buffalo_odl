function initialize() {
  var mapOptions = {
    zoom: 13,
    center: new google.maps.LatLng(42.886216,-78.873259),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
}

google.maps.event.addDomListener(window, 'load', initialize);

