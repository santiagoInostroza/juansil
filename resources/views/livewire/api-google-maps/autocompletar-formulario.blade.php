<div>
    <style>
        #map {
            height: 100%;
        }

    </style>
    <h2 class="text-2xl text-gray-500 font-bold mt-10">Relleno de formulario</h2>
    <div class="bg-gray 200 rounded-md shadow p-3">
        <div id="locationField">
            <input id="autocomplete2" onFocus="geolocate()" type="text" class="py-3 my-3 w-96" />
        </div>

        <table id="address" class="table-auto">

            <tr>
                <td class="p-2 w-32 font-bold">Direccion</td>
                <td class="">
                    <input class="" id="route" disabled="true" />
                    <input class="" id="street_number" disabled="true" />
                </td>

            </tr>
            <tr>
                <td class="p-2 w-32 font-bold">Comuna</td>
                <td class="">
                    <input class="" id="locality" disabled="true" />
                </td>
            </tr>
            <tr>
                <td class="p-2 w-32 font-bold">Region</td>
                <td class="">
                    <input class="" id="administrative_area_level_1" disabled="true" />
                </td>
            </tr>
            <tr>
                <td class="p-2 w-32 font-bold">País</td>
                <td class=""">
                    <input class="" id="country" disabled="true" />
                </td>
            </tr>
        </table>



    </div>
    <script>
        let placeSearch;
        let autocomplete2;
        const componentForm = {
            street_number: "short_name",
            route: "long_name",
            locality: "long_name",
            administrative_area_level_1: "short_name",
            country: "long_name",
            // postal_code: "short_name",
        };
        initAutocomplete();


        function initAutocomplete() {
            // Create the autocomplete object, restricting the search predictions to
            // geographical location types.
            autocomplete2 = new google.maps.places.Autocomplete(
                document.getElementById("autocomplete2"), {
                    types: ["geocode"]
                }
            );
            // Avoid paying for data that you don't need by restricting the set of
            // place fields that are returned to just the address components.
            //autocomplete2.setFields(["address_component"]);
           
            // When the user selects an address from the drop-down, populate the
            // address fields in the form.
            autocomplete2.addListener("place_changed", fillInAddress);

        }

        function fillInAddress() {
            // Get the place details from the autocomplete object.
            const place = autocomplete2.getPlace();

            //LIMPIA Y HABILITA LOS CUADROS
            for (const component in componentForm) {
                document.getElementById(component).value = "";
                document.getElementById(component).disabled = false;
            }

            // Get each component of the address from the place details,
            // and then fill-in the corresponding field on the form.
            console.log(place.address_components);
            console.log(place);
            for (const component of place.address_components) {
                const addressType = component.types[0];

                if (componentForm[addressType]) {
                    const val = component[componentForm[addressType]];
                    document.getElementById(addressType).value = val;
                }
            }
        }

        // Bias the autocomplete object to the user's geographical location,
        // as supplied by the browser's 'navigator.geolocation' object.
        function geolocate() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition((position) => {
                    const geolocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };
                    const circle = new google.maps.Circle({
                        center: geolocation,
                        radius: position.coords.accuracy,
                    });
                    autocomplete2.setBounds(circle.getBounds());
                });
            }
        }

    </script>
</div>
