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

    document.getElementById("distance-block").style.display = 'inline';
    document.getElementById("distance").style.display = 'inline';
    document.getElementById("get-location").style.display = 'none';
}

function showPosition(position) {
    x.innerHTML = "Latitude: " + position.coords.latitude + "<br>Longitude: " + position.coords.longitude;
}

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
    var marker, i, contentString;

    for (i = 0; i < locations.length; i++) {
        contentString = '<a href="park.php?ParkCode=' + locations[i][0].toString() + '">' + locations[i][1].toString() + '</a>';
        console.log(contentString);

        marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][2], locations[i][3]),
            map: map
        });

        google.maps.event.addListener(marker, 'click', (function (marker, i) {
            return function () {
                infowindow.setContent('<a href="park.php?ParkCode=' + locations[i][0].toString() + '">' + locations[i][1].toString() + '</a>');
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
