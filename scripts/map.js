/*
 * Name: map.js
 * Purpose: Contains the functions related to maps
 */
 function getLocation() {
     if (navigator.geolocation) {
         navigator.geolocation.getCurrentPosition(redirectToForm);
     } else {
         x.innerHTML = "Geolocation is not supported by this browser.";
     }
 }

 function redirectToForm(position) {
    document.getElementById('lat').value = position.coords.latitude;
    document.getElementById('long').value = position.coords.longitude;

    document.getElementById("distance").disabled = false;
 }

function showPosition(position) {
	x.innerHTML = "Latitude: " + position.coords.latitude + "<br>Longitude: " + position.coords.longitude;
}

var dummyLocations = [
	['Bondi Beach', -33.890542, 151.274856, 4],
	['Coogee Beach', -33.923036, 151.259052, 5],
	['Cronulla Beach', -34.028249, 151.157507, 3],
	['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
	['Maroubra Beach', -33.950198, 151.259302, 1]
];

function centreMap(locations) {
    var latAvg = 0;
    var lonAvg = 0;
    var latLonCentre;
    
    for (i = 0; i < locations.length; i++) {
        latAvg = latAvg + parseFloat(locations[i]['Latitude']);
        lonAvg = lonAvg + parseFloat(locations[i]['Longitude']);
    }
    
    latAvg = latAvg / locations.length;
    lonAvg = lonAvg / locations.length;
    
    latLonCentre = [latAvg, lonAvg];
    
    return latLonCentre;
}

function initResultsMap(locations) {
    var centredMarkers = centreMap(locations);
    
	var map = new google.maps.Map(document.getElementById('results-map'), {
		zoom: 13,
		center: new google.maps.LatLng(centredMarkers[0], centredMarkers[1]),
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});

	var infowindow = new google.maps.InfoWindow();

	var marker, i;

	for (i = 0; i < locations.length; i++) {
		marker = new google.maps.Marker({
			position: new google.maps.LatLng(locations[i][1], locations[i][2]),
			map: map
		});

		google.maps.event.addListener(marker, 'click', (function (marker, i) {
			return function () {
				infowindow.setContent(locations[i][0]);
				infowindow.open(map, marker);
			}
		})(marker, i));
	}
}

function initMap(lati, long) {
    var location = {
        lat: lati,
        lng: long
    };
    var map = new google.maps.Map(document.getElementById('park-map'), {
        zoom: 14,
        center: location
    });
    var marker = new google.maps.Marker({
        position: location,
        map: map
    });
}
