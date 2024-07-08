$(function() {
    function loadMap() {
        // Leaflet map initialization
        let map = L.map("map", {
            center: [51.505, -0.09],
            zoom: 3,
            scrollWheelZoom: true,
            minZoom: 3,
        });

        // Map on click event
        if (isAuthenticated == true) {
            map.on('click',function (ev) {
                let latlng = map.mouseEventToLatLng(ev.originalEvent);
                console.log(latlng.lat + ", " + latlng.lng);

                const btnNewMarker = $('#checkboxNewMarker');

                if (btnNewMarker.prop('checked') == true) {
                    // alert(`Latitude =${latlng.lat}  and longitude =${latlng.lng}`);
                    $('#modalNewMarker').modal('toggle');

                    $('#latitude').val(latlng.lat);
                    $('#longitude').val(latlng.lng);
                }
            }); // Centered on world map (adjust as needed)

        }


        // Define image bounds
        let imageUrl = window.assetUrl + "img/DJI_0031.jpg"; // Adjust to your local image URL
        let imageBounds = [
            [-90, -180],
            [90, 180],
        ]; // Coordinates for the image bounds

        // Add the image overlay to the map
        L.imageOverlay(imageUrl, imageBounds).addTo(map);

        
        let marker = L.marker([54.5, -56]).addTo(map).on('click',function (ev) {
            $('#view360image').modal('toggle');
            setTimeout(() => {
                pannellumShow();
            }, 300);
        });

    }

    // Load map
    loadMap();

    /**
     * Initiate 360 image
     * @returns {any}
     */
    function pannellumShow() {
        pannellum.viewer('panorama', {
            "type": "equirectangular",
            "panorama": window.assetUrl + 'img/360-images/DJI_0062.JPG',
            "autoLoad": true
        });
    }
});
