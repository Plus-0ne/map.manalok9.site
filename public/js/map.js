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



        $.ajax({
            type: 'GET',
            url: window.urlBase + '/get',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                const res = response;
                console.log(res);
                if (res.status !== undefined && res.status == 'success') {

                    if (res.markers !== undefined && res.markers.length > 0) {
                        const markers = res.markers;
                        $.each(markers, function (mI, mVal) {

                            let newIcon = L.icon({
                                iconUrl: window.urlBase + '/img/marker-icon-violet.png',
                                iconSize: [20, 35]
                                });

                            L.marker([mVal.latitude, mVal.longitude],{
                                icon: newIcon
                            }).addTo(map).on('click',function (ev) {
                                $('#view360image').modal('toggle');
                                setTimeout(() => {
                                    pannellumShow();
                                }, 300);
                            });

                        });
                    }
                    
                }
            }
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

    /**
     * Submit new marker details
     * @param {any} '#submitNewMarker'
     * @returns {any}
     */
    $('#submitNewMarker').on('click', function () {
        const fd = new FormData();

        fd.append('latitude' , $('#latitude').val());
        fd.append('longitude' , $('#longitude').val());
        fd.append('location' , $('#location').val());
        fd.append('description' , $('#description').val());
        fd.append('file_image' , $('#file_image')[0].files[0]);

        $.ajax({
            type: 'POST',
            url: window.urlBase + '/admin/marker/create',
            data: fd,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                const res = response;

                console.log(res);

            }
        });
    });

    /**
     * File image on change
     * @param {any} '#file_image'
     * @returns {any}
     */
    // $('#file_image').on('change', function () {
    //     $.ajax({
    //         xhr: function() {
    //             var xhr = new window.XMLHttpRequest();
    //             xhr.upload.addEventListener("progress", function(evt) {
    //                 if (evt.lengthComputable) {
    //                     var percentComplete = (evt.loaded / evt.total) * 100;
    //                     //Do something with upload progress here
    //                 }
    //            }, false);
    //            return xhr;
    //         },
    //         type: "method",
    //         url: "url",
    //         data: "data",
    //         dataType: "dataType",
    //         success: function (response) {

    //         }
    //     });
    // });
});
