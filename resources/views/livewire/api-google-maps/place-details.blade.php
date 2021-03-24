<div>

    <style>
        #map {
            height: 500px
        }

        /* Optional: Makes the sample page fill the window. */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

    </style>

<h2 class="text-2xl text-gray-500 font-bold mt-10">Relleno de formulario</h2>
<div class="bg-gray 200 rounded-md shadow p-3">

    <div id="map"></div>

</div>

    <script>
        // This example requires the Places library. Include the libraries=places
        // parameter when you first load the API. For example:
        // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
        initMap()

        function initMap() {
            const map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: -33.866,
                    lng: 151.196
                },
                zoom:1,
            });
            const request = {
                placeId: "ChIJ-c9BKpvQYpYRwbYmT6APU7M",
                fields: ["name", "formatted_address", "place_id", "geometry"],
            };
            const infowindow = new google.maps.InfoWindow();
            const service = new google.maps.places.PlacesService(map);
            service.getDetails(request, (place, status) => {
                if (
                    status === google.maps.places.PlacesServiceStatus.OK &&
                    place &&
                    place.geometry &&
                    place.geometry.location
                ) {
                    const marker = new google.maps.Marker({
                        map,
                        position: place.geometry.location,
                    });
                    google.maps.event.addListener(marker, "click", function() {
                        infowindow.setContent(
                            "<div><strong>" +
                            place.name +
                            "</strong><br>" +
                            "Place ID: " +
                            place.place_id +
                            "<br>" +
                            place.formatted_address +
                            "</div>"
                        );
                        infowindow.open(map, this);
                    });
                }
            });
        }

    </script>



</div>
