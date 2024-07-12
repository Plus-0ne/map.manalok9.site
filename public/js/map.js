$(function() {
    let originalPosition = null;

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
            map.on("click", function (ev) {
                let latlng = map.mouseEventToLatLng(ev.originalEvent);
                console.log(latlng.lat + ", " + latlng.lng);

                const btnNewMarker = $("#checkboxNewMarker");

                if (btnNewMarker.prop("checked") == true) {
                    // alert(`Latitude =${latlng.lat}  and longitude =${latlng.lng}`);
                    $("#modalNewMarker").modal("toggle");

                    $("#latitude").val(latlng.lat);
                    $("#longitude").val(latlng.lng);
                }
            }); // Centered on world map (adjust as needed)
        }

        // Define image bounds
        let imageUrl = window.assetUrl + "img/DJI_0107.jpg"; // Adjust to your local image URL
        let imageBounds = [
            [-90, -180],
            [90, 180],
        ]; // Coordinates for the image bounds

        // Add the image overlay to the map
        L.imageOverlay(imageUrl, imageBounds).addTo(map);

        $.ajax({
            type: "GET",
            url: window.urlBase + "/get",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                const res = response;

                if (res.status !== undefined && res.status == "success") {
                    if (res.markers !== undefined && res.markers.length > 0) {
                        const markers = res.markers;
                        $.each(markers, function (mI, mVal) {
                            let newIcon = L.icon({
                                iconUrl:
                                    window.urlBase +
                                    "/img/marker-icon-violet.png",
                                iconSize: [20, 35],
                            });

                            let image360 =
                                mVal.marker_attachment.path === undefined
                                    ? null
                                    : mVal.marker_attachment.path;

                            let marker = L.marker(
                                [mVal.latitude, mVal.longitude],
                                {
                                    icon: newIcon,
                                    draggable:
                                        isAuthenticated == true ?? "true",
                                }
                            );
                            marker.addTo(map);

                            marker.on("click", function (ev) {
                                console.log(ev.target.getLatLng());
                                if (image360 != null) {
                                    $("#view360image").modal("toggle");
                                    setTimeout(() => {
                                        pannellumShow(image360);
                                    }, 300);
                                }
                            });

                            marker.on("contextmenu", function (e) {
                                if (isAuthenticated == true) {
                                    contextMenuNew(e, mVal);
                                }
                            });

                            // On drag update marker location if admin is authenticated
                            if (isAuthenticated == true) {
                                marker.on("dragend", function (e) {

                                    originalPosition = {
                                        lat:mVal.latitude,
                                        lng:mVal.longitude
                                    };
                                    
                                    console.log(originalPosition);
                                    console.log(e.target.getLatLng());

                                    // return;
                                    updateMarkerPosition(map,marker,originalPosition);
                                });
                            }
                        });
                    }
                }
            },
        });

        // getLocation(map);
    }

    // Load map
    loadMap();

    /**
     * Initiate 360 image
     * @returns {any}
     */
    function pannellumShow(image360) {
        pannellum.viewer("panorama", {
            type: "equirectangular",
            panorama: window.assetUrl + image360,
            autoLoad: true,
        });
    }

    /**
     * Submit new marker details
     * @param {any} '#submitNewMarker'
     * @returns {any}
     */
    $("#submitNewMarker").on("click", function () {
        const fd = new FormData();

        fd.append("latitude", $("#latitude").val());
        fd.append("longitude", $("#longitude").val());
        fd.append("location", $("#location").val());
        fd.append("description", $("#description").val());
        fd.append("file_image", $("#file_image")[0].files[0]);

        $.ajax({
            type: "POST",
            url: window.urlBase + "/admin/marker/create",
            data: fd,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                const res = response;

                console.log(res);

                if (res.status == "success") {
                    window.location.reload();
                }
            },
        });
    });

    function updateMarkerPosition(map,marker,originalPosition) {
        let swalText = "Do you want to move this marker ?";
        let swalIcon = "info";
        let confirmBtnText = "Move";
        let cancelBtnText = "Cancel";
        swalConfirmation(
            swalText,
            swalIcon,
            confirmBtnText,
            cancelBtnText
        ).then((result) => {
            if (result.isDismissed) {
                // Restore the marker to its original position if move is cancelled
                marker.setLatLng(originalPosition);
                console.log(originalPosition);

                // Optional: center the map on the marker
                // map.setView(originalPosition);
            }
        });
    }
    /**
     * Clear modal 360 image
     * @param {any} '#view360image'
     * @returns {any}
     */
    $("#view360image").on("hidden.bs.modal", function () {
        $("#panorama").html("");
    });

    function contextMenuNew(e, data) {
        let left = e.originalEvent.clientX + "px";
        let top = e.originalEvent.clientY + "px";

        let div = $("#customContextMenu");

        div.css("display", "flex");
        div.css("left", left);
        div.css("top", top);

        let updateMarker = $("#updateMarker");
        let deleteMarker = $("#deleteMarker");

        updateMarker.attr("data-uuid", data.uuid);
        deleteMarker.attr("data-uuid", data.uuid);
    }

    $(document).on("click", function () {
        $("#customContextMenu").css("display", "none");
    });

    $(document).on("click", "#deleteMarker", function () {
        const uuid = $(this).attr("data-uuid");

        alert(uuid);
    });

    $(document).on("click", "#updateMarker", function () {
        const uuid = $(this).attr("data-uuid");

        alert(uuid);
    });

    function swalConfirmation(
        swalText,
        swalIcon,
        confirmBtnText,
        cancelBtnText
    ) {
        return Swal.fire({
            icon: swalIcon,
            text: swalText,
            confirmButtonText: confirmBtnText,
            cancelButtonText: cancelBtnText,
            showCancelButton: true,
            heightAuto: false,
        });
    }

    // function getLocation(map) {
    //     map.getBounds();

    //     console.log(map.getBounds());
    //     return;

    // }

    // // Assuming the geolocation coordinates and image layout dimensions are known
    // const latMin = -88.93528839878971; // latitude of the bottom-left corner
    // const lonMin = -174.55078125000003; // longitude of the bottom-left corner
    // const latMax = 89.87021672382015; // latitude of the top-right corner
    // const lonMax = 174.19921875000003; // longitude of the top-right corner

    // const imageWidth = 4000; // width of the image layout
    // const imageHeight = 3000; // height of the image layout

    // // Function to convert geolocation to image layout coordinates
    // function geolocationToImageCoords(lat, lon) {
    //     const scaleX = imageWidth / (lonMax - lonMin);
    //     const scaleY = imageHeight / (latMax - latMin);

    //     const x = (lon - lonMin) * scaleX - imageWidth / 2;
    //     const y = (lat - latMin) * scaleY - imageHeight / 2;

    //     return { x, y };
    // }

    // // Example usage with user's geolocation coordinates
    // navigator.geolocation.getCurrentPosition((position) => {
    //     const userLat = position.coords.latitude;
    //     const userLon = position.coords.longitude;

    //     const imageCoords = geolocationToImageCoords(userLat, userLon);
    //     console.log(userLat);
    //     console.log(userLon);
    //     console.log(imageCoords); // { x: ..., y: ... }
    // });
});
