// window.initMap = function() {
//     const map = new google.maps.Map(document.getElementById("map"), {
//         zoom: 14,
//         center: { lat: -34.397, lng: 150.644 },
//     });
//     const geocoder = new google.maps.Geocoder();
//     document.getElementById("submit").addEventListener("click", () => {
//         geocodeAddress(geocoder, map);
//     });
// }

function initMap() {
    debugger;
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 14,
        center: { lat: -34.397, lng: 150.644 },
    });
    const geocoder = new google.maps.Geocoder();
    document.getElementById("submitAddress").addEventListener("click", () => {
        geocodeAddress(geocoder, map);
    });
}

function geocodeAddress(geocoder, resultsMap) {
    const address = document.getElementById("address").value;
    geocoder.geocode({ address: address }, (results, status) => {
        if (status === "OK") {
            resultsMap.setCenter(results[0].geometry.location);
            new google.maps.Marker({
                map: resultsMap,
                position: results[0].geometry.location,
            });
        } else {
            alert("Geocode was not successful for the following reason: " + status);
        }
    });
}