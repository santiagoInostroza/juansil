@extends('adminlte::page')

@section('title', 'Precios de feria')

@section('content_header')
@stop

@section('css')
    <style>
        .table td {
            vertical-align: middle;
            text-align: center
        }

        #map {
            height: 400px;
        }

    </style>
@stop

@section('content')
    <div class="container">
        {{-- <div class="float-right">
            <a href="{{ route('admin.deliveries.create') }}" class="btn btn-secondary"> Agregar Delivery</a>
        </div> --}}
        <livewire:deliveries.index :fecha='$fecha'>
    </div>
@stop
@section('js')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC30rciXdqyWlqQXQJYrwE3Qs220le3PvY&libraries=places">
    </script>
    <script src="https://unpkg.com/@googlemaps/markerclustererplus/dist/index.min.js"></script>
    <script>
        //     // markerCluster = new MarkerClusterer(map, markers, {
        //     //     imagePath: "{{ Storage::url('clusteres/m') }}"
        //     // });
        // }
        // google.maps.event.addDomListener(window, "load", initMap);

        let svgMarker = {
            path: "M10.453 14.016l6.563-6.609-1.406-1.406-5.156 5.203-2.063-2.109-1.406 1.406zM12 2.016q2.906 0 4.945 2.039t2.039 4.945q0 1.453-0.727 3.328t-1.758 3.516-2.039 3.070-1.711 2.273l-0.75 0.797q-0.281-0.328-0.75-0.867t-1.688-2.156-2.133-3.141-1.664-3.445-0.75-3.375q0-2.906 2.039-4.945t4.945-2.039z",
            fillColor: "blue",
            fillOpacity: 0.9,
            strokeWeight: 0,
            rotation: 0,
            scale: 1,
            anchor: new google.maps.Point(15, 30),
        };

        window.onload = function() {
            window.addEventListener('name-updated', event => {

                for (let i = 0; i < markers.length; i++) {
                    const marker = markers[i];
                    console.log("identificador: ", marker.identificador);
                    console.log('event.detail.id: ', event.detail.id);
                    if (marker.identificador == event.detail.id) {

                        marker.setAnimation(google.maps.Animation.BOUNCE);
                        marker.setIcon(svgMarker);
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


                const locationButton = document.createElement("button");
                locationButton.textContent = "Ver ubicacion actual";
                locationButton.classList.add("p-2");
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
                        anchor: new google.maps.Point(30, 5),
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

                                    //identificador: locations[i][1],
                                    //title: locations[i][2],
                                    icon: {
                                        path: google.maps.SymbolPath.CIRCLE,
                                        scale: 5,
                                    },
                                    animation: google.maps.Animation.DROP,
                                });
                                //infoWindow.setPosition(pos);
                                //infoWindow.setContent("estás aqui.");
                                //infoWindow.open(map);
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

            function getLocations() {
                const locations = [];
                let latitudes = document.querySelectorAll(".latitud"); //$(".latitud");
                if (latitudes) {
                    let longitudes = document.querySelectorAll(".longitud"); //$(".longitud");
                    let id_venta = document.querySelectorAll(".id_venta"); //$(".id_venta");
                    let direccion = document.querySelectorAll(".direccion"); //$(".id_venta");
                    for (let index = 0; index < latitudes.length; index++) {
                        locations.push(
                            [{
                                    "lat": Number(latitudes[index].value),
                                    "lng": Number(longitudes[index].value)
                                }, //0
                                id_venta[index].value, //1
                                direccion[index].value //2
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
                            svgMarker, //3
                        ]
                    )
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


@stop
