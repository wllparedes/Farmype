$(document).ready(() => {
    let latitude = -12.046373;
    let longitude = -77.042754;
    let inputLatitude = document.getElementById("latitude");
    let inputLongitude = document.getElementById("longitude");

    const getLocation = () => {
        return new Promise((resolve, reject) => {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    resolve([
                        position.coords.latitude,
                        position.coords.longitude,
                    ]);
                }, reject);
            } else {
                reject("Geolocation not supported");
            }
        });
    };

    getLocation()
        .then((coordinates) => {
            let [lat, lon] = coordinates;

            latitude = lat;
            longitude = lon;
        })
        .then(() => {
            assignMap();
        })
        .catch((error) => {
            assignMap();
        });

    function assignMap() {
        latitude = inputLatitude.value ? inputLatitude.value : latitude;
        longitude = inputLongitude.value ? inputLongitude.value : longitude;
        //
        inputLatitude.value = latitude;
        inputLongitude.value = longitude;

        let myLatlng = {
            lat: parseFloat(latitude),
            lng: parseFloat(longitude),
        };

        let map = new google.maps.Map(document.getElementById("map"), {
            zoom: 13,
            center: myLatlng,
        });

        let marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            draggable: true,
        });

        google.maps.event.addListener(marker, "dragend", function (evt) {
            inputLatitude.value = evt.latLng.lat();
            inputLongitude.value = evt.latLng.lng();
        });
    }
});
