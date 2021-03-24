<div>
    <h2 class="text-2xl text-gray-500 font-bold">Autocompletado de direcciones</h2>
    <div class="bg-gray 200 rounded-md shadow p-3">

        {{-- BUSCAR DIRECCION RESTRINGIDA --}}


        <input type="text" id="direccion" class="py-3 my-3 w-96">
        <div class="map"></div>


        <script>
            const center = {
                lat: 50.064192,
                lng: -130.605469
            };
            // Create a bounding box with sides ~10km away from the center point
            const defaultBounds = {
                north: center.lat + 0.1,
                south: center.lat - 0.1,
                east: center.lng + 0.1,
                west: center.lng - 0.1,
            };
            const input = document.getElementById("direccion");
            const options = {
                //bounds: defaultBounds,
                componentRestrictions: {
                    country: "cl"
                },
                //IMPORTANTE ESPECIFICAR LAS FIELDS CON LO NECESARIO PARA NO PAGAR DE MÁS
                fields: ["address_components", "geometry", "icon", "name"],
                //origin: center,
                strictBounds: false,
                //types: ["establishment"],
            };
            const autocomplete = new google.maps.places.Autocomplete(input, options);


        </script>


    </div>
</div>
