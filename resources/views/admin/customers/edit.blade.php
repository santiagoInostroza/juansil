@extends('adminlte::page')

@section('title', 'Precios de feria')

@section('content_header')
<div class="container d-flex " style="justify-content: space-between">
    <h1>Editar Cliente</h1>
    <div class="btn btn-primary "><a class='text-white' href="{{route('admin.sales.create')}}/{{$cliente->id}}">Ir a venta</a></div>
</div>
   
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>
                {{ session('info') }}
            </strong>
        </div>
    @endif

    <div class="card container">
        <div class="card-body">
            {!! Form::model($cliente, ['route' => ['admin.customers.update', $cliente], 'files' => 'true', 'method' => 'put', 'id' =>'form']) !!}
            @include('admin.customers.partials.form')
           
            {{-- {!! Form::submit('Crear Cliente', ['class' => 'btn btn-primary btn-block']) !!} --}}
         <div class="btn btn-primary btn-block" onclick="$('#form').submit()">Actualizar Cliente</div>

            {!! Form::close() !!}
        </div>
    </div>

    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC30rciXdqyWlqQXQJYrwE3Qs220le3PvY&libraries=places">
    </script>

    <script>
        google.maps.event.addDomListener(window, "load", function() {
            const santiago = { //coordenadas de la ciudad santiago
                lat: -33.4577756,
                lng: -70.6504502
            }
            const map = new google.maps.Map(document.getElementById("map"), {
                center: santiago,
                zoom: 10,
            });
            const input = document.getElementById("direccion");

            //RESTRINGIR BUSQUEDA A 10 KM DE SANTIAGO
            const defaultBounds = {
                north: santiago.lat + 0.1,
                south: santiago.lat - 0.1,
                east: santiago.lng + 0.1,
                west: santiago.lng - 0.1,
            };

            const options = {
                //bounds: defaultBounds,
                componentRestrictions: {
                    country: "cl"
                },

                //IMPORTANTE ESPECIFICAR LAS FIELDS CON LO NECESARIO PARA QUE PAGAR DE MÁS
                fields: ["place_id", "geometry", "name", "address_components"],
                origin: santiago,
                strictBounds: false,
                types: ["address"],
            };

            const autocomplete = new google.maps.places.Autocomplete(input, options);
            autocomplete.bindTo("bounds", map);

            // Specify just the place data fields that you need.
            //autocomplete.setFields(["place_id", "geometry", "name", "address_components"]);
            // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            const infowindow = new google.maps.InfoWindow();
            const infowindowContent = document.getElementById("infowindow-content");
            infowindow.setContent(infowindowContent);
            const geocoder = new google.maps.Geocoder();
            const marker = new google.maps.Marker({
                map: map
            });
            marker.addListener("click", () => {
                infowindow.open(map, marker);
            });

            let boxPlaceId="" ;
            


            autocomplete.addListener("place_changed", () => {
                infowindow.close();
                const place = autocomplete.getPlace();

                if (!place.place_id) {
                    return;
                }
                boxPlaceId = document.getElementById('place_id');
                boxPlaceId.value = place.place_id;
                console.log(place);
                geocoder.geocode({
                    placeId: place.place_id
                }, (results, status) => {
                    if (status !== "OK" && results) {
                        window.alert("Geocoder failed due to: " + status);
                        return;
                    }
                    map.setZoom(10);
                    map.setCenter(results[0].geometry.location);
                    // Set the position of the marker using the place ID and location.
                    marker.setPlace({
                        placeId: place.place_id,
                        location: results[0].geometry.location,
                    });
                    marker.setVisible(true);

                    let address = "";
                    if (place.address_components) {
                        address = [
                            (place.address_components[1] && place.address_components[1]
                                .short_name || ' '), (place.address_components[0] && place
                                .address_components[0].short_name || ''),
                            (place.address_components[2] && place.address_components[2]
                                .short_name || ''),
                            (place.address_components[3] && place.address_components[3]
                                .short_name || ''),
                            (place.address_components[4] && place.address_components[4]
                                .short_name || ''),
                            (place.address_components[5] && place.address_components[5]
                                .short_name || ''),
                            // (place.address_components[6] && place.address_components[6].short_name || '')
                        ];
                        let comuna = document.getElementById('comuna');
                        comuna.value = (place.address_components[2] && place.address_components[2]
                            .short_name || '');

                            let latitud = document.getElementById('latitud');
                            latitud.value=place.geometry.location.lat();
                            let longitud = document.getElementById('longitud');
                            longitud.value=place.geometry.location.lng();

                    }


                    infowindowContent.children["place-name"].textContent = place.name;
                    // infowindowContent.children["place-id"].textContent = place.place_id;
                    infowindowContent.children["place-address"].textContent =
                        address;
                    // results[0].formatted_address;
                    infowindow.open(map, marker);
                });
            });
        });

    </script>
@stop

@section('css')
    <style>
        .image-wrapper {
            position: relative;
            padding-bottom: 56.25%;
        }

        .image-wrapper img {
            position: absolute;
            object-fit: contain;
            width: 100%;
            height: 100%;
        }
        #map {
            height: 300px;
        }

    </style>

@stop

@section('js')
<script>
    $(document).on("click", "#comentario", function() {
        $('#comentario-in').toggle();
    })

</script>
   
@stop
