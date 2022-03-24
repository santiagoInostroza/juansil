@extends('layouts.simple')
 <style>
        .table td {
            vertical-align: middle;
            text-align: center
        }

        #map {
           min-height: 450px;
           height: 100%;
        }

    </style>
@section('content')
    <div class="">
        @livewire('admin.deliveries.index', ['date' => $date])
    </div>
@endsection

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC30rciXdqyWlqQXQJYrwE3Qs220le3PvY&libraries=places">
</script>
<script src="https://unpkg.com/@googlemaps/markerclustererplus/dist/index.min.js"></script>
<script>
    //     // markerCluster = new MarkerClusterer(map, markers, {
    //     //     imagePath: "{{ Storage::url('clusteres/m') }}"
    //     // });
    // }
    // google.maps.event.addDomListener(window, "load", initMap);

    let svgMarkerCompletado = {
        path: "M10.453 14.016l6.563-6.609-1.406-1.406-5.156 5.203-2.063-2.109-1.406 1.406zM12 2.016q2.906 0 4.945 2.039t2.039 4.945q0 1.453-0.727 3.328t-1.758 3.516-2.039 3.070-1.711 2.273l-0.75 0.797q-0.281-0.328-0.75-0.867t-1.688-2.156-2.133-3.141-1.664-3.445-0.75-3.375q0-2.906 2.039-4.945t4.945-2.039z",
        fillColor: "blue",
        fillOpacity: 1,
        strokeWeight: 0,
        rotation: 0,
        scale: 1.3,
        anchor: new google.maps.Point(15, 30),
    };

    let svgMarkerEntregado = {
        path: "M10.453 14.016l6.563-6.609-1.406-1.406-5.156 5.203-2.063-2.109-1.406 1.406zM12 2.016q2.906 0 4.945 2.039t2.039 4.945q0 1.453-0.727 3.328t-1.758 3.516-2.039 3.070-1.711 2.273l-0.75 0.797q-0.281-0.328-0.75-0.867t-1.688-2.156-2.133-3.141-1.664-3.445-0.75-3.375q0-2.906 2.039-4.945t4.945-2.039z",
        fillColor: "purple",
        fillOpacity: 1,
        strokeWeight: 0,
        rotation: 0,
        scale: 1.3,
        anchor: new google.maps.Point(15, 30),
    };

    let svgMarkerPagado = {
        path: "M10.453 14.016l6.563-6.609-1.406-1.406-5.156 5.203-2.063-2.109-1.406 1.406zM12 2.016q2.906 0 4.945 2.039t2.039 4.945q0 1.453-0.727 3.328t-1.758 3.516-2.039 3.070-1.711 2.273l-0.75 0.797q-0.281-0.328-0.75-0.867t-1.688-2.156-2.133-3.141-1.664-3.445-0.75-3.375q0-2.906 2.039-4.945t4.945-2.039z",
        fillColor: "Lime",
        fillOpacity: 1,
        strokeWeight: 0,
        rotation: 0,
        scale: 1.3,
        anchor: new google.maps.Point(15, 30),
    };


    window.onload = function() {
        window.addEventListener('orderUpdate', event => {

            for (let i = 0; i < markers.length; i++) {
                const marker = markers[i];
                if (marker.identificador == event.detail.id) {

                    // console.log("identificador: ", marker.identificador);
                    // console.log('event.detail.id: ', event.detail.id);
                    // console.log('event.detail.delivery_stage: ', event.detail.delivery_stage);
                    // console.log('event.detail.payment_status: ', event.detail.payment_status);

                    marker.setAnimation(google.maps.Animation.BOUNCE);

                    // entregado con pago pendiente 
                    if(event.detail.delivery_stage == 1 && event.detail.payment_status != 3){
                        marker.setIcon(svgMarkerEntregado);
                        console.log('Entregado');
                    // Pagado con entrega pendiente 
                    }else if(event.detail.delivery_stage != 1 && event.detail.payment_status == 3){
                         marker.setIcon(svgMarkerPagado);
                         console.log('pagado');
                    }else if(event.detail.payment_status != 3){
                        marker.setIcon();
                    }else{
                        //completado
                        marker.setIcon(svgMarkerCompletado);
                        console.log('completado');
                    }
                }

            }
        })


        var infowindow;
        var locations = getLocations();
        var markers = [];



        function initialize() {
            var latlng = new google.maps.LatLng(41.652393, 1.691895);

            let santiago = {
                lat: -33.540,
                lng: -70.650
            };
            var mapOptions = {
                zoom: 11,
                center: santiago,
                // mapTypeId: google.maps.MapTypeId.ROADMAP,
            }
            var map = new google.maps.Map(document.getElementById('map'), mapOptions);
            setMarkers(map, locations);


            const locationButton = document.createElement("div");
            locationButton.textContent = "Ver ubicacion actual";
            locationButton.classList.add("p-3");
            locationButton.classList.add("rounded");
            locationButton.classList.add("text-white");
            locationButton.classList.add("text-lg");
            locationButton.classList.add("shadow");
            locationButton.classList.add("bg-gray-400");
            locationButton.classList.add("my-2");
            locationButton.classList.add("text-md");
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);


            locationButton.addEventListener("click", () => {

                let svgMarker2 = {
                    path: "M10.453 14.016l6.563-6.609-1.406-1.406-5.156 5.203-2.063-2.109-1.406 1.406zM12 2.016q2.906 0 4.945 2.039t2.039 4.945q0 1.453-0.727 3.328t-1.758 3.516-2.039 3.070-1.711 2.273l-0.75 0.797q-0.281-0.328-0.75-0.867t-1.688-2.156-2.133-3.141-1.664-3.445-0.75-3.375q0-2.906 2.039-4.945t4.945-2.039z",
                    fillColor: "black",
                    fillOpacity: 0.9,
                    strokeWeight: 2,
                    rotation: 0,
                    scale: 1,
                    anchor: new google.maps.Point(15, 30),
                };

                
               

                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition((position) => {
                            const pos = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude,
                            };
                       
                        new google.maps.Marker({
                                position: pos,
                                map: map,

                                // identificador: locations[i][1],
                                // title: locations[i][2],
                                icon: {
                                    path: google.maps.SymbolPath.CIRCLE,
                                    scale: 5,
                                },
                                animation: google.maps.Animation.DROP,
                            });
                            // infoWindow.setPosition(pos);
                            // infoWindow.setContent("estás aqui.");
                            // infoWindow.open(map);
                            map.setCenter(pos);
                        },
                        () => {
                            handleLocationError(true, infoWindow, map.getCenter());
                        }
                    );
                } else {
                    // Browser doesn't support Geolocation
                    handleLocationError(false, infoWindow, map.getCenter());
                }
            });


        }


        function setMarkers(map, locations) {
          
            for (var i = 0; i < locations.length; i++) {
                //var myLatLng = new google.maps.LatLng(marcadores[i][1], marcadores[i][2]);
                var marker = new google.maps.Marker({
                    position: locations[i][0],
                    map: map,
                    identificador: locations[i][1],
                    title: locations[i][2],
                    icon: locations[i][3],
                    animation: google.maps.Animation.DROP,
                });
                (function(i, marker) {

                    google.maps.event.addListener(marker, 'click', function() {
                       
                       
                        Livewire.emit('mostrar_venta', locations[i][1]);

                        if (!infowindow) {
                            infowindow = new google.maps.InfoWindow();
                        }
                        infowindow.setContent(linkDireccion(locations[i][2]));
                        infowindow.open(map, marker);
                    });
                })(i, marker);
                markers.push(marker)
            }

        };



        // Obtener y almacenar todas las coordenadas en locations
        function getLocations() {
            const locations = [];
            let latitudes = document.querySelectorAll(".latitud"); //$(".latitud");
            if (latitudes) {
                let longitudes = document.querySelectorAll(".longitud"); //$(".longitud");
                let id_venta = document.querySelectorAll(".id_venta"); //$(".id_venta");
                let direccion = document.querySelectorAll(".direccion"); //$(".id_venta");
                for (let i = 0; i < latitudes.length; i++) {
                    locations.push(
                        [
                            {
                                "lat": Number(latitudes[i].value),
                                "lng": Number(longitudes[i].value)
                            }, //0
                            id_venta[i].value, //1
                            direccion[i].value, //2
                            null,
                        ]
                    )
                }
            }

            //direcciones realizadas
            var latitudes2 = document.querySelectorAll(".latitud2"); //$(".latitud2");
            var longitudes2 = document.querySelectorAll(".longitud2"); // $(".longitud2");
            let id_venta2 = document.querySelectorAll(".id_venta2"); //$(".id_venta");
            let direccion2 = document.querySelectorAll(".direccion2"); //$(".id_venta");

            for (let index = 0; index < latitudes2.length; index++) {
                locations.push(
                    [{
                            "lat": Number(latitudes2[index].value),
                            "lng": Number(longitudes2[index].value)
                        }, //0
                        id_venta2[index].value, //1
                        direccion2[index].value, //2
                        svgMarkerCompletado, //3
                    ]
                )
            }

            //entregado con pago pendiente 

            var latitudes3 = document.querySelectorAll(".latitud3"); //$(".latitud2");
            if (latitudes3) {
                var longitudes3 = document.querySelectorAll(".longitud3"); // $(".longitud2");
                let id_venta3 = document.querySelectorAll(".id_venta3"); //$(".id_venta");
                let direccion3 = document.querySelectorAll(".direccion3"); //$(".id_venta");

                for (let index = 0; index < latitudes3.length; index++) {
                    locations.push(
                        [{
                                "lat": Number(latitudes3[index].value),
                                "lng": Number(longitudes3[index].value)
                            }, //0
                            id_venta3[index].value, //1
                            direccion3[index].value, //2
                            svgMarkerEntregado, //3
                        ]
                    )
                }
            }

            //  Pagado con entrega pendiente 
            var latitudes4 = document.querySelectorAll(".latitud4"); //$(".latitud2");
            if (latitudes4) {
                var longitudes4 = document.querySelectorAll(".longitud4"); // $(".longitud2");
                let id_venta4 = document.querySelectorAll(".id_venta4"); //$(".id_venta");
                let direccion4 = document.querySelectorAll(".direccion4"); //$(".id_venta");

                for (let index = 0; index < latitudes4.length; index++) {
                    locations.push(
                        [{
                                "lat": Number(latitudes4[index].value),
                                "lng": Number(longitudes4[index].value)
                            }, //0
                            id_venta4[index].value, //1
                            direccion4[index].value, //2
                            svgMarkerPagado, //3
                        ]
                    )
                }
            }
      

            return locations;
        }

        function linkDireccion(direccion) {
            return `<a href='https://www.google.cl/maps/place/${direccion}' style='padding:15px' target='_blank'>${direccion} </a>`;
        }

        initialize();
    }

</script>
<script>
    function cambiarFecha(fecha) {
        window.location.href = "{{ route('admin.deliveries.index') }}/" + fecha.value;
    }
</script>

