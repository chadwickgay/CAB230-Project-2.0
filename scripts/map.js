/*
 * Name: map.js
 * Purpose: Contains the functions related to maps
 */

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