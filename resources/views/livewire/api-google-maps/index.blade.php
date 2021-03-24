<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pruebas api Google Map</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @livewireStyles
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC30rciXdqyWlqQXQJYrwE3Qs220le3PvY&libraries=places&v=weekly">
    </script>
</head>

<body>

    <div class="container center">
        <h1 class="container p-2 m-2 rounded text-5xl font-bold text-gray-600 text-center">Pruebas de la api de google
            maps</h1>
            <livewire:api-google-maps.buscar-direccion>
            <livewire:api-google-maps.autocompletar-formulario>
            <livewire:api-google-maps.place-details>
    </div>








</body>

</html>
